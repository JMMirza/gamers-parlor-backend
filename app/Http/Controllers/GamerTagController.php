<?php

namespace App\Http\Controllers;

use App\Models\GamerTag;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use DataTables;

class GamerTagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = GamerTag::with('status')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('status', function ($row) {
                    return view('components.status_badge', ['row' => $row]);
                })
                ->addColumn('action', function ($row) {
                    return view('settings.gamer_tags.actions', ['row' => $row]);
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $statuses = Status::all();
        return view('settings.gamer_tags.gamer_tags', ['statuses' => $statuses]);
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
        $this->validations($request);

        GamerTag::create($request->all());
        return redirect()->route('gamer-tags.index')
            ->with('success', 'Gamer Tag created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GamerTag  $gamerTag
     * @return \Illuminate\Http\Response
     */
    public function show(GamerTag $gamerTag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GamerTag  $gamerTag
     * @return \Illuminate\Http\Response
     */
    public function edit(GamerTag $gamerTag)
    {
        $statuses = Status::all();
        return view('settings.gamer_tags.gamer_tags', ['statuses' => $statuses, 'gamerTag' => $gamerTag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GamerTag  $gamerTag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GamerTag $gamerTag)
    {
        $this->validations($request, $gamerTag);
        $gamerTag->update($request->all());

        return redirect()->route('gamer-tags.index')
            ->with('success', 'Gamer Tag updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GamerTag  $gamerTag
     * @return \Illuminate\Http\Response
     */
    public function destroy(GamerTag $gamerTag)
    {
        try {
            return $gamerTag->delete();
        } catch (QueryException $e) {
            print_r($e->errorInfo);
        }
    }

    private function validations($request, $update = null)
    {
        if ($update != null) {
            $validationArr = [
                'name' => 'required|unique:gamer_tags,name,' . $update->id,
                'status_id' => 'required|integer'
            ];
        } else {
            $validationArr = [
                'name' => 'required|unique:gamer_tags,name',
                'status_id' => 'required|integer'
            ];
        }
        $request->validate($validationArr, [
            'name.required' => 'Name is required!',
            'name.unique' => 'Name must be unique!',
            'status_id.required' => 'Select the status!'
        ]);
    }
}
