<?php

namespace App\Http\Controllers;

use App\Exports\UnfixedExport;
use App\Models\UnfixedService;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class UnfixedServiceController extends Controller
{
    /**
     * Permissions Allowed In This Controller.
     */
    function __construct()
    {
        $this->middleware('permission:Unfixed Workers List|Unfixed Workers Create|Unfixed Workers Edit|Unfixed Workers Destroy', ['only' => ['index', 'store']]);
        $this->middleware('permission:Unfixed Workers Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Unfixed Workers Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Unfixed Workers Destroy', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $unfixedEmps = UnfixedService::paginate(50);
        $total = UnfixedService::count();
        $onpermit = UnfixedService::whereNotNull('permit_id')->count();
        $free = UnfixedService::whereNull('permit_id')->count();
        return view('unfixed service.index', compact('unfixedEmps', 'total', 'free', 'onpermit'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('unfixed service.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'en_name' => 'required|string|max:75',
            'ar_name' => 'required|string|max:75',
            'en_job' => 'required|string|max:75',
            'ar_job' => 'required|string|max:75',
            'nid' => 'required|string|min:13|max:14|unique:unfixed_services,nid',
            'phone1' => 'nullable|string|min:10|max:11',
            'phone2' => 'nullable|string|min:10|max:11',
            'address' => 'nullable|string|max:150',
            'gender' => 'required|in:male,female',
            'active' => 'in:0,1'
        ]);
        $input = $request->all();
        if (isset($request->active)) {
            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        UnfixedService::create($input);
        return redirect()->route('unfixed.emps.index')->with(['success' => 'Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function show(UnfixedService $unfixedService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $worker = UnfixedService::find($id);
        return view('unfixed service.edit', compact('worker'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $worker = UnfixedService::find($id);
        $request->validate([
            'en_name' => 'required|string|max:75',
            'ar_name' => 'required|string|max:75',
            'en_job' => 'required|string|max:75',
            'ar_job' => 'required|string|max:75',
            'nid' => 'required|string|min:13|max:14|unique:unfixed_services,nid,' . $worker->id,
            'phone1' => 'nullable|string|min:10|max:11',
            'phone2' => 'nullable|string|min:10|max:11',
            'address' => 'nullable|string|max:150',
            'gender' => 'required|in:male,female',
            'active' => 'in:0,1'
        ]);
        $input = $request->all();
        if (isset($request->active)) {
            $input['active'] = '1';
        } else {
            $input['active'] = '0';
        }
        if (isset($request->blacklist)) {
            $input['blacklist'] = '1';
        } else {
            $input['blacklist'] = '0';
        }
        $worker->update($input);
        return redirect()->route('unfixed.emps.index')->with(['success' => 'updated Successfully']);
    }
    public function export()
    {
        return Excel::download(new UnfixedExport, 'unfixed.xlsx');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnfixedService  $unfixedService
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $worker = UnfixedService::find($id);
        $worker->delete();
        return redirect()->route('unfixed.emps.index')->with(['success' => 'Worker Deleted Successfully']);
    }
}
