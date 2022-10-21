<?php

namespace App\Http\Controllers;

use App\Models\MatchScheduler;
use App\Models\Status;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class MatchSchedulerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = MatchScheduler::with(['team1', 'team2', 'tournament', 'status'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return view('components.status_badge', ['row' => $row]);
                })
                ->addColumn('action', function ($row) {
                    return view('match_scheduler.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $statuses = Status::all();
        $tournaments = Tournament::all();
        $teams = Team::all();
        return view('match_scheduler.match_scheduler', ['tournaments' => $tournaments, 'teams' => $teams, 'statuses' => $statuses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationArr = [
            'team_id' => 'required',
            'tournament_id' => 'required|integer',
            'status_id' => 'required|integer',
            'start_date' => 'required',
        ];
        $request->validate($validationArr);
        $input = $request->all();
        $input['team1_id'] = $request->team_id[0];
        $input['team2_id'] = $request->team_id[1];

        MatchScheduler::create($input);
        return redirect()->route('match-scheduler.index')
            ->with('success', 'Match created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MatchScheduler  $matchScheduler
     * @return \Illuminate\Http\Response
     */
    public function show(MatchScheduler $matchScheduler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MatchScheduler  $matchScheduler
     * @return \Illuminate\Http\Response
     */
    public function edit(MatchScheduler $matchScheduler)
    {
        $statuses = Status::all();
        $tournaments = Tournament::all();
        $teams = Team::all();
        return view('match_scheduler.match_scheduler', ['matchScheduler' => $matchScheduler, 'tournaments' => $tournaments, 'teams' => $teams, 'statuses' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MatchScheduler  $matchScheduler
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MatchScheduler $matchScheduler)
    {
        $validationArr = [
            'team_id' => 'required',
            'tournament_id' => 'required|integer',
            'status_id' => 'required|integer',
            'start_date' => 'required',
        ];

        $request->validate($validationArr);
        $input = $request->all();
        $input['team1_id'] = $request->team_id[0];
        $input['team2_id'] = $request->team_id[1];

        $matchScheduler->update($input);
        return redirect()->route('match-scheduler.index')
            ->with('success', 'Match updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MatchScheduler  $matchScheduler
     * @return \Illuminate\Http\Response
     */
    public function destroy(MatchScheduler $matchScheduler)
    {
        try {
            return $matchScheduler->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
