<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LadderPost;
use App\Models\LadderPostEnrollment;
use Illuminate\Http\Request;

class LadderPostEnrollmentController extends Controller
{
    public function createRequest(Request $request)
    {
        $request->validate([
            'ladder_post_id' => 'required|integer',
            'team_id' => 'required|integer',
            // 'request_time' => 'required',
        ]);
        $ladder_post = LadderPost::where('id', $request->ladder_post_id)->first();
        if (Auth::user()->balance >= $ladder_post->fee) {
            $input  = $request->all();
            $input['status'] = 'ACCEPTED';

            $request = LadderPostEnrollment::create($input);
            $ladder_post->status = 'On going';
            $ladder_post->save();
            $data = [
                'request' => $request
            ];
            return response($data, 200);
        }
        return response(['message' => 'Not Enough Credits'], 200);
    }

    public function getLadderPostEnrollment(Request $request)
    {
        $ladder_requests = LadderPostEnrollment::where('ladder_post_id', $request->ladder_post_id)
            ->with(['team.team_members', 'ladder_post.game', 'ladder_post.host'])
            ->where('status', 'ACCEPTED')
            ->first();
        return response($ladder_requests, 200);
    }

    public function acceptRequest(Request $request)
    {
        $ladder_request = LadderPostEnrollment::findOrFail($request->ladder_request_id);
        $ladder_request->status = 'ACCEPTED';
        $ladder_request->save();
        $ladder_post = LadderPost::findOrFail($ladder_request->ladder_post_id);
        $ladder_post->guest_id = $ladder_request->user_id;
        $ladder_post->status = 'On going';
        $ladder_post->save();
        $ladder_rejected_requests = LadderPostEnrollment::where('ladder_post_id', $ladder_request->ladder_post_id)->where('id', '!=', $request->ladder_request_id)->get();

        foreach ($ladder_rejected_requests as $value) {
            $value->status = 'REJECTED';
            $value->save();
        }
        return response('Accepted the request', 200);
    }

    public function rejectRequest(Request $request)
    {
        $ladder_request = LadderPostEnrollment::findOrFail($request->ladder_request_id);
        $ladder_request->status = 'REJECTED';
        $ladder_request->save();
        return response('Rejected the request', 200);
    }
}
