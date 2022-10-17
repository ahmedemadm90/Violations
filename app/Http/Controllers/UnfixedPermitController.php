<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\Service_Company;
use App\Models\UnfixedPermit;
use App\Models\UnfixedService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnfixedPermitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Manage Own Permits - Unfixed', ['only' => ['ownUnfixedApprove', 'ownUnfixedReject']]);
        $this->middleware('permission:Manage Group Permits - Unfixed', ['only' => ['groupUnfixedApprove', 'groupUnfixedReject']]);
        $this->middleware('permission:Manage Safety Permits - Unfixed', ['only' => ['safetyUnfixedApprove', 'safetyUnfixedReject']]);
        $this->middleware('permission:Manage Security Permits - Unfixed', ['only' => ['securityUnfixedApprove', 'securityUnfixedReject']]);
        $this->middleware('permission:Request Unfixed Permits', ['only' => ['create','store']]);
        $this->middleware('permission:Edit Unfixed Permits', ['only' => ['edit','update']]);
        $this->middleware('permission:Destroy Unfixed Permits', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unfixed_permits = UnfixedPermit::paginate(15);
        return view('unfixed permits.index', compact('unfixed_permits'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unfixed_workers = UnfixedService::orderby('en_name')->get();
        $companies = Service_Company::where('active', '1')->get();
        $groups = Auth::user()->groups;
        return view('permits.unfixed.create', compact('unfixed_workers', 'companies', 'groups'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $workers_ids = [];
        $workers_names = [];
        $ar_workers_names = [];
        $request->validate([
            'company_id' => 'required|string|max:50',
            'workers_ids' => 'required|array',
            'start_date' => 'required',
            'end_date' => 'required',
            'shifts' => 'required',
        ]);
        $input = $request->all();
        foreach ($input['workers_ids'] as $nid) {
            $worker = UnfixedService::where('nid', $nid)->first();
            array_push($workers_ids, $nid);
            array_push($workers_names, $worker->en_name);
            array_push($ar_workers_names, $worker->ar_name);
        }
        $input['workers_names'] = $workers_names;
        $input['ar_workers_names'] = $ar_workers_names;
        $input['workers_ids'] = $workers_ids;
        $input['requested_by'] = Auth::user()->id;
        $new = UnfixedPermit::create($input);
        foreach ($workers_ids as $nid) {
            $worker = UnfixedService::where('nid', $nid)->first();
            $worker->update([
                'active' => '0',
                'permit_id' => $new->id,
                'company_id' => $request->company_id,
            ]);
        }
        return redirect()->route('permits.mypermits')->with(['success' => 'Permit Created Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permit = UnfixedPermit::find($id);
        return view('unfixed permits.show', compact('permit'));
    }
    function myPermit()
    {
        $unfixed_permits = UnfixedPermit::where('requested_by', Auth::user()->id)->paginate(50);
        return view('unfixed permits.mypermits', compact('unfixed_permits'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $permit = UnfixedPermit::find($id);
        $workers_ids = $permit->workers_ids;
        $workers_names = $permit->workers_names;
        $data = array_combine($workers_ids, $workers_names);
        return view('unfixed permits.edit', compact('permit', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $permit = UnfixedPermit::find($id);
        $request->validate([
            'company' => 'required|string|max:50',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $permit->update($request->all());
    }
    /* Start Group Unfixed Permits */
    public function ownUnfixedApprove($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Pending Safety Approve',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }

    public function ownUnfixedReject($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'active' => '0',
            'state' => 'Admin Rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->workers_ids as $id) {
            $worker = UnfixedService::where('nid', $id)->first();
            $worker->update([
                'permit_id' => NULL,
                'company_id' => NULL,
            ]);
        }
        return back();
    }
    /* End Own Unfixed Permits */

    /* Start Group Unfixed Permits */
    public function groupUnfixedApprove($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Pending Safety Approve',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }

    public function groupUnfixedReject($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'active' => '0',
            'state' => 'Admin Rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->workers_ids as $id) {
            $worker = UnfixedService::where('nid', $id)->first();
            $worker->update([
                'permit_id' => NULL,
                'company_id' => NULL,
            ]);
        }
        return back();
    }
    /* End Group Unfixed Permits */


    /* Start Safety Unfixed Permits */
    public function safetyUnfixedApprove($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'state' => 'Pending Security Approve',
            'is_safety_approved' => '1',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function safetyUnfixedreject($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'active' => '0',
            'state' => 'Safety Rejected',
            'is_safety_approved' => '0',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->workers_ids as $id) {
            $worker = UnfixedService::where('nid', $id)->first();
            $worker->update([
                'permit_id' => NULL,
            ]);
        }
        return back();
    }
    /* End Safety Unfixed Permits */

    /* Start Security Unfixed Permits */
    public function securityUnfixedApprove($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'active' => '1',
            'state' => 'Aproved',
            'is_security_approved' => '1',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function securityUnfixedReject($id)
    {
        $permit = UnfixedPermit::find($id);
        $permit->update([
            'active' => '0',
            'state' => 'Security Rejected',
            'is_security_approved' => '0',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->workers_ids as $id) {
            $worker = UnfixedService::where('nid', $id)->first();
            $worker->update([
                'permit_id' => NULL,
                'company_id' => NULL,
            ]);
        }
        return back();
    }
    /* End Security Unfixed Permits */

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UnfixedPermit  $unfixedPermit
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnfixedPermit $unfixedPermit, $id)
    {
        $worker = UnfixedPermit::find($id);
        $worker->delete();
        return redirect()->route('unfixed.permits.index')->with(['success' => 'Permit Deleted Successfully']);
    }
}
