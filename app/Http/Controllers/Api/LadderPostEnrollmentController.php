<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\LadderPost;
use App\Models\LadderPostEnrollment;
use App\Models\LadderPostResult;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

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
        if ($request->user()->balance >= $ladder_post->fee) {
            $loggedInUser = User::where('id', $request->user()->id)->first();
            $loggedInUser->balance = $loggedInUser->balance - $ladder_post->fee;
            $loggedInUser->save();

            $ladder_post->challenger_team_id = $request->team_id;
            $ladder_post->status = 'Challenged';
            $ladder_post->save();

            $data = [
                'request' => $ladder_post
            ];
            return response($data, 200);
        }
        return response(['message' => 'Not Enough Credits'], 400);
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

    public function uploadLadderResult(Request $request)
    {
        $request->validate([
            'ladder_post_id' => 'required|integer',
            'winner_id' => 'required|integer',
            'losser_id' => 'required|integer',
            'proof' => 'required',
        ]);
        $ladder_post = LadderPost::where('id', $request->ladder_post_id)->first();
        $ladder_post->winner_team_id = $request->winner_id;
        $ladder_post->losser_team_id = $request->losser_id;
        $ladder_post->result_status = 'PENDING';

        if ($request->proof) {
            $path = public_path() . '/files/ladder_proofs/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $request->proof);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . time() . '.' . $request->proof->extension();
            $imageFullPath = $path . $imageName;
            file_put_contents($imageFullPath, $image_base64);
            $ladder_post->wining_proof = $imageName;
        }
        // dd($input);

        $data = $ladder_post->save();
        return response($data, 200);
    }
}
