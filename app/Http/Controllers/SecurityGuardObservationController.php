<?php

namespace App\Http\Controllers;

use App\Models\SecurityGuardObservation;
use Illuminate\Http\Request;

class SecurityGuardObservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $observations = SecurityGuardObservation::paginate();
        return view('security guards observations.index', compact('observations'));
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
     * @param  \App\Models\SecurityGuardObservation  $securityGuardObservation
     * @return \Illuminate\Http\Response
     */
    public function show(SecurityGuardObservation $securityGuardObservation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SecurityGuardObservation  $securityGuardObservation
     * @return \Illuminate\Http\Response
     */
    public function edit(SecurityGuardObservation $securityGuardObservation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SecurityGuardObservation  $securityGuardObservation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SecurityGuardObservation $securityGuardObservation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SecurityGuardObservation  $securityGuardObservation
     * @return \Illuminate\Http\Response
     */
    public function destroy(SecurityGuardObservation $securityGuardObservation)
    {
        //
    }
}
