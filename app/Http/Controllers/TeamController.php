<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;
use Illuminate\Support\Facades\File;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Team::with('status')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function ($row) {
                //     return view('components.status_badge', ['row' => $row]);
                // })
                ->addColumn('action', function ($row) {
                    return view('settings.teams.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $statuses = Status::all();
        return view('settings.teams.teams', ['statuses' => $statuses]);
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
        $this->validations($request);
        $input = $request->all();

        $file_name = time() . '.' . $request->team_logo->extension();
        $path = 'uploads/team_logos';
        File::ensureDirectoryExists($path);

        $request->team_logo->move(public_path($path), $file_name);

        $input['team_logo'] = $file_name;
        Team::create($input);
        return redirect()->route('teams.index')
            ->with('success', 'Team created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit(Team $team)
    {
        $statuses = Status::all();
        return view('settings.teams.teams', ['statuses' => $statuses, 'team' => $team]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'number_of_members' => 'required|integer',
        ]);
        $input = $request->all();
        // dd($input);

        if ($request->hasFile('team_logo')) {
            // dd($input);
            $file_name = time() . '.' . $request->team_logo->extension();
            $path = 'uploads/team_logos';
            File::ensureDirectoryExists($path);

            $request->team_logo->move(public_path($path), $file_name);

            $input['team_logo'] = $file_name;
        }

        $team->update($input);

        return redirect()->route('teams.index')
            ->with('success', 'Team updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy(Team $team)
    {
        try {
            return $team->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    private function validations($request)
    {
        $validationArr = [
            'name' => 'required|string|max:255',
            'number_of_members' => 'required|integer',
            'user_id' => 'required|integer',
            'team_logo' => 'required|mimes:jpg,jpeg,png|max:2048',
        ];

        $request->validate($validationArr, [
            'name.required' => 'Name is required!',
            'number_of_members.required' => 'Number of Members is required!',
            'team_logo.required' => 'Team Logo is required!',
            'team_logo.size' => 'Team Logo size is too big!',
        ]);
    }
}
