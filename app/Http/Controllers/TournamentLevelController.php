<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\TeamMatch;
use App\Models\TournamentLevel;
use App\Models\TournamentLevelMatch;
use App\Models\TournamentLevelMatchResult;
use Illuminate\Http\Request;
use DataTables;

class TournamentLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TournamentLevel::where('tournament_id', $request->tournament_id)->with('tournament')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('levels.actions', ['row' => $row]);
                })
                ->addColumn('more_actions', function ($row) {
                    return view('levels.more_actions', ['row' => $row]);
                })
                ->rawColumns(['action', 'more_actions'])
                ->make(true);
        }
        return view('levels.levels', ['tournamentID' => $request->tournament_id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // dd($request->all());
        // $tournament = Tournament::find($request->tournament_id)->levelMatches->map(function ($query) {
        //     return $query->teams;
        // });

        $data = [];
        $tournamentID = $request->tournament_id;
        // $teamID = $request->team_id;
        $tournamentLevels = TournamentLevel::where('tournament_id', $tournamentID)->get();
        if (count($tournamentLevels) > 0) {
            foreach ($tournamentLevels as $key => $level) {
                $levelMatches = TournamentLevelMatch::where('tournament_level_id', $level->id)->with('teams')->get()->toArray();
                $data[$key]['tournament_level'] = $level->level;
                $data[$key]['tournament_level_matches'] = $levelMatches;
            }
        }
        // dd($data);
        return view('levels.level_hierarachy', ['tournaments' => $data]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'tournament_id' => 'required|integer',
            'start_date' => 'required',
        ]);
        $level = TournamentLevel::where('tournament_id', $request->tournament_id)->latest()->first();
        if ($level) {
            $enrolled_teams = Enrollment::where(['tournament_id' => $request->tournament_id, 'status' => 'APPROVED'])->pluck('team_id');
            if ($level->status == 'COMPLETE') {
                $tournamentLevel = TournamentLevel::create([
                    'tournament_id' => $request->tournament_id,
                    'start_date' => $request->start_date,
                    'level' => $level->level + 1,
                    'teams' => count($enrolled_teams),
                    'status' => 'PENDING'
                ]);
            } else {
                return redirect()->route('tournament-levels.index', ['tournament_id' => $request->tournament_id])
                    ->with('error', 'Level is in Progress');
            }
        } else {
            $enrolled_teams = Enrollment::where('tournament_id', $request->tournament_id)->pluck('team_id');
            $tournamentLevel = TournamentLevel::create([
                'tournament_id' => $request->tournament_id,
                'start_date' => $request->start_date,
                'level' => 1,
                'teams' => count($enrolled_teams),
                'status' => 'PENDING'
            ]);
        }
        // dd($enrolled_teams->chunk(2));
        foreach ($enrolled_teams->chunk(2) as $key => $team_group) {
            $match = TournamentLevelMatch::create([
                'tournament_id' => $request->tournament_id,
                'tournament_level_id' => $tournamentLevel->id,
                'status' => 'PENDING'
            ]);
            // foreach ($team_group as $key => $team_id) {
            // }
            $match->teams()->attach($team_group->toArray());
        }

        return redirect()->route('tournament-levels.index', ['tournament_id' => $request->tournament_id])
            ->with('success', 'Level created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentLevel  $tournamentLevel
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentLevel $tournamentLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TournamentLevel  $tournamentLevel
     * @return \Illuminate\Http\Response
     */
    public function edit(TournamentLevel $tournamentLevel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TournamentLevel  $tournamentLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TournamentLevel $tournamentLevel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentLevel  $tournamentLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentLevel $tournamentLevel)
    {
        //
    }

    public function update_level_status(Request $request)
    {
        $result = TournamentLevelMatchResult::findOrFail($request->result_id);
        $result->result = $request->status;
        $result->save();
        $team = Enrollment::where('team_id', $request->team_id)->first();
        $team->status = $request->status;
        $team->save();
        return redirect()->back()
            ->with('success', 'Level updated successfully.');
    }

    public function show_modal($match_id)
    {
        // dd($match_id);
        $result = TournamentLevelMatchResult::where('tournament_level_match_id', $match_id)->first();

        return view('levels.result_modal', ['result' => $result]);
    }
}
