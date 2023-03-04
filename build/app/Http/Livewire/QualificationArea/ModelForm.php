<?php

namespace App\Http\Livewire\QualificationArea;

use App\Models\QualificationArea;
use Livewire\Component;
use Illuminate\Support\Str;

class ModelForm extends Component
{
    public $qualificationArea;
    public $action;
    public $wording;
    public $state;
    public function render()
    {
        return view('livewire.qualification-area.model-form');
    }
    public function mount()
    {
        $this->state = $this->qualificationArea ? $this->qualificationArea->state ?? false : true;
        if($this->qualificationArea) {
            $this->wording = $this->qualificationArea->wording;
        }
    }

    public function onsubmitForm()
    {
        $excepted = $this->qualificationArea->id ? ','.$this->qualificationArea->id : '';
        $validatedData = $this->validate([
            'wording' => 'required|unique:qualification_areas,wording'.$excepted,
            'state' => 'nullable'
        ]);
        if($this->action == 'post') {
            $this->storedForm($validatedData);
        } else {
            $this->updatedForm($validatedData);
        }
    }

    public function storedForm($validatedData)
    {
        $validatedData['ref'] = Str::uuid();
        $qualificationArea = QualificationArea::create($validatedData);
        return redirect()->route('qualification-areas.create')->with('success', "Le domaine de qualification $qualificationArea->wording enregistré avec succès !!!");
    }

    public function updatedForm($validatedData)
    {
        $this->qualificationArea->update($validatedData);
        $qualificationAreaWording = $this->qualificationArea->wording;
        return redirect()->route('qualification-areas.edit', $this->qualificationArea)->with('success', "Le domaine de qualification $qualificationAreaWording mise à jour avec succès !!!");
    }
}
