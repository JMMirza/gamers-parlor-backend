<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Platform;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Database\QueryException;
use DataTables;


class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Game::with(['status', 'platform'])->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return view('components.status_badge', ['row' => $row]);
                })
                ->addColumn('action', function ($row) {
                    return view('games.actions', ['row' => $row]);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        $platforms = Platform::where('status_id', 1)->get();

        return view('games.games', ['platforms' => $platforms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        return view('games.add_game', ['statuses' => $statuses]);
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
            'title' => 'required|unique:games,title'
        ]);
        // dd($request->all());
        $input = $request->all();

        if ($request->logo) {
            $file_name = uniqid() . time() . '.' . $request->logo->extension();
            $path = 'files/games/';
            File::ensureDirectoryExists($path);

            $request->logo->move(public_path($path), $file_name);

            $input['logo'] = $file_name;
        }

        if ($request->vip_logo) {
            $file_name_vip = uniqid() . time() . '.' . $request->vip_logo->extension();
            $path_vip = 'files/games/vip_games/';
            File::ensureDirectoryExists($path_vip);

            $request->vip_logo->move(public_path($path_vip), $file_name_vip);

            $input['vip_logo'] = $file_name_vip;
        }
        Game::create($input);

        return redirect()->route('games.index')
            ->with('success', 'Game created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        $statuses = Status::all();
        $platfroms = Platform::all();
        // dd($game->toArray());
        return view('games.edit_game', ['game' => $game, 'statuses' => $statuses, 'platfroms' => $platfroms]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Game $game)
    {
        $request->validate([
            'title' => 'required|unique:games,title,' . $game->id,
        ]);
        // dd($request->all());
        $input = $request->all();


        if ($request->logo) {
            $path = 'files/games/';
            File::ensureDirectoryExists($path);

            $file_name = uniqid() . time() . '.' . $request->logo->extension();

            $request->logo->move(public_path($path), $file_name);

            $input['logo'] = $file_name;
        }
        // dd($input);

        if ($request->vip_logo) {
            $vip_path = 'files/games/vip_games/';
            File::ensureDirectoryExists($vip_path);

            $vip_file_name = uniqid() . time() . '.' . $request->vip_logo->extension();

            $request->vip_logo->move(public_path($vip_path), $vip_file_name);

            $input['vip_logo'] = $vip_file_name;
        }
        // dd($input);

        $game->update($input);

        return redirect()->route('games.index')->with('success', 'Game updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Game  $game
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        try {
            return $game->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
