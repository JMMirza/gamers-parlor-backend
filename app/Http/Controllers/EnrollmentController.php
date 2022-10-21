<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\Team;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class EnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Enrollment::with(['tournament', 'team'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('tournament_enrollment.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $tournaments = Tournament::all();
        $teams = Team::all();
        return view('tournament_enrollment.index', ['tournaments' => $tournaments, 'teams' => $teams]);
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
        // dd($request->all());
        $request->validate([
            'team_id' => 'required|integer',
            'tournament_id' => 'required|integer',
        ]);
        $user_id = $request->user()->id;
        $input = $request->all();
        $input['user_id'] = $user_id;
        Enrollment::create($input);
        return redirect()->route('tournament-enrollments.index')
            ->with('success', 'Team Enrolled successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function show(Enrollment $enrollment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tournaments = Tournament::all();
        $teams = Team::all();
        $enrollment = Enrollment::findOrFail($id);
        // dd($enrollment->toArray());
        return view('tournament_enrollment.index', ['tournaments' => $tournaments, 'teams' => $teams, 'enrollment' => $enrollment]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,  $id)
    {
        $request->validate([
            'team_id' => 'required|integer',
            'tournament_id' => 'required|integer',
        ]);
        $enrollment = Enrollment::findOrFail($id);
        $enrollment->update($request->all());

        return redirect(route('tournament-enrollments.index'))->with('success', 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Enrollment  $enrollment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Enrollment $enrollment)
    {
        try {
            return $enrollment->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
