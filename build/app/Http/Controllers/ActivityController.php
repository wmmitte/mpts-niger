<?php

namespace App\Http\Controllers;

use App\Models\activity;
use App\Http\Requests\StoreactivityRequest;
use App\Http\Requests\UpdateactivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.activity.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backoffice.pages.activity.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function show(activity $activity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function edit(activity $activity)
    {
        //
        return view('backoffice.pages.activity.edit', compact('activity'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\activity  $activity
     * @return \Illuminate\Http\Response
     */
    public function destroy(activity $activity)
    {
        //
        $activities = $activity->activities;
        if(count($activities) > 0) {
            return redirect()->back()->with('warning', 'Impossible de supprimer ce secteur d\activité car elle contient des branches d\'activité');
        }
        $activity->delete();
        return redirect()->back()->with('success', 'Supprimer avec succès.');
    }
}
