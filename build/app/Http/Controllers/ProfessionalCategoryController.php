<?php

namespace App\Http\Controllers;

use App\Models\ProfessionalCategory;
use App\Http\Requests\StoreProfessionalCategoryRequest;
use App\Http\Requests\UpdateProfessionalCategoryRequest;

class ProfessionalCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.professional-category.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $professionalCategory = new ProfessionalCategory();
        return view('backoffice.pages.professional-category.create', compact('professionalCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProfessionalCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProfessionalCategoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProfessionalCategory  $professionalCategory
     * @return \Illuminate\Http\Response
     */
    public function show(ProfessionalCategory $professionalCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProfessionalCategory  $professionalCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(ProfessionalCategory $professionalCategory)
    {
        //
        return view('backoffice.pages.professional-category.edit', compact('professionalCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProfessionalCategoryRequest  $request
     * @param  \App\Models\ProfessionalCategory  $professionalCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessionalCategoryRequest $request, ProfessionalCategory $professionalCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProfessionalCategory  $professionalCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProfessionalCategory $professionalCategory)
    {
        //contracts
        $contracts = $professionalCategory->contracts;
        if(count($contracts) > 0) {
            return redirect()->back()->with('warning', 'Impossible de supprimer cette catégorie professionnel car elle contient des dependances');
        }
        $professionalCategory->delete();
        return redirect()->back()->with('success', 'Supprimer avec succès.');
    }
}
