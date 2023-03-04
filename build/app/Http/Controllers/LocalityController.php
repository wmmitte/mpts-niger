<?php

namespace App\Http\Controllers;

use App\Models\Locality;
use App\Http\Requests\StoreLocalityRequest;
use App\Http\Requests\UpdateLocalityRequest;

class LocalityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.locality.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backoffice.pages.locality.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function show(Locality $locality)
    {
        //
        return view('backoffice.pages.locality.show', compact('locality'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function edit(Locality $locality)
    {
        //
        return view('backoffice.pages.locality.edit', compact('locality'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Locality  $locality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Locality $locality)
    {
        //
        $localities = $locality->localities;
        if(count($localities) > 0) {
            return redirect()->back()->with('warning', 'Impossible de supprimer cette localité car elle contient des dependances');
        }
        $locality->delete();
        return redirect()->back()->with('success', 'Supprimer avec succès.');
    }
}
