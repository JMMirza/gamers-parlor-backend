<?php

namespace App\Http\Controllers;

use App\Models\LadderPost;
use App\Models\Game;
use App\Models\Platform;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class LadderPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = LadderPost::with(['host', 'game', 'platform'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                // ->addColumn('status', function ($row) {
                //     return view('components.status_badge', ['row' => $row]);
                // })
                ->addColumn('action', function ($row) {
                    return view('ladder_post.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('ladder_post.index');
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
        return view('ladder_post.add_new', ['statuses' => $statuses, 'users' => $users, 'games' => $games, 'platforms' => $platforms]);
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
            'game_id' => 'required|integer',
            'platform_id' => 'required|integer',
            'fee' => 'required|integer',
            'start_date' => 'required|date',
            'host_id' => 'required|integer',
            'status' => 'required',
        ]);

        LadderPost::create($request->all());

        return redirect(route('ladder-post.index'))->with('success', 'Ladder Post created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LadderPost  $ladderPost
     * @return \Illuminate\Http\Response
     */
    public function show(LadderPost $ladderPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LadderPost  $ladderPost
     * @return \Illuminate\Http\Response
     */
    public function edit(LadderPost $ladderPost)
    {
        $statuses = Status::all();
        $users = User::all();
        $games = Game::where('status_id', 1)->get();
        $platforms = Platform::where('status_id', 1)->get();

        return view('ladder_post.edit', ['statuses' => $statuses, 'users' => $users, 'ladderPost' => $ladderPost, 'games' => $games, 'platforms' => $platforms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LadderPost  $ladderPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LadderPost $ladderPost)
    {
        $request->validate([
            'game_id' => 'required|integer',
            'platform_id' => 'required|integer',
            'fee' => 'required|integer',
            'start_date' => 'required|date',
            'host_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $ladderPost->update($request->all());

        return redirect()->route('ladder-post.index')
            ->with('success', 'Ladder Post updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LadderPost  $ladderPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(LadderPost $ladderPost)
    {
        try {
            return $ladderPost->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
