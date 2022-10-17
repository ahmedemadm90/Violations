<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:Groups List|Groups Create|Groups Edit|Groups Delete|Groups Show', ['only' => ['index', 'store']]);
        $this->middleware('permission:Groups List', ['only' => ['index']]);
        $this->middleware('permission:Groups Create', ['only' => ['create', 'store']]);
        $this->middleware('permission:Groups Edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:Groups Destroy', ['only' => ['destroy']]);
        $this->middleware('permission:Groups Show', ['only' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $groups = Group::simplePaginate(5);
        return view('groups.index', compact('groups'))
            ->with('i', ($request->input('page', 1) - 1) * 5);;
    }

    public function create()
    {
        $users = User::get();
        return view('groups.create', compact('users'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'group_name' => 'required|string|max:25|unique:groups,group_name',
            //'users_id' => 'required',
        ]);
        Group::create($request->all());
        return redirect()->route('group.create');
    }
    public function show($id)
    {
        $group = Group::find($id);
        //$users = User::get();
        return view('groups.show', compact('group'));
    }


    public function edit($id)
    {
        $group = Group::find($id);
        return view('groups.edit', compact('group'));
    }


    public function update(Request $request, $id)
    {
        $group = Group::find($id);
        $request->validate([
            'group_name' => 'required|string|max:25',
            //'users_id' => 'required',
        ]);
        $group->update($request->all());
        return back();
    }


    public function destroy($id)
    {
        $group = Group::find($id);
        $group->delete();
        return redirect()->route('groups.index');
    }
}
