<?php

namespace App\Http\Controllers;

use App\Models\SubscriptionPrice;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class SubscriptionPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SubscriptionPrice::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('settings.subscriptions.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('settings.subscriptions.subscriptions');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validationArr = [
            'credit' => 'required',
            'no_of_months' => 'required'
        ];
        $request->validate($validationArr, [
            'credit.required' => 'Credit is required!',
            'no_of_months.required' => 'Month is required!'
        ]);

        // dd($request->all());
        SubscriptionPrice::create($request->all());
        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubscriptionPrice  $subscriptionPrice
     * @return \Illuminate\Http\Response
     */
    public function show(SubscriptionPrice $subscriptionPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubscriptionPrice  $subscriptionPrice
     * @return \Illuminate\Http\Response
     */
    public function edit(SubscriptionPrice $subscription)
    {
        // dd($subscription->toArray());
        return view('settings.subscriptions.subscriptions', ['subscriptionPrice' => $subscription]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubscriptionPrice  $subscriptionPrice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubscriptionPrice $subscription)
    {
        $validationArr = [
            'credit' => 'required',
            'no_of_months' => 'required'
        ];
        $request->validate($validationArr, [
            'credit.required' => 'Credit is required!',
            'no_of_months.required' => 'Month is required!'
        ]);

        $subscription->update($request->all());

        return redirect()->route('subscriptions.index')
            ->with('success', 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubscriptionPrice  $subscriptionPrice
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubscriptionPrice $subscription)
    {
        try {
            // dd($subscription->toArray());
            return $subscription->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
