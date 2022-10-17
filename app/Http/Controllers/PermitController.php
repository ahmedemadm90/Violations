<?php

namespace App\Http\Controllers;


use App\Models\Permit;
use App\Models\Service_Company;
use App\Models\UnfixedPermit;
use App\Models\UnfixedService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermitController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Own Permits List', ['only' => ['mypermits']]);
        $this->middleware('permission:Group - Pending Permits', ['only' => ['permitsGroup']]);
        $this->middleware('permission:Safety - Pending Permits', ['only' => ['safetyindex']]);
        $this->middleware('permission:Security - Pending Permits', ['only' => ['securityindex']]);
        $this->middleware('permission:Manage Own Permits - Vehicles', ['only' => ['ownVehicleApprove', 'ownVehicleReject']]);
        $this->middleware('permission:Manage Own Permits - Private', ['only' => ['ownPrivateApprove', 'ownPrivateReject']]);
        $this->middleware('permission:Manage Group Permits - Vehicles', ['only' => ['groupVehicleApprove', 'groupVehicleReject']]);
        $this->middleware('permission:Manage Group Permits - Private', ['only' => ['groupPrivateApprove', 'groupPrivateApprove']]);
        $this->middleware('permission:Manage Safety Permits - Vehicles', ['only' => ['safetyVehicleApprove', 'safetyVehicleReject']]);
        $this->middleware('permission:Manage Safety Permits - Private', ['only' => ['safetyPrivateApprove', 'safetyPrivateReject']]);
        $this->middleware('permission:Manage Security Permits - Vehicles', ['only' => ['securityVehicleApprove', 'securityVehicleReject']]);
        $this->middleware('permission:Manage Security Permits - Private', ['only' => ['securityPrivateApprove', 'securityPrivateReject']]);
        $this->middleware('permission:Request Vehicles Permits', ['only' => ['securityPrivateApprove', 'securityPrivateReject']]);
        $this->middleware('permission:Request Private Permits', ['only' => ['securityPrivateApprove', 'securityPrivateReject']]);
    }

    /* Start My Permits & Responces */
    function mypermits()
    {
        $vehiclepermits = Permit::where('requested_by', Auth::user()->id)
            ->where('vehicle_type', '!=', 'private')->get();
        $privatepermits = Permit::where('requested_by', Auth::user()->id)
            ->where('vehicle_type', 'private')->get();
        $unfixedpermits = UnfixedPermit::where('requested_by', Auth::user()->id)->get();

        return view('permits.mypermits', [
            'vehiclepermits' => $vehiclepermits,
            'privatepermits' => $privatepermits,
            'unfixedpermits' => $unfixedpermits,
        ]);
    }
    public function ownVehicleApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Pending Safety Approve',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function ownVehicleReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Admin rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }
    public function ownPrivateApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Pending Safety Approve',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function ownPrivateReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Admin rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }

    /* End My Permits & Responces */
    public function permitsGroup()
    {
        if(isset(auth()->user()->groups)){
            $unfixedpermits = UnfixedPermit::where('state', 'pending')
            ->whereIn('group_id', auth()->user()->groups)->get();
            $vehiclepermits = Permit::where('vehicle_type', '!=', 'private')
            ->whereIn('group_id', auth()->user()->groups)
            ->where('state', '"pending"')
            ->get();
            $privatepermits = Permit::where('vehicle_type', 'private')
            ->whereIn('group_id', auth()->user()->groups)
            ->where('state', 'pending')
            ->get();
            return view('permits.groupindex', compact('unfixedpermits', 'vehiclepermits', 'privatepermits'));
        }else{
            return 403;
        }

    }
    public function groupVehicleApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Pending Safety Approve',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function groupVehicleReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Admin rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }
    public function groupPrivateApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Pending Safety Approve',
            'is_approved' => '1',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function groupPrivateReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Admin rejected',
            'is_approved' => '0',
            'state_change_by' => Auth::user()->id,
            'state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }

    /* Start Vehicles Functions*/
    public function vehiclecreate()
    {
        $drivers = UnfixedService::where('en_job', 'like', '%driver%')->orderBy('en_name')->get();
        $groups = Auth::user()->groups;
        $service_comps = Service_Company::get();
        return view('permits.vehicles.create', compact('drivers', 'groups', 'service_comps'));
    }
    public function vehiclestore(Request $request)
    {
        //dd($request->all());
        $input = $request->all();
        $request->validate([
            "type" => "required|in:daily,monthly",
            "date_from" => "required|max:10",
            "date_to" => "required|max:10",
            "vehicle_num" => "required|string",
            "vehicle_type" => "required|string",
            "vehicle_clr" => "required|string",
            'vehicle_drivers_id' => 'required',
            'vehicle_drivers_id*' => 'exists:unfixed_service,nid',
            "company_id" => "required|exists:service_companies,id",
            "mission" => "required|string",
            "group_id" => "required|string",
            'access_gate' => 'required|array',
            'allowed_sectors' => 'required|array',
            'movement_gates' => 'required|array',
        ]);
        if (count($request->vehicle_drivers_id) > 4) {
            return redirect()->route('permits.vehicle.create')->with(['error' => 'only 4 drivers are allowed in this type of permits']);
        } else {
            $input['drivers_count'] = count($request->vehicle_drivers_id);
        }
        $input['state'] = 'pending';
        $input['requested_by'] = Auth::user()->id;
        $permit = Permit::create($input);
        foreach ($input['vehicle_drivers_id'] as $nid) {
            $worker = UnfixedService::where('nid', $nid)->first();
            $worker->update([
                'permit_id' => $permit->id,
                'company_id' => $permit->company_id,
            ]);
        }
        return redirect()->route('permits.vehicle.create')->with(['success' => 'permit successfully created and pending approval']);
    }
    public function vehicleedit(Request $request, $id)
    {
        //dd($request->all());
        $input = $request->all();
        $permit = Permit::find($id);
        if ($permit->requested_by != Auth::user()->id) {
            return redirect()->route('permits.vehicle.index')->with(['error' => 'You Dont Have Permission To Do this Action']);
        }
        $drivers = UnfixedService::where('en_job', 'like', '%driver%')->orderBy('en_name')->get();
        $groups = Auth::user()->groups;
        $service_comps = Service_Company::get();
        return view('permits.vehicles.edit', compact('drivers', 'groups', 'service_comps', 'permit'));
    }
    public function privatecreate()
    {
        $drivers = UnfixedService::where('en_job', 'like', '%driver%')->orderBy('en_name')->get();
        $groups = Auth::user()->groups;
        $service_comps = Service_Company::get();
        return view('permits.private.create', compact('drivers', 'groups', 'service_comps'));
    }
    public function privatestore(Request $request)
    {
        //dd($request->all());
        $input = $request->all();
        $request->validate([
            "type" => "required|in:daily,monthly",
            "date_from" => "required|max:10",
            "date_to" => "required|max:10",
            "vehicle_num" => "required|string",
            "vehicle_clr" => "required|string",
            'vehicle_drivers_id' => 'required',
            'vehicle_drivers_id*' => 'exists:unfixed_service,nid',
            "company_id" => "required|exists:service_companies,id",
            "mission" => "required|string",
            "group_id" => "required|string",
            'access_gate' => 'required|array',
            'allowed_sectors' => 'required|array',
            'movement_gates' => 'required|array',
        ]);
        if (count($request->vehicle_drivers_id) > 4) {
            return redirect()->route('permits.vehicle.create')->with(['error' => 'only 4 drivers are allowed in this type of permits']);
        } else {
            $input['drivers_count'] = count($request->vehicle_drivers_id);
        }
        $input['vehicle_type'] = 'private';
        $input['state'] = 'pending';
        $input['requested_by'] = Auth::user()->id;
        $permit = Permit::create($input);
        foreach ($input['vehicle_drivers_id'] as $nid) {
            $worker = UnfixedService::where('nid', $nid)->first();
            $worker->update([
                'permit_id' => $permit->id,
                'company_id' => $permit->company_id,
            ]);
        }
        return redirect()->route('permits.vehicle.create')->with(['success' => 'permit successfully created and pending approval']);
    }
    /* End Vehicles Functions*/

    /* Start Group Admin Functions */

    /* End Group Admin Functions */

    /* Start Safety Functions */
    function safetyindex()
    {
        $vehiclepermits = Permit::where('vehicle_type', '!=', 'private')
            ->where('state', '"Pending Safety Approve"')
            ->get();
        $privatepermits = Permit::where('vehicle_type', 'private')
            ->where('state', '"Pending Safety Approve"')
            ->get();
        $unfixedpermits = UnfixedPermit::where('state', 'like', '%Pending Safety Approve%')
            ->get();
        return view('permits.safety.index', [
            'vehiclepermits' => $vehiclepermits,
            'privatepermits' => $privatepermits,
            'unfixedpermits' => $unfixedpermits,
        ]);
    }
    public function safetyVehicleApprove($id)
    {
        $permit = Permit::find($id);
        if (!$permit) {
            $permit = UnfixedService::find($id);
        }
        $permit->update([
            'state' => 'Pending Security Approve',
            'is_safety_approved' => '1',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function safetyVehicleReject($id)
    {
        $permit = Permit::find($id);
        if (!$permit) {
            $permit = UnfixedService::find($id);
        }
        $permit->update([
            'state' => 'Rejected By Safety',
            'is_safety_approved' => '0',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }
    public function safetyPrivateApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Pending Security Approve',
            'is_safety_approved' => '1',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function safetyPrivateReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Rejected By Safety',
            'is_safety_approved' => '0',
            'safety_state_change_by' => Auth::user()->id,
            'safety_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }
    /* End Safety Functions */

    /* Start Security Functions */
    function securityindex()
    {
        $vehiclepermits = Permit::where('vehicle_type', '!=', 'private')
            ->where('state', '"Pending Security Approve"')
            ->get();
        $privatepermits = Permit::where('vehicle_type', 'private')
            ->where('state', '"Pending Security Approve"')
            ->get();
        $unfixedpermits = UnfixedPermit::where('state', 'Pending Security Approve')->get();
        return view('permits.security.index', [
            'vehiclepermits' => $vehiclepermits,
            'privatepermits' => $privatepermits,
            'unfixedpermits' => $unfixedpermits,
        ]);
    }
    public function securityVehicleApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => "Active",
            'is_security_approved' => '1',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function securityVehicleReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Rejected By Security',
            'is_security_approved' => '0',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }
    public function securityPrivateApprove($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => "Active",
            'is_security_approved' => '1',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        return back();
    }
    public function securityPrivateReject($id)
    {
        $permit = Permit::find($id);
        $permit->update([
            'state' => 'Rejected By Security',
            'is_security_approved' => '0',
            'security_state_change_by' => Auth::user()->id,
            'security_state_change_time' => Carbon::now(),
        ]);
        foreach ($permit->vehicle_drivers_id as $nid) {
            $driver = UnfixedService::where('nid', $nid)->first();
            $driver->update([
                'company_id' => NULL,
                'permit_id' => NULL
            ]);
        }
        return back();
    }
    /* End Security Functions */
}
