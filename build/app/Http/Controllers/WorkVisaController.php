<?php

namespace App\Http\Controllers;

use App\Models\WorkVisa;
use App\Http\Requests\StoreWorkVisaRequest;
use App\Http\Requests\UpdateWorkVisaRequest;
use App\Models\Demand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class WorkVisaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.work-visa.all');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $workVisa = new WorkVisa();
        return view('backoffice.pages.work-visa.create', compact('workVisa'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \App\Models\Demand $demand
     * @return \Illuminate\Http\Response
     */
    public function createWithDemand(Demand $demand)
    {
        //
        // dd($demand);
        $workVisa = new WorkVisa();
        return view('backoffice.pages.work-visa.create-with-demand', compact('workVisa', 'demand'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWorkVisaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWorkVisaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkVisa  $workVisa
     * @return \Illuminate\Http\Response
     */
    public function show(WorkVisa $workVisa)
    {
        //
        return view('backoffice.pages.work-visa.show', compact('workVisa'));
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WorkVisa  $workVisa
     * @return \Illuminate\Http\Response
     */
    public function confirmRelauch(Request $request, WorkVisa $workVisa)
    {
        //
        $request->validate([
            "email_comment" => 'required',
        ]);
        $workVisa->email_comment = $request->email_comment;
        $workVisa->save();
        return redirect()->route('work-visas.show', $workVisa)->with('success', "Clôture de l'alerte de relance avec succès.");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WorkVisa  $workVisa
     * @return \Illuminate\Http\Response
     */
    public function edit(WorkVisa $workVisa)
    {
        //
        if($workVisa->state !== -2 && !Gate::allows('directeur-privilege')) {
            return redirect()->route('work-visas.index')->with('warning', 'Impossible de modifier ce visa !!!');
        }

        return view('backoffice.pages.work-visa.edit', compact('workVisa'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWorkVisaRequest  $request
     * @param  \App\Models\WorkVisa  $workVisa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWorkVisaRequest $request, WorkVisa $workVisa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WorkVisa  $workVisa
     * @return \Illuminate\Http\Response
     */
    public function destroy(WorkVisa $workVisa)
    {
        //
        if($workVisa->state !== -2 && !Gate::allows('directeur-privilege')) {
            return redirect()->route('work-visas.index')->with('warning', 'Impossible de supprimer ce visa !!!');
        }

        $workVisa->demand->state = 0;
        $workVisa->demand->save();

        $workVisa->delete();
        return redirect()->back()->with('success', 'Supprimer avec succès.');
    }
}
