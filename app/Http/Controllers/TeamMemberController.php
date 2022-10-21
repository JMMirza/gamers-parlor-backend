<?php

namespace App\Http\Controllers;

use App\Models\TeamMember;
use App\Models\User;
use App\Models\Status;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Support\Facades\Hash;

class TeamMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::orderBy('id', 'DESC')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('verification_status', function ($row) {
                    return is_null($row->email_verified_at) ? '<span class="badge badge-outline-danger">Not Verified</span>' : '<span class="badge badge-outline-success">Verified</span>';
                })
                ->addColumn('action', function ($row) {
                    return view('users.actions', ['row' => $row]);
                })
                ->rawColumns(['action', 'verification_status'])
                ->make(true);
        }
        return view('users.members');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $statuses = Status::all();
        $teams = Team::all();

        $data = [
            'personaldetails' => 'active',
            'statuses' => $statuses,
            'teams' => $teams
        ];

        return view('users.add_member_form', $data);
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
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'status_id' => 'required|integer',
            'team_id' => 'required|integer',
            'role' => 'required|string|max:255',
        ]);
        // dd($request->all());
        if (request()->has('avatar')) {
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }
        $user_input = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->name),
            'avatar' =>  $avatarName,
        ];
        $user = User::create($user_input);

        $teamMember = TeamMember::where(['user_id' => $user->id, 'team_id' => $request->team_id])->first();
        if ($teamMember == null) {
            TeamMember::create([
                'role' => $request->role,
                'user_id' => $user->id,
                'team_id' => $request->team_id,
                'status_id' => $request->status_id,
            ]);
            return redirect(route('teams-members.index'))->with('success', 'Team Member added');
        }
        return back()->with('error', 'Team Member already exisit');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function show(TeamMember $teamMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $statuses = Status::all();
        $teams = Team::all();
        $user_info = TeamMember::where('user_id', $id)->with('user')->first();
        $user = null;
        if (!isset($user_info)) {
            $user = User::findOrFail($id);
        }
        $data = [
            'statuses' => $statuses,
            'teams' => $teams,
            'user_info' => $user_info,
            'user' => $user
        ];

        return view('users.edit_member_info', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'role' => 'required|string|max:255',
            'user_id' => 'required|integer',
            'team_id' => 'required|integer',
            'status_id' => 'required|integer',
        ]);
        $teamMember = TeamMember::where(['user_id' => $request->user_id, 'team_id' => $request->team_id])->first();
        if ($teamMember == null) {
            TeamMember::create([
                'role' => $request->role,
                'user_id' => $request->user_id,
                'team_id' => $request->team_id,
                'status_id' => $request->status_id,
            ]);
            return redirect(route('teams-members.index'))->with('success', 'Added to team');
        }
        $teamMember->update([
            'role' => $request->role,
            'user_id' => $request->user_id,
            'team_id' => $request->team_id,
            'status_id' => $request->status_id,
        ]);
        return redirect(route('teams-members.index'))->with('success', 'Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TeamMember  $teamMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(TeamMember $teamMember)
    {
        //
    }

    public function teams_members_create(Request $request)
    {
        dd($request->all());
    }
}
