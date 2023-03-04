<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Http\Requests\StoreEmployerRequest;
use App\Http\Requests\UpdateEmployerRequest;

class EmployerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.employer.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backoffice.pages.employer.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function show(Employer $employer)
    {
        //
        return view('backoffice.pages.employer.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function edit(Employer $employer)
    {
        //
        return view('backoffice.pages.employer.edit', compact('employer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function updateEmployerState(Employer $employer)
    {
        $employer->etat = $employer->etat == 'actif' ? 'inactif' : 'actif';
        $employer->save();
        return redirect()->back()->with('success', "Etat mise à jour avec succès.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employer  $employer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employer $employer)
    {
        //
        $employer->delete();
        return redirect()->back()->with('success', 'Supprimer avec succès.');
    }
}
