<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use App\Models\Status;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class TournamentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Tournament::with(['status', 'game', 'platform'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status != null) {
                        return view('components.status_badge', ['row' => $row]);
                    }
                })
                ->addColumn('action', function ($row) {
                    return view('settings.tournaments.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('settings.tournaments.tournaments');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        $games = Game::where('status_id', 1)->get();
        $platforms = Platform::where('status_id', 1)->get();
        return view('settings.tournaments.add_new', ['statuses' => $statuses, 'games' => $games, 'platforms' => $platforms]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validations($request);

        Tournament::create($request->all());
        return redirect()->route('tournaments.index')
            ->with('success', 'Tournament created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function show(Tournament $tournament)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function edit(Tournament $tournament)
    {
        $statuses = Status::all();
        $games = Game::where('status_id', 1)->get();
        $platforms = Platform::where('status_id', 1)->get();
        return view('settings.tournaments.edit', ['statuses' => $statuses, 'tournament' => $tournament, 'games' => $games, 'platforms' => $platforms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tournament $tournament)
    {
        $this->validations($request);
        $tournament->update($request->all());

        return redirect()->route('tournaments.index')
            ->with('success', 'Tournament updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tournament  $tournament
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tournament $tournament)
    {
        try {
            return $tournament->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    private function validations($request)
    {

        $validationArr = [
            'name' => 'required|string|max:255',
            'published' => 'required|integer',
            'start_date' => 'required',
            'end_date' => 'required',
            'number_of_request' => 'required|integer',
            'registration_fee' => 'required|integer',
            'terms_and_condition' => 'required|max:2048',
            'status' => 'required|integer',
            'game_id' => 'required|integer',
            'platform_id' => 'required|integer',
        ];

        $request->validate($validationArr, [
            'name.required' => 'Name is required!',
            'published.required' => 'Published is required!',
            'start_date.required' => 'Start Date is required!',
            'end_date.required' => 'End Date is required!',
            'number_of_request.required' => 'Number of Request is required!',
            'registration_fee.required' => 'Registration Fee is required!',
            'terms_and_condition.required' => 'Terms and Condistion is required!',
            'status.required' => 'Select the status!',
            'game_id.required' => 'Select the game!',
            'platform_id.required' => 'Select the platform!'
        ]);
    }
}
