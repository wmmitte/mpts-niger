<?php

namespace App\Http\Livewire\WorkVisa;

use App\Models\Demand;
use App\Models\WorkVisa;
use Carbon\Carbon;
use Livewire\Component;
use Illuminate\Support\Str;

class ModelForm extends Component
{
    public $workVisa;
    public $demand;
    public $demands;
    public $action;

    public $numero;
    public $demand_id;
    public $duration;
    public $start_date;
    public $end_date;
    public $date_decision;
    public $nom_ministre;
    public $observation;
    public $state;

    public function render()
    {
        return view('livewire.work-visa.model-form');
    }

    public function mount()
    {
        // $this->demands = Demand::where('state', 0)->get();
        $this->demands = Demand::where('state', 1)->get();

        $this->state = false;
        if($this->workVisa) {
            $this->numero = $this->workVisa->numero;
            $this->demand_id = $this->workVisa->demand_id ?? ($this->demand ? $this->demand->id : '');
            $this->duration = $this->workVisa->duration;
            $this->start_date = $this->workVisa->start_date ?
                Carbon::parse($this->workVisa->start_date)->toDateString() : '';
            $this->end_date = $this->workVisa->end_date ?
                Carbon::parse($this->workVisa->end_date)->toDateString() : '';
            $this->observation = $this->workVisa->observation;
            $this->state = $this->workVisa->state == -2 ? false : true;
        }
    }


    public function onsubmitForm()
    {
        $validateRule = [
            'numero' => 'nullable',
            'demand_id' => 'required',
            'duration' => 'required|integer',
            'start_date' => 'required|date',
            'nom_ministre' => 'required',
            'date_decision' => 'required',
            // 'start_date' => 'required|date|before:end_date',
            // 'end_date' => 'required|date',
            'observation' => 'nullable',
            'state' => 'nullable',
        ];
        $validatedData = $this->validate($validateRule);
        $validatedData['end_date'] = Carbon::parse($this->start_date)->addMonth((int)$this->duration)->toDateString();
        $validatedData['state'] = !$this->state ? -2 : 0;
        $this->demand->nom_ministre = $validatedData['nom_ministre'];
        $this->demand->date_decision = $validatedData['date_decision'];
        if($validatedData['state'] == 0) {
            $this->demand->state = 1;
        }
        $this->demand->save();
        if($this->action == 'post') {
            $this->storedForm($validatedData);
        } else {
            $this->updatedForm($validatedData);
        }
    }

    public function storedForm($validatedData)
    {
        $validatedData['ref'] = Str::uuid();
        $workVisa = WorkVisa::create($validatedData);
        return redirect()->route('work-visas.create')->with('success', "Le visa numéro $workVisa->numero enregistre avec succès !!!");
    }

    public function updatedForm($validatedData)
    {
        $this->workVisa->update($validatedData);
        $workVisaNumero = $this->workVisa->numero;
        return redirect()->route('work-visas.index')->with('success', "Le visa numéro $workVisaNumero mise à jour avec succès !!!");
    }
}
