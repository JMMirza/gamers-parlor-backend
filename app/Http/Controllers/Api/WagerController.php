<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Platform;
use App\Models\WagerPost;
use Illuminate\Http\Request;

class WagerController extends Controller
{
    private $per_page_limit = 10;

    public function wagersList(Request $request)
    {
        $page_no = $request->page_no;
        $matchCategory = $request->matchCategory;

        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;
        if ($matchCategory == 'my_matches') {
            // dd("hello");s
            $wagers = WagerPost::with(['status', 'host', 'guest', 'game', 'platform'])
                ->where('host_id', $request->user()->id)
                ->offset($start)->limit($this->per_page_limit)
                ->latest()->get();
        } else {
            $wagers = WagerPost::with(['status', 'host', 'guest', 'game', 'platform'])->where('host_id', '!=', $request->user()->id)
                ->offset($start)->limit($this->per_page_limit)->latest()->get();
        }
        $platforms = Platform::where('status_id', 1)->get();
        $data = [
            'wagers' => $wagers,
            'platforms' => $platforms
        ];
        return response($data, 200);
    }

    public function getWagerData()
    {
        $platforms = Platform::where('status_id', 1)->get();
        $games = Game::where('status_id', 1)->get();

        $data = [
            'platforms' => $platforms,
            'games' => $games
        ];

        return response($data, 200);
    }

    public function createWager(Request $request)
    {
        $request->validate([
            'platform_id' => 'required|integer',
            'game_id' => 'required|integer',
            'fee' => 'required',
            'start_date' => 'required',
        ]);

        $input = $request->all();
        $input['host_id'] = $request->user()->id;
        $data = WagerPost::create($input);
        return response($data, 200);
    }

    public function listMatches(Request $request)
    {
        $page_no = $request->page_no;
        $platform_id = $request->platform_id;

        $page_no = (isset($page_no) && $page_no > 0) ? $page_no : 1;
        $start = ($page_no - 1) * $this->per_page_limit;
        if ($platform_id) {
            $wagers = WagerPost::with(['status', 'host', 'guest', 'game', 'platform'])
                ->where('guest_id', '!=', null)
                ->where('platform_id', $platform_id)
                ->offset($start)->limit($this->per_page_limit)
                ->latest()->get();
        } else {
            $wagers = WagerPost::with(['status', 'host', 'guest', 'game', 'platform'])
                ->where('guest_id', '!=', null)->offset($start)
                ->limit($this->per_page_limit)->latest()->get();
        }
        $platforms = Platform::where('status_id', 1)->get();
        $data = [
            'wagers' => $wagers,
            'platforms' => $platforms
        ];
        return response($data, 200);
    }
}
