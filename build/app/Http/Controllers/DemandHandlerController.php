<?php

namespace App\Http\Controllers;

use App\Models\DemandHandler;
use App\Http\Requests\StoreDemandHandlerRequest;
use App\Http\Requests\UpdateDemandHandlerRequest;

class DemandHandlerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreDemandHandlerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDemandHandlerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\DemandHandler  $demandHandler
     * @return \Illuminate\Http\Response
     */
    public function show(DemandHandler $demandHandler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DemandHandler  $demandHandler
     * @return \Illuminate\Http\Response
     */
    public function edit(DemandHandler $demandHandler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDemandHandlerRequest  $request
     * @param  \App\Models\DemandHandler  $demandHandler
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDemandHandlerRequest $request, DemandHandler $demandHandler)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DemandHandler  $demandHandler
     * @return \Illuminate\Http\Response
     */
    public function destroy(DemandHandler $demandHandler)
    {
        //
    }
}
