<?php

namespace App\Http\Controllers;

use App\Models\GroupLocality;
use Illuminate\Http\Request;

class GroupLocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.locality-group.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $groupLocality = new GroupLocality();
        return view('backoffice.pages.locality-group.create', compact('groupLocality'));
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
     * @param  \App\Models\GroupLocality  $groupLocality
     * @return \Illuminate\Http\Response
     */
    public function show(GroupLocality $groupLocality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupLocality  $groupLocality
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupLocality $groupLocality)
    {
        //
        return view('backoffice.pages.locality-group.edit', compact('groupLocality'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupLocality  $groupLocality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupLocality $groupLocality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupLocality  $groupLocality
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupLocality $groupLocality)
    {
        //
        $countries = $groupLocality->localities;
        if(count($countries) > 0) {
            $groupLocality->localities()->detach($countries);
        }
        $groupLocality->delete();
        return redirect()->back()->with('success', 'Supprimer avec succès.');
    }
}
