<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coin;
use App\Models\Transaction;
use App\Models\UserCredit;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function createTransaction(Request $request)
    {
        $user = $request->user();

        $coin = Coin::findOrFail($request->coin_id);

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

        UserCredit::create([
            'user_id' => $user->id,
            'coin_id' => $coin->id,
            'transaction_id' => $transaction->id
        ]);

        return response($transaction, 200);
    }
}
