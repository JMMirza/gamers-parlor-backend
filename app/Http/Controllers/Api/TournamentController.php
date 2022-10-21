<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Platform;
use App\Models\Team;
use App\Models\TeamMatch;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use App\Models\Tournament;
use App\Models\TournamentLevel;
use App\Models\TournamentLevelMatch;
use App\Models\TournamentLevelMatchResult;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class TournamentController extends Controller
{
    private $per_page_limit = 10;

    public function tournamentsList(Request $request)
    {

        $page_no = $request->page_no;
        $platform_id = $request->platform_id;
        // $filter = $request->is_vip;
        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;

        if ($platform_id) {
            $tournaments = Tournament::with(['status', 'game', 'platform', 'enrollments.team'])
                ->where('platform_id', $platform_id)
                ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                ->offset($start)->limit($this->per_page_limit)
                ->latest()->get();
        } else {
            $tournaments = Tournament::with(['status', 'game', 'platform', 'enrollments.team'])
                ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
                ->offset($start)
                ->limit($this->per_page_limit)
                ->latest()->get();
        }

        $platforms = Platform::where('status_id', 1)->get();
        $data = [
            'tournaments' => $tournaments,
            'platforms' => $platforms
        ];
        // $data = Tournament::with([])->offset($start)->limit($this->per_page_limit)->latest()->get();
        return response($data, 200);
    }

    public function tournamentsVipList(Request $request)
    {

        $page_no = $request->page_no;
        // $filter = $request->is_vip;
        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;

        $data = Tournament::with(['status', 'game', 'platform', 'enrollments.team'])
            ->where('is_vip', 1)
            ->whereDate('start_date', '>=', Carbon::now()->format('Y-m-d'))
            ->offset($start)->limit($this->per_page_limit)->latest()->get();
        return response($data, 200);
    }

    public function playerTournamentsList(Request $request)
    {
        $page_no = $request->page_no;
        $user_id = $request->user()->id;
        $platform_id = $request->platform_id;
        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;

        $teams = TeamMember::where('user_id', $user_id)->pluck('team_id');


        if ($platform_id) {
            $tournaments = Enrollment::whereIn('team_id', $teams)->with(['tournament.game', 'team.team_members'])

                ->whereHas('tournament', function ($query) use ($platform_id) {
                    $query->where('platform_id', $platform_id);
                })
                ->offset($start)->limit($this->per_page_limit)
                ->latest()->get();
        } else {
            $tournaments = Enrollment::whereIn('team_id', $teams)->with(['tournament.game', 'team.team_members'])->offset($start)->limit($this->per_page_limit)->latest()->get();
        }

        $platforms = Platform::where('status_id', 1)->get();

        $data = [
            'tournaments' => $tournaments,
            'platforms' => $platforms
        ];
        return response($data, 200);
    }

    public function levelWiseMatches(Request $request)
    {
        $data = [];
        $tournamentID = $request->tournament_id;
        $teamID = $request->team_id;
        $tournamentLevels = TournamentLevel::where('tournament_id', $tournamentID)->get();
        if (count($tournamentLevels) > 0) {
            foreach ($tournamentLevels as $key => $level) {
                $levelMatchIDs = TournamentLevelMatch::where('tournament_level_id', $level->id)->pluck('id')->toArray();
                $data[$key]['tournament_level'] = $level->level;
                $data[$key]['tournament_level_matches'] = $levelMatchIDs;
                if (count($levelMatchIDs) > 0) {

                    $teamMatch = TeamMatch::whereIn('tournament_level_match_id', $levelMatchIDs)->with('team')->get();
                    $data[$key]['team_match'] = $teamMatch;
                } else {
                    $data[$key]['team_match'] = [];
                }
            }
        }

        return response($data, 200);
    }

    public function createTournament(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'published' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required',
            'number_of_request' => 'required|integer',
            'registration_fee' => 'required|integer',
            'terms_and_condition' => 'required|max:2048',
            // 'status_id' => 'required|integer',
        ]);
        $input = $request->all();
        $input['status'] = 'PENDING';
        // dd($request->all());
        $data = Tournament::create($input);
        return response($data, 200);
    }

    public function uploadResult(Request $request)
    {
        $request->validate([
            'tournament_id' => 'required|integer',
            'tournament_level_id' => 'required|integer',
            'tournament_level_match_id' => 'required|integer',
            'winner_team_id' => 'required|integer',
            'winning_proof' => 'required',
        ]);

        $input = $request->all();
        $input['result'] = 'PENDING';

        if ($request->winning_proof) {
            $path = public_path() . '/files/result/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $request->winning_proof);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . time() . '.' . $request->winning_proof->extension();
            $imageFullPath = $path . $imageName;
            file_put_contents($imageFullPath, $image_base64);
            $input['winning_proof'] = $imageName;
        }
        // dd($input);
        $data = TournamentLevelMatchResult::create($input);

        return response($data, 200);
    }
}
