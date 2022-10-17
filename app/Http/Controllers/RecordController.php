<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $records = Record::where('user_id', Auth::user()->name)->get();
        return view('records.index', compact('records'))->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('records.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $request->validate([
            "truck_no" => "required",
            "driver_name" => "required",
            "driver_id" => "required",
            "company" => "required",
            "carage" => "nullable",
            "permit_id" => "nullable",
        ]);
        $input['user_id'] = auth()->user()->name;
        Record::create($input);
        return redirect(route('records.index'))->with(['success' => 'تم الاضافة بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record)
    {
        //
    }
    public function out($id)
    {
        $record = Record::find($id);
        $record->update([
            'time_out' => Carbon::now(),
        ]);
        return redirect(route('records.index'));
    }
    public function archive(Request $request)
    {
        $records = Record::all();
        return view('records.archive', compact('records'))
            ->with('i', ($request->input('page', 1) - 1) * 5);;
    }
    public function search(Request $request)
    {
        $records = Record::where('driver_id', 'like',  "%" . $request['search'] . "%")
            ->orWhere('driver_name', 'like',  "%" . $request['search'] . "%")
            ->orWhere('permit_id', 'like',  "%" . $request['search'] . "%")
            ->orWhere('carage', 'like',  "%" . $request['search'] . "%")
            ->orWhere('user_id', 'like',  "%" . $request['search'] . "%")
            ->orWhere('truck_no', 'like',  "%" . $request['search'] . "%")->get();

        return view('records.archive', compact('records'))
            ->with('i', ($request->input('page', 1) - 1) * 200);
    }
}
