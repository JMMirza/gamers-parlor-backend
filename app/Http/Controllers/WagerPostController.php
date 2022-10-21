<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use App\Models\Status;
use App\Models\User;
use App\Models\WagerPost;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class WagerPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = WagerPost::with(['status', 'host', 'guest', 'game', 'platform'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function ($row) {
                //     return view('components.status_badge', ['row' => $row]);
                // })
                ->addColumn('action', function ($row) {
                    return view('wager_post.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('wager_post.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        $users = User::all();
        $games = Game::where('status_id', 1)->get();
        $platforms = Platform::where('status_id', 1)->get();
        return view('wager_post.add_new', ['statuses' => $statuses, 'users' => $users, 'games' => $games, 'platforms' => $platforms]);
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
            'game_id' => 'required|integer',
            'platform_id' => 'required|integer',
            'fee' => 'required|integer',
            'start_date' => 'required|date',
            'host_id' => 'required|integer',
            'status_id' => 'required|integer',
        ]);

        WagerPost::create($request->all());

        return redirect(route('wager-post.index'))->with('success', 'Wager Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WagerPost  $wagerPost
     * @return \Illuminate\Http\Response
     */
    public function show(WagerPost $wagerPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WagerPost  $wagerPost
     * @return \Illuminate\Http\Response
     */
    public function edit(WagerPost $wagerPost)
    {
        $statuses = Status::all();
        $users = User::all();
        $games = Game::where('status_id', 1)->get();
        $platforms = Platform::where('status_id', 1)->get();

        return view('wager_post.edit', ['statuses' => $statuses, 'users' => $users, 'wagerPost' => $wagerPost, 'games' => $games, 'platforms' => $platforms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\WagerPost  $wagerPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WagerPost $wagerPost)
    {
        $request->validate([
            'game_id' => 'required|integer',
            'platform_id' => 'required|integer',
            'fee' => 'required|integer',
            'start_date' => 'required|date',
            'host_id' => 'required|integer',
            'status_id' => 'required|integer',
        ]);

        $wagerPost->update($request->all());

        return redirect()->route('wager-post.index')
            ->with('success', 'Wager Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WagerPost  $wagerPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(WagerPost $wagerPost)
    {
        try {
            return $wagerPost->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
