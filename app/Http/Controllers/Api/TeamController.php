<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\TeamMember;
use App\Models\Tournament;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Support\Facades\File;
use Laravel\Ui\Presets\React;

class TeamController extends Controller
{
    private $per_page_limit = 10;

    public function teamsList(Request $request)
    {

        $page_no = $request->page_no;

        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;

        $data = Team::with('status')->offset($start)->limit($this->per_page_limit)->get();
        return response($data, 200);
    }

    public function playerTeams(Request $request)
    {

        $page_no = $request->page_no;
        $user_id = $request->user()->id;

        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;

        $data = TeamMember::with(['user', 'team'])->where('user_id', $user_id)
            ->offset($start)
            ->limit($this->per_page_limit)
            ->get();

        return response($data, 200);
    }

    public function getTeamData(Request $request)
    {
        $user = $request->user();
        $teams = Team::where(['user_id' => $user->id, 'status_id' => 1])->get();
        $users = User::whereNotIn('id', [$user->id])->get();
        $data = [
            'users' => $users,
            'teams' => $teams
        ];

        return response($data, 200);
    }

    public function createTeam(Request $request)
    {
        $user = $request->user();
        $tournament = Tournament::findOrFail($request->tournament_id);
        $enrolled_teams = Enrollment::where('tournament_id', $request->tournament_id)->get();
        $user_enrollment = Enrollment::where(['user_id' => $request->user()->id, 'tournament_id', $request->tournament_id])->first();
        $credit = Transaction::where('user_id', \Auth::user()->id)->sum('amount');
        if ($credit > $tournament->registration_fee) {
            if (!$user_enrollment) {
                // if ($user->is_vip == 0) {
                if ($tournament->number_of_request >= count($enrolled_teams)) {
                    Transaction::create([
                        'user_id' => $request->user()->id,
                        'amount' => -1 * abs($credit - $tournament->registration_fee),
                        'currency' => 'USD',
                        'full_name' => \Auth::user()->name
                    ]);

                    $input = $request->all();
                    $input['user_id'] = $request->user()->id;
                    if ($request->team_logo) {
                        $path = public_path() . '/files/games/';
                        if (!File::exists($path)) {
                            File::makeDirectory($path, $mode = 0777, true, true);
                        }

                        $image_parts = explode(";base64,", $request->team_logo);
                        $image_type_aux = explode("image/", $image_parts[0]);
                        $image_type = $image_type_aux[1];
                        $image_base64 = base64_decode($image_parts[1]);
                        $imageName = uniqid() . '.png';
                        $imageFullPath = $path . $imageName;
                        file_put_contents($imageFullPath, $image_base64);
                        $input['team_logo'] = $imageName;
                    }
                    $input['name'] = $request->team_name;
                    // dd($input);
                    $team = Team::create($input);
                    TeamMember::create([
                        'user_id' => $request->user()->id,
                        'team_id' => $team->id,
                        'role' => 'Captain'
                    ]);
                    // array_push($request->players, $request->user());
                    foreach ($request->players as  $player) {
                        TeamMember::create([
                            'user_id' => $player['id'],
                            'team_id' => $team->id,
                            'role' => 'Player'
                        ]);
                    }

                    $tournament->request_received = $tournament->request_received + 1;
                    $tournament->save();

                    Enrollment::create([
                        'tournament_id' => $request->tournament_id,
                        'team_id' => $team->id,
                        'user_id' => $request->user()->id
                    ]);
                    return response($team, 200);
                }
                // } else {
                // }
                return response('Tournament participant places are filled', 400);
            }
            return response('You have already participated in this tournament', 400);
        }
        return response('You do not have enough money to participate for this tournament', 400);
    }

    public function createTeamMember(Request $request)
    {
        $request->validate([
            'role' => 'required|string|max:255',
            'team_id' => 'required|integer',
            'user_id' => 'required|integer'
        ]);

        $data = TeamMember::create($request->all());
        return response($data, 200);
    }

    public function listTournamentTeam(Request $request)
    {
        $team_id = $request->team_id;
        $teams = TeamMember::where('team_id', $team_id)->with(['team', 'user'])->get();
        return response($teams, 200);
    }

    public function listLadderTeams()
    {
        $teams = Team::where('is_ladder', '1')->orderBy('score', 'asc')->get();

        return response($teams, 200);
    }

    public function createLadderTeam(Request $request)
    {
        $user = $request->user();
        $input  = $request->all();
        $input['user_id'] = $user->id;
        $input['status_id'] = 1;
        $input['is_ladder'] = 1;

        if ($request->team_logo) {
            $path = public_path() . '/files/games/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $request->team_logo);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $path . $imageName;
            file_put_contents($imageFullPath, $image_base64);
            $input['team_logo'] = $imageName;
        }
        $team = Team::create($input);
        TeamMember::create([
            'user_id' => $request->user()->id,
            'team_id' => $team->id,
            'role' => 'Captain'
        ]);
        // array_push($request->players, $request->user());
        foreach ($request->players as  $player) {
            TeamMember::create([
                'user_id' => $player['id'],
                'team_id' => $team->id,
                'role' => 'Player'
            ]);
        }
        return response($team, 200);
    }

    public function listTeamMembers(Request $request)
    {
        $page_no = $request->page_no;

        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;

        $data = TeamMember::where('team_id', $request->team_id)->with(['user', 'team'])
            ->offset($start)
            ->limit($this->per_page_limit)
            ->get();

        return response($data, 200);
    }
}
