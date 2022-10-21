<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Notifications\VideoUploadedByUser;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Laratrust\Helper;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::with(['roles', 'permissions'])->whereHas(
                'roles',
                function ($q) {
                    $q->where('name', 'customer');
                }
            )->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // if(isset($row->employee->id)){
                    $actionBtn = '
                        <a href="' . route('staff-profile', $row->id) . '" class="btn btn-sm btn-success btn-icon waves-effect waves-light"><i class="mdi mdi-lead-pencil"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('roles', function ($row) {
                    $count = ($row->roles->count());
                    return $count;
                })
                ->addColumn('permissions', function ($row) {
                    $count = ($row->permissions->count());
                    return $count;
                })
                ->rawColumns(['action', 'roles', 'permissions'])
                ->make(true);
        }
        return view('staffs.index');
    }
    // roles permissions assignments
    public function userRolesPermissionList(Request $request)
    {

        $modelsKeys = array_keys(Config::get('laratrust.user_models'));
        $modelKey = $request->get('model') ?? $modelsKeys[0] ?? null;
        //dd(User::with(['roles','permissions'])->get()->toArray());
        if ($request->ajax()) {
            $data = User::with(['roles', 'permissions'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $actionBtn = '
                        <a class="btn btn-sm btn-success btn-icon waves-effect waves-light" href="' . route("edit-with-role-permissions", ['id' => $row->id]) . '"><i class="mdi mdi-lead-pencil"></i></a>
                    ';

                    return $actionBtn;
                })
                ->addColumn('roles', function ($row) {
                    $count = ($row->roles->count());
                    return $count;
                })
                ->addColumn('permissions', function ($row) {
                    $count = ($row->permissions->count());
                    return $count;
                })
                ->rawColumns(['action', 'roles', 'permissions'])
                ->make(true);
        }

        return view('role_permissions_assignment.index', [
            'models' => $modelsKeys,
            'modelKey' => $modelKey,
        ]);
    }

    public function editUserRolesPermissions(Request $request, $id)
    {
        if (\Auth::user()->hasRole('admin')) {
            $user = User::query()
                ->with(['roles:id,name', 'permissions:id,name'])
                ->findOrFail($id);
            $roles = Role::orderBy('name')->get(['id', 'name', 'display_name', 'description'])
                ->map(function ($role) use ($user) {
                    $role->assigned = $user->roles
                        ->pluck('id')
                        ->contains($role->id);
                    $role->isRemovable = Helper::roleIsRemovable($role);

                    return $role;
                });
            $permissions = Permission::orderBy('name')
                ->get(['id', 'name', 'display_name', 'description'])
                ->map(function ($permission) use ($user) {
                    $permission->assigned = $user->permissions
                        ->pluck('id')
                        ->contains($permission->id);

                    return $permission;
                });



            $data['roles'] = $roles;
            $data['permissions'] = $permissions;
            $data['user'] = $user;

            return view('role_permissions_assignment.edit', $data);
        }
    }


    public function updateUserRolesPermissions(Request $request, $id)
    {
        $modelKey = 'users';
        $userModel = Config::get('laratrust.user_models')[$modelKey] ?? null;

        if (!$userModel) {
            //'Model was not specified in the request';
            //return redirect()->back()->with('error','Unfortunately not able to update the role assignment');
        }

        $user = $userModel::findOrFail($id);
        $user->syncRoles($request->get('roles') ?? []);
        $user->syncPermissions($request->get('permissions') ?? []);

        return redirect()->back()->with('success', 'Your details for the user have been successfully updated!');;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staffs.add_new_profile');
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
            'name' => 'required',
            'email' => 'required | email | unique:users',
            'password' => 'required | min:8|confirmed',
        ]);

        $input = $request->all();

        if ($request->password) {
            $input['password'] = bcrypt($request->password);
        }
        $input['avatar'] = '';
        $user = User::create($input);
        $user->attachRole('customer');
        return redirect(route('staffs.index'))->with('success', 'Staff created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_info = User::where('id', $id)->first();
        // $user_info = $id;

        $data = [
            'user_info' => $user_info,
        ];


        return view('staffs.edit_profile', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $logged_user = User::findorfail($request->user_id);
        // dd($logged_user->toArray());
        if ($request->password) {
            $request->validate([
                'password' => 'required | min:8 | confirmed',
            ]);
            $password = bcrypt($request->password);
            $logged_user->password = $password;
            $logged_user->save();
        } else {
            $request->validate([
                'name' => 'required',
                'email' => 'required | email | unique:users,email,' . $logged_user->id,
            ]);

            $input = $request->all();
            $logged_user->update($input);
        }
        return redirect(route('root'))->with('success', 'Staff updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    public function landingPage()
    {
        return view('landing_page.home');
    }

    public function showTermsPolices()
    {
        return view('terms_and_privacy.terms');
    }

    public function showPrivacyPolices()
    {
        return view('terms_and_privacy.privacy');
    }

    public function uploadVideo(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'game' => 'required',
            'video' => 'required',
        ]);
        // dd($request->all());
        $user = User::with(['roles', 'permissions'])->whereHas(
            'roles',
            function ($q) {
                $q->where('name', 'admin');
            }
        )->first();
        // dd($roles->toArray());
        if ($user) {
            $video = request()->file('video');
            $videoName = time() . '.' . $video->getClientOriginalExtension();
            $videoPath = public_path('/videos/');
            File::ensureDirectoryExists($videoPath);
            $video->move($videoPath, $videoName);

            $event = [
                'name' => 'Dear ' . $user->name . "!",
                'body' => $request->name . ' has uploaded the video of the game named as: ' . $request->game,
                'attchment' => public_path() . '/videos/' . $videoName  . '.mp4'
            ];
            $user->notify(new VideoUploadedByUser($event));
        }
        return redirect()->back();
    }

    public function transactions(Request $request)
    {
        if ($request->ajax()) {
            $data = Transaction::with('user')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    if ($row->status == 'PENDING') {
                        return 'Pending';
                    } elseif ($row->status == 'COMPLETE') {
                        return 'Complete';
                    } else {
                        return 'REJECT';
                    }
                })
                ->addColumn('action', function ($row) {
                    return view('transactions.actions', ['row' => $row]);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('transactions.transactions');
    }

    public function accept_transaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($transaction) {
            $transaction->status = 'COMPLETE';
            $transaction->save();
        }
        return redirect()->back();
    }

    public function reject_transaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        if ($transaction) {
            $transaction->status = 'REJECT';
            $transaction->save();
        }
        return redirect()->back();
    }
}
