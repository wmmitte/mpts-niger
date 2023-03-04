<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Http\Requests\StoreDemandRequest;
use App\Http\Requests\UpdateDemandRequest;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class DemandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('backoffice.pages.demand.en-enregistrement');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function demandeStatesRejected()
    {
        //
        return view('backoffice.pages.demand.rejected');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function demandeStatesRecours()
    {
        //
        return view('backoffice.pages.demand.recours');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function demandsPourAvis()
    {
        //
        return view('backoffice.pages.demand.pour-avis');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function demandsEnTraitement()
    {
        //
        return view('backoffice.pages.demand.en-traitement');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function demandsPourDecision()
    {
        //
        return view('backoffice.pages.demand.pour-decision');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $currentStep=0;
        $unlockStep=0;
        $demand=null;
        return view('backoffice.pages.demand.init', compact('demand', 'currentStep', 'unlockStep'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function show(Demand $demand)
    {
        //
        return view('backoffice.pages.demand.show', compact('demand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function edit(Demand $demand)
    {
        //
        $userConnect = Auth::user();
        $service = $userConnect ? $userConnect->entity : null;
        $daep = Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $currentStep = 0;
        $unlockStep = $demand->step;
        // dd();
        if(!$demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        // if($demand->state === 1) {
        //     return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        // }
        if(($demand->state >= 0 || $demand->state == -2) &&
            !(Gate::allows('agent-privilege') && $service->id === $demand->dealing_structure)) {
            return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        }
        return view('backoffice.pages.demand.new', compact('demand', 'currentStep', 'unlockStep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function editDemandContract(Demand $demand)
    {
        //
        $userConnect = Auth::user();
        $service = $userConnect ? $userConnect->entity : null;
        $daep = Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $currentStep=1;
        $unlockStep = $demand->step;
        if(!$demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        // if($demand->state === 1) {
        //     return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        // }
        // if(($demand->state >= 0 || $demand->state == -2) && !Gate::allows('directeur-privilege')) {
        if(($demand->state >= 0 || $demand->state == -2) &&
            !(Gate::allows('agent-privilege') && $service->id === $demand->dealing_structure)) {
            return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        }
        return view('backoffice.pages.demand.new', compact('demand', 'currentStep', 'unlockStep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function editDemandEmployee(Demand $demand)
    {
        //
        $userConnect = Auth::user();
        $service = $userConnect ? $userConnect->entity : null;
        $daep = Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $currentStep=2;
        $unlockStep = $demand->step;
        if(!$demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        if(!$demand->contract) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        // if($demand->state === 1) {
        //     return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        // }
        if(($demand->state >= 0 || $demand->state == -2) &&
            !(Gate::allows('agent-privilege') && $service->id === $demand->dealing_structure)) {
            return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        }
        return view('backoffice.pages.demand.new', compact('demand', 'currentStep', 'unlockStep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function editDemandEmployer(Demand $demand)
    {
        //
        $userConnect = Auth::user();
        $service = $userConnect ? $userConnect->entity : null;
        $daep = Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $currentStep=3;
        $unlockStep = $demand->step;
        if(!$demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        if(!$demand->contract) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        // if($demand->state === 1) {
        //     return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        // }
        if(($demand->state >= 0 || $demand->state == -2) &&
            !(Gate::allows('agent-privilege') && $service->id === $demand->dealing_structure)) {
            return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        }
        return view('backoffice.pages.demand.new', compact('demand', 'currentStep', 'unlockStep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function editDemandPiece(Demand $demand)
    {
        //
        $userConnect = Auth::user();
        $service = $userConnect ? $userConnect->entity : null;
        $daep = Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $currentStep=4;
        $unlockStep = $demand->step;
        if(!$demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        if(!$demand->contract) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        if(!$demand->contract->employee || !$demand->contract->employer) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        // if($demand->state === 1) {
        //     return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        // }
        if(($demand->state >= 0 || $demand->state == -2) &&
            !(Gate::allows('agent-privilege') && $service->id === $demand->dealing_structure)) {
            return redirect()->route('demands.show', $demand)->with('error', 'Accès refusé.');
        }
        return view('backoffice.pages.demand.new', compact('demand', 'currentStep', 'unlockStep'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function editDemandEnd(Demand $demand)
    {
        //
        $userConnect = Auth::user();
        $service = $userConnect ? $userConnect->entity : null;
        $daep = Entity::where('slug', Str::slug('DAEP/SMMO Ministère'))->first();
        $currentStep = 5;
        $unlockStep = $demand->step;
        if(!$demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        // if(!$demand->piece) {
        //     return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        // }
        return view('backoffice.pages.demand.new', compact('demand', 'currentStep', 'unlockStep'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDemandRequest  $request
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDemandRequest $request, Demand $demand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demand  $demand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demand $demand)
    {
        //
        $contract = $demand->contract;
        $demandFiles = $demand->demandFiles;
        if($demandFiles) {
            foreach ($demandFiles as $demandFile) {
                $demandFile->delete();
            }
        }
        $structures = $demand->structures;
        if($structures) {
            foreach ($structures as $structure) {
                $structure->delete();
            }
        }
        $demand->delete();
        if($contract) {
            $contract->delete();
        }
        return redirect()->route('demands.index')->with('success', 'Suppression de la demande effectuée avec succès.');
    }
}
