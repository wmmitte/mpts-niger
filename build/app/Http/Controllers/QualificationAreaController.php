<?php

namespace App\Http\Controllers;

use App\Models\QualificationArea;
use App\Http\Requests\StoreQualificationAreaRequest;
use App\Http\Requests\UpdateQualificationAreaRequest;

class QualificationAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.qualification-area.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $qualificationArea = new QualificationArea();
        return view('backoffice.pages.qualification-area.create', compact('qualificationArea'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQualificationAreaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQualificationAreaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QualificationArea  $qualificationArea
     * @return \Illuminate\Http\Response
     */
    public function show(QualificationArea $qualificationArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QualificationArea  $qualificationArea
     * @return \Illuminate\Http\Response
     */
    public function edit(QualificationArea $qualificationArea)
    {
        //
        return view('backoffice.pages.qualification-area.edit', compact('qualificationArea'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateQualificationAreaRequest  $request
     * @param  \App\Models\QualificationArea  $qualificationArea
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQualificationAreaRequest $request, QualificationArea $qualificationArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QualificationArea  $qualificationArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(QualificationArea $qualificationArea)
    {
        //contracts
        $contracts = $qualificationArea->contracts;
        if(count($contracts) > 0) {
            return redirect()->back()->with('warning', 'Impossible de supprimer ce domaine de qualification car elle contient des dépendances');
        }
        $qualificationArea->delete();
        return redirect()->back()->with('success', 'Supprimer avec succès.');
    }
}
