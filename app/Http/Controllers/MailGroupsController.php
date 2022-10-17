<?php

namespace App\Http\Controllers;

use App\Models\MailGroup;
use App\Models\MailGroups;
use Illuminate\Http\Request;

class MailGroupsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $groups = MailGroup::paginate();
        return view('mail groups.index', compact('groups'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MailGroups  $mailGroups
     * @return \Illuminate\Http\Response
     */
    public function show(MailGroups $mailGroups)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MailGroups  $mailGroups
     * @return \Illuminate\Http\Response
     */
    public function edit(MailGroups $mailGroups)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MailGroups  $mailGroups
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MailGroups $mailGroups)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MailGroups  $mailGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy(MailGroups $mailGroups)
    {
        //
    }
}
