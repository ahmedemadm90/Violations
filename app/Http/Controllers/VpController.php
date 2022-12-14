<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Vp;
use App\Models\Worker;
use Illuminate\Http\Request;
use Throwable;

class VpController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:VPS List|VPS Create|VPS Edit|VPS Delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:VPS Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:VPS Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:VPS Destroy', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $vps = Vp::orderBy('vp_name')->paginate(5);
        return view('vps.index', compact('vps'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }


    public function create()
    {
        $regions = Country::get();
        return view('vps.create', compact('regions'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'vp_name' => 'required|string|unique:vps,vp_name',
                'region_id' => 'required|exists:countries,id',
            ]);
            Vp::create([
                'vp_name' => $request->vp_name,
                'region_id' => $request->region_id,
            ]);
            return redirect()->route('vp.create')->with(['success' => 'VPs Created Successfully']);
        } catch (Throwable $th) {
            return back()->with(['error' => $th->getMessage()]);
        }

        return back();
    }

    public function show($id)
    {
        $vp = Vp::find($id);
        $workers = count(Worker::where('vp_id', $id)->get());
        return view('vps.show', [
            'vp' => $vp,
            'workers' => $workers
        ]);
    }


    public function edit($id)
    {
        $vp = Vp::find($id);
        $regions = Country::get();
        return view('vps.edit', compact('vp', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $vp = Vp::find($id);
        $request->validate([
            'vp_name' => 'required|string|max:50',
            'region_id' => 'required|exists:countries,id',
        ]);
        $input = $request->all();
        $vp->update($input);
        return back();
    }

    public function destroy($id)
    {
        $vp = Vp::find($id);
        try {
            $vp->delete();
            return redirect(route('vps.index'))->with(['success' => 'deleted successfully']);
        } catch (Throwable $e) {
            return redirect(route('vps.index'))->with(['error' => 'Something Went Wrong Contact Your System Admin']);
        }
    }
}
