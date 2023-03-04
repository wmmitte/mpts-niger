<?php

namespace App\Http\Livewire\Demand;

use App\Models\DemandFile;
use App\Models\DemandHandler;
use App\Models\Entity;
use App\Models\Reason;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Show extends Component
{
    use WithFileUploads;

    public $demand;
    public $workVisa;
    public $raison;
    public $avisTech;
    public $motif;
    public $attach;
    public $wording;
    public $user;
    public $userEntity;
    public $dge;
    public $daep;
    public $sg;
    public $ministrere;
    public $hasSummerPage;

    public function render()
    {
        return view('livewire.demand.show');
    }

    public function mount()
    {
        $this->workVisa = $this->demand->visa;
        $this->raison = '';
        $this->user = Auth::user();
        $this->userEntity = $this->user ? $this->user->entity : null;
        $this->daep = Entity::where('slug', Str::slug("DAEP/SMMO Ministère"))->first();
        $this->dge = Entity::where('slug', Str::slug("Direction general de l\'emploie"))->first();
        $this->sg = Entity::where('slug', Str::slug("SG Ministère"))->first();
        $this->ministrere = Entity::where('slug', Str::slug("Ministère"))->first();
    }

    public function avisTechnique()
    {
        // $this->validate([
        //     'raison' => 'required'
        // ]);
        switch ($this->demand->dealing_structure) {
            case $this->ministrere->id:
                # code...
                $this->gotoNextStep($this->daep, 'Decision du Ministre', 'decision');
                break;
            case $this->sg->id:
                # code...
                $this->gotoNextStep($this->ministrere, 'Avis technique du Sécrétaire Général', 'avis');
                break;
            case $this->dge->id:
                # code...
                $this->gotoNextStep($this->sg, 'Avis technique du Directeur Général de l\'emploi', 'avis');
                break;
            default:
                # code...
                $this->gotoNextStep($this->dge, 'Avis technique du Directeur DAEP/SMMO', 'avis');
                break;
        }
    }

    public function gotoNextStep($entity, $name, $etatRoute)
    {
        if($this->raison || $this->ministrere->id !== $this->userEntity->id) {
            Reason::create([
                'ref' => Str::uuid(),
                'name' => $name ?? '',
                'message' => $this->raison ? $this->raison : 'Aucune réaction',
                'user_id' => $this->user->id,
                'demand_id' => $this->demand->id,
            ]);
        }
        DemandHandler::create([
            'ref' => Str::uuid(),
            'user_id' => $this->user->id,
            'demand_id' => $this->demand->id,
        ]);
        $this->demand->dealing_structure = $entity ? ($entity->id ? $entity->id : null) : null;
        if($name == 'Decision du Ministre'){
            $this->demand->has_recours = false;
            $this->demand->state = 1;
        }
        $this->demand->save();
        if($etatRoute === 'decision') {
            return redirect()->route('demands.pour.decision')->with('success', 'Décision pris en compte avec succès !!!');
        } else if($etatRoute === 'avis') {
            return redirect()->route('demands.pour.avis')->with('success', 'Avis pris en compte avec succès !!!');
        }
        return redirect()->route('demands.index')->with('success', 'Enregister avec succès !!!');
    }

    public function rejected()
    {
        $this->validate([
            'motif' => 'required'
        ]);

        Reason::create([
            'ref' => Str::uuid(),
            'name' => 'Motif de rejet',
            'message' => $this->motif,
            'user_id' => $this->user->id,
            'demand_id' => $this->demand->id,
        ]);
        DemandHandler::create([
            'ref' => Str::uuid(),
            'user_id' => $this->user->id,
            'demand_id' => $this->demand->id,
        ]);
        $this->demand->state = -2;
        $this->demand->dealing_structure = $this->daep->id;
        $this->demand->save();
        return redirect()->route('demands.index')->with('success', 'Demande rejetée avec succès !!!');
    }

    public function recourGracieux()
    {
        $validatedData = $this->validate([
            'wording' => 'required',
            'avisTech' => 'required',
            'attach' => 'required|file|mimes:pdf',
        ]);
        $validatedData['ref'] = Str::uuid();
        $validatedData['type'] = 'demande';
        $validatedData['demand_id'] = $this->demand->id;
        $validatedData['url_file'] = $this->attach->store('demande_files');
        DemandFile::create($validatedData);

        Reason::create([
            'ref' => Str::uuid(),
            'name' => 'Avis technique recours gracieux',
            'message' => $this->avisTech ? $this->avisTech : 'Aucune réaction',
            'user_id' => $this->user->id,
            'demand_id' => $this->demand->id,
        ]);
        $this->demand->has_recours = true;
        $this->demand->state = 0;
        $this->demand->save();
        return redirect()->route('demande.states.recours')->with('success', 'Demande en recours gracieux avec succès !!!');
    }
}
