<?php

namespace App\Http\Controllers;

use App\Models\Coin;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class CoinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Coin::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    return view('settings.credits.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('settings.credits.credits');
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
            'amount' => 'required'
        ];
        $request->validate($validationArr, [
            'credit.required' => 'Credit is required!',
            'amount.required' => 'Amount is required!'
        ]);

        // dd($request->all());
        Coin::create($request->all());
        return redirect()->route('coins.index')
            ->with('success', 'Credit created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function show(Coin $coin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function edit(Coin $coin)
    {
        return view('settings.credits.credits', ['coin' => $coin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coin $coin)
    {
        $validationArr = [
            'credit' => 'required',
            'amount' => 'required'
        ];
        $request->validate($validationArr, [
            'credit.required' => 'Credit is required!',
            'amount.required' => 'Amount is required!'
        ]);

        $coin->update($request->all());

        return redirect()->route('coins.index')
            ->with('success', 'Coin updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coin  $coin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coin $coin)
    {
        try {
            return $coin->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }
}
