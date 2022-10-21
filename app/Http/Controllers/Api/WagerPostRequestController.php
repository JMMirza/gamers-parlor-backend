<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\WagerPost;
use App\Models\WagerPostRequest;
use Illuminate\Http\Request;

class WagerPostRequestController extends Controller
{
    public function createRequest(Request $request)
    {
        $request->validate([
            'wager_post_id' => 'required|integer',
            'request_time' => 'required',
        ]);
        // $wager_post  = WagerPost::find($request->wager_post_id);
        // $wager_post->status = 'PENDING';
        $input  = $request->all();
        $input['user_id'] = $request->user()->id;
        $input['status'] = 'PENDING';

        $request = WagerPostRequest::create($input);
        $data = [
            'request' => $request
        ];
        return response($data, 200);
    }

    public function getWagerPostRequest(Request $request)
    {
        $wager_requests = WagerPostRequest::where('wager_post_id', $request->wager_post_id)
            ->where('status', 'PENDING')
            ->with(['user', 'wager_post.game'])->get();
        return response($wager_requests, 200);
    }

    public function acceptRequest(Request $request)
    {
        $wager_request = WagerPostRequest::findOrFail($request->wager_request_id);
        $wager_request->status = 'ACCEPTED';
        $wager_request->save();
        $wager_post = WagerPost::findOrFail($wager_request->wager_post_id);
        $wager_post->guest_id = $wager_request->user_id;
        $wager_post->status = 'On going';
        $wager_post->save();
        $wager_rejected_requests = WagerPostRequest::where('wager_post_id', $wager_request->wager_post_id)->where('id', '!=', $request->wager_request_id)->get();

        foreach ($wager_rejected_requests as $value) {
            $value->status = 'REJECTED';
            $value->save();
        }
        return response('Accepted the request', 200);
    }

    public function rejectRequest(Request $request)
    {
        $wager_request = WagerPostRequest::findOrFail($request->wager_request_id);
        $wager_request->status = 'REJECTED';
        $wager_request->save();
        return response('Rejected the request', 200);
    }

    public function getOngoingRequest(Request $request)
    {
    }
}
