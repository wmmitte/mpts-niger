<?php

namespace App\Http\Livewire\LocalityGroup;

use App\Models\GroupLocality;
use App\Models\Locality;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class ModelForm extends Component
{
    use WithFileUploads;

    public $groupLocality;
    public $action;

    public $wording;
    public $flat;
    public $countries;
    public $selectedCountries;
    public $state;

    public function render()
    {
        return view('livewire.locality-group.model-form');
    }

    public function mount()
    {
        $this->selectedCountries = [];

        $this->countries = Locality::where('type', 'country')->get();
        $this->state = $this->groupLocality ? $this->groupLocality->state ?? false : true;
        if($this->groupLocality) {
            $this->wording = $this->groupLocality->wording;
            $this->selectedCountries = $this->groupLocality->localities ?
                        $this->groupLocality->localities->pluck('id') : [];
        }
    }

    public function onsubmitForm()
    {
        $excepted = $this->groupLocality->id ? ','.$this->groupLocality->id : '';
        $validatedData = $this->validate([
            'wording' => 'required|unique:professional_categories,wording'.$excepted,
            'flat' => 'nullable',
            'selectedCountries' => 'array',
            'state' => 'nullable'
        ]);

        $validatedData['ref'] = Str::uuid();
        if($this->action == 'post') {
            $this->storedForm($validatedData);
        } else {
            $this->updatedForm($validatedData);
        }
    }

    public function storedForm($validatedData)
    {
        $group = GroupLocality::create($validatedData);
        $group->localities()->attach($this->selectedCountries);
        return redirect()->route('group-localities.create')->with('success', "Le groupe de pays $group->wording a été enregistré avec succès !!!");
    }

    public function updatedForm($validatedData)
    {
        $localities = $this->groupLocality->localities;
        $this->groupLocality->localities()->detach($localities);
        $this->groupLocality->update($validatedData);
        $this->groupLocality->localities()->attach($this->selectedCountries);
        $groupWording = $this->groupLocality->wording;
        return redirect()->route('group-localities.edit', $this->groupLocality)->with('success', "Le groupe de pays $groupWording a été mise à jour avec succès !!!");

    }
}
