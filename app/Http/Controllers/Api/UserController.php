<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\User;
use App\Models\UserCredit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function updateProfile(Request $request)
    {
        $user = $request->user();
        $input = $request->all();

        if ($request->has('password')) {
            $request->validate([
                'password' => 'required|string'
            ]);
            $input['password'] = bcrypt($request->password);
        }

        if ($request->avatar) {
            $path = public_path() . '/images/';
            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $image_parts = explode(";base64,", $request->avatar);
            $image_type_aux = explode("image/", $image_parts[0]);
            $image_type = $image_type_aux[1];
            $image_base64 = base64_decode($image_parts[1]);
            $imageName = uniqid() . '.png';
            $imageFullPath = $path . $imageName;
            file_put_contents($imageFullPath, $image_base64);
            $input['avatar'] = $imageName;
        } else {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'date_of_birth' => ['required']
            ]);
            $input['name'] = $request->name;
            $input['date_of_birth'] = $request->date_of_birth;
        }
        $user->update($input);
        return response($user, 200);
    }

    public function getUserProfile(Request $request)
    {
        $user_email = $request->user()->email;
        $user = User::where('email', $user_email)->with('game_tags.game_tag')->first();
        return response($user, 200);
    }

    public function searchUser(Request $request)
    {
        if (isset($request->user_name)) {
            $users = User::where('name', 'LIKE', '%' . $request->user_name . '%')->get();
            return response($users, 200);
        }
    }

    public function getAllUser()
    {
        $users = User::all();
        return $users;
    }

    public function credits(Request $request)
    {
        $credits = UserCredit::where('user_id', $request->user()->id)->with(['user', 'transaction', 'coin'])
            ->whereHas('transaction', function ($q) {
                $q->where('status', 'COMPLETE');
            })->get();

        $amount = 0;
        foreach ($credits as $credit) {
            $amount = $credit->coin->credit + $amount;
        }
        return response($amount, 200);
    }

    public function getGames(Request $request)
    {
        $games = Game::where('platform_id', $request->platform_id)->get();
        return response($games, 200);
    }
}
