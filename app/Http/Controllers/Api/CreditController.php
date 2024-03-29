<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\Credit;
use App\Models\User;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    public function createCredit(Request $request)
    {
        $user = $request->user();
        $loggedInUser = User::where('id', $request->user()->id)->first();
        $user_credit  =  Credit::where('user_id', $user->id)->latest()->first();
        if ($user_credit) {
            $userCredit = $user_credit->user_credit + $request->amount;
        } else {
            $userCredit = $request->amount;
        }
        $loggedInUser->balance = $loggedInUser->balance + $userCredit;
        $loggedInUser->save();
        $credit  = Credit::create([
            'user_id' => $user->id,
            'transaction_id' => $request->transaction_id,
            'user_credit' => $userCredit,
            'type' => $request->type
        ]);
        return response($credit, 200);
    }

    public function getCredits()
    {
        $coins = Coin::get();
        // dd($coins->toArray());
        return response($coins, 200);
    }
}
