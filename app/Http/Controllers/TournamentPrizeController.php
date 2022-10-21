<?php

namespace App\Http\Controllers;

use App\Models\TournamentPrize;
use App\Models\Tournament;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class TournamentPrizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = '';
        if ($request->ajax()) {

            $data = TournamentPrize::with(['events'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return view('components.status_badge', ['row' => $row]);
                })
                ->addColumn('amount', function ($row) {
                    return is_null($row->amount) ? '<span class="badge badge-outline-danger">N/A</span>' : number_format($row->amount);
                })
                ->addColumn('action', function ($row) {
                    return view('settings.tournament_prizes.actions', ['row' => $row]);
                })
                ->addColumn('event', function ($row) {
                    $type = $row->eventable_type::where('id', $row->eventable_id)->first();

                    return ($row->eventable_type == 'App\Models\Tournament') ? '<span class="badge badge-outline-danger"> ' . $type->name . ' </span>' : '<span class="badge badge-outline-success">' . $type->name . '</span>';
                })
                ->rawColumns(['action', 'status', 'amount', 'event'])
                ->make(true);
        }
        $tournament = Tournament::all();
        $statuses = Status::all();
        $response = array(
            'tournaments' => $tournament,
            'statuses' => $statuses
        );
        return view('settings.tournament_prizes.index', $response);
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
        if (isset($request->tournament_id)) {
            $tournament = Tournament::find($request->tournament_id);
            $prize = new TournamentPrize;
            $prize->title = $request->title;
            $prize->amount = $request->amount;
            $prize->status_id = $request->status_id;
            $tournament->prizes()->save($prize);
        }
        // else
        // {
        //     $match = Match::find($request->match_id);
        //     $prize = new TournamentPrize;
        //     $prize->title = $request->title;
        //     $prize->amount = $request->amount;
        //     $prize->status_id = $request->status_id;
        //     $match->prizes()->save($prize);

        // }
        return redirect(route('prizes.index'))->with('success', 'Prize has been saved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TournamentPrize  $tournamentPrize
     * @return \Illuminate\Http\Response
     */
    public function show(TournamentPrize $tournamentPrize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TournamentPrize  $tournamentPrize
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tournamentPrize = TournamentPrize::where('id', $id)->first();
        $tournament = Tournament::all();
        $statuses = Status::all();
        return view('settings.tournament_prizes.index', [
            'tournaments' => $tournament,
            'statuses' => $statuses,
            'tournamentPrize' => $tournamentPrize
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TournamentPrize  $tournamentPrize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tournamentPrize = TournamentPrize::findOrFail($id);
        $input = $request->all();
        $input['eventable_id'] = $request->tournament_id;
        $tournamentPrize->update($input);
        return redirect(route('prizes.index'))->with('success', 'Prize has been update successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TournamentPrize  $tournamentPrize
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tournamentPrize = TournamentPrize::findOrFail($id);
        try {
            $tournamentPrize->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
