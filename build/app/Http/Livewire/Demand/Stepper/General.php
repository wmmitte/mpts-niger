<?php

namespace App\Http\Livewire\Demand\Stepper;

use App\Models\Activity;
use App\Models\Demand;
use App\Models\DemandHandler;
use App\Models\Locality;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\Support\Str;

class General extends Component
{
    public $demand;
    public $sectors;
    public $branchs;
    public $countries;

    public $btnName;
    public $type;
    public $secteur;
    public $genre;
    public $nationalite;
    public $applicant_fullname;
    public $applicant_phone;
    public $applicant_email;
    public $activity_sector_id;
    public $industry_id;

    public function render()
    {
        return view('livewire.demand.stepper.general');
    }

    public function mount()
    {
        $this->btnName = 'Enregistrer et poursuivre';
        $this->countries = Locality::with(['localities' => function($query) {
            $query->with(['localities' => function($query) {
                $query->where('type', 'city');
            }])->where('type', 'district');
        }])->where('type', 'country')->get();

        if($this->demand) {
            $this->type = $this->demand->type;
            $this->secteur = $this->demand->secteur;
            $this->applicant_fullname = $this->demand->applicant_fullname;
            $this->applicant_phone = $this->demand->applicant_phone;
            $this->applicant_email = $this->demand->applicant_email;
            $this->activity_sector_id = $this->demand->activity_sector_id;
            $this->industry_id = $this->demand->industry_id;
            $this->genre = $this->demand->applicant_genre;
            $this->nationalite = $this->demand->applicant_nationalite;
            $this->btnName = 'Modifier et poursuivre';
        }
        $this->sectors = [];
        // $this->sectors = Activity::where('type', 'sector')->get();
        $this->branchs = [];
        if($this->secteur) {
            $this->branchs = Activity::where('secteur', $this->secteur)->get();
        }
        // $this->branchs = Activity::where('type', 'industry')->get();
    }

    public function updatedSecteur($value)
    {
        $this->branchs = [];
        if($value) {
            $this->branchs = Activity::where('secteur', $value)->get();
        }
    }

    public function saveData()
    {
        $excepted = $this->demand ? ($this->demand->id ? ','.$this->demand->id : '') : '';
        $validatedData = $this->validate([
            'type' => 'required',
            'applicant_fullname' => 'required',
            'applicant_phone' => 'required',
            'applicant_email' => 'required|email|unique:demands,applicant_email'.$excepted,
            // 'activity_sector_id' => 'required',
            //'secteur' => 'required',
            // 'industry_id' => 'required',
        ]);
        $demand = $this->demand ?? null;
        $user = Auth::user();

        $validatedData['applicant_genre'] = $this->genre;
        $validatedData['applicant_nationalite'] = $this->nationalite;
        if(!$demand) {
            $validatedData['ref'] = Str::uuid();
            $validatedData['user_id'] = $user ? $user->id : null;
            $validatedData['dealing_structure'] = $user ? ($user->entity ? $user->entity->id : null) : null;
            $demand = Demand::create($validatedData);
            DemandHandler::create([
                'ref' => Str::uuid(),
                'user_id' => $user->id,
                'demand_id' => $demand->id,
            ]);
        } else {
            $demand->update($validatedData);
        }
        return redirect()->route('demande.edit.contract', $demand)
                        ->with('success', !$this->demand ? 'Enregister' : 'Mise à jour'.' avec succès !!!');
    }
}
