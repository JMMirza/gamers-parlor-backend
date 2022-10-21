<?php

namespace App\Http\Controllers;

use App\Models\TournamentLevelMatchResult;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TournamentLevelMatchResultController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $request->validate([
            'tournament_id' => 'required|integer',
            'tournament_level_id' => 'required|integer',
            'tournament_level_match_id' => 'required|integer',
            'winner_team_id' => 'required|integer',
            'winning_proof' => 'required',
            'result' => 'required|string',
        ]);

        $input = $request->all();

        if ($request->winning_proof) {
            $file_name = uniqid() . time() . '.' . $request->winning_proof->extension();
            $path = 'files/results/';
            File::ensureDirectoryExists($path);

            $request->winning_proof->move(public_path($path), $file_name);

            $input['winning_proof'] = $file_name;
        }

        TournamentLevelMatchResult::create($input);

        return redirect()->route('games.index')
            ->with('success', 'Game created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentLevelMatchResult  $tournamentLevelMatchResult
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentLevelMatchResult $tournamentLevelMatchResult)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TournamentLevelMatchResult  $tournamentLevelMatchResult
     * @return \Illuminate\Http\Response
     */
    public function edit(TournamentLevelMatchResult $tournamentLevelMatchResult)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TournamentLevelMatchResult  $tournamentLevelMatchResult
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TournamentLevelMatchResult $tournamentLevelMatchResult)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentLevelMatchResult  $tournamentLevelMatchResult
     * @return \Illuminate\Http\Response
     */
    public function destroy(TournamentLevelMatchResult $tournamentLevelMatchResult)
    {
        //
    }
}
