<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubscriptionPrice;
use App\Models\Transaction;
use App\Models\UserSubscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    public function purchaseSubscription(Request $request)
    {
        $user = $request->user();

        $coin = SubscriptionPrice::findOrFail($request->sub_id);

        $transaction  = Transaction::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'currency' => $request->currency,
            'transaction_id' => $request->transaction_id,
            'full_name' => $request->full_name,
            'address_line_1' => $request->address_line_1,
            'address_line_2' => $request->address_line_2,
            'admin_area_2' => $request->admin_area_2,
            'postal_code' => $request->postal_code,
            'country_code' => $request->country_code,
            'payment_json' => json_encode($request->payment_json),
            'status' => 'PENDING'
        ]);

        UserSubscription::create([
            'user_id' => $user->id,
            'subscription_id' => $coin->id,
            'transaction_id' => $transaction->id,
            'status' => 'PENDING'
        ]);

        $user->is_vip = 1;
        $user->membership_time = Carbon::now();
        $user->save();

        return response($transaction, 200);
    }

    public function getSub()
    {
        $subs = SubscriptionPrice::get();
        // dd($subs->toArray());
        return response($subs, 200);
    }
}
