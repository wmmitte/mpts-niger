<?php

namespace App\Http\Livewire\ProfessionalCategory;

use App\Models\ProfessionalCategory;
use Livewire\Component;
use Illuminate\Support\Str;

class ModelForm extends Component
{
    public $professionalCategory;
    public $action;
    public $wording;
    public $state;

    public function render()
    {
        return view('livewire.professional-category.model-form');
    }
    public function mount()
    {
        $this->state = $this->professionalCategory ? $this->professionalCategory->state ?? false : true;
        if($this->professionalCategory) {
            $this->wording = $this->professionalCategory->wording;
        }
    }

    public function onsubmitForm()
    {
        $excepted = $this->professionalCategory->id ? ','.$this->professionalCategory->id : '';
        $validatedData = $this->validate([
            'wording' => 'required|unique:professional_categories,wording'.$excepted,
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
        $professionalCategory = ProfessionalCategory::create($validatedData);
        return redirect()->route('professional-categories.create')->with('success', "La catégorie professionnelle $professionalCategory->wording enregistre avec succès !!!");
    }

    public function updatedForm($validatedData)
    {
        $this->professionalCategory->update($validatedData);
        $professionalCategoryWording = $this->professionalCategory->wording;
        return redirect()->route('professional-categories.edit', $this->professionalCategory)->with('success', "La catégorie professionnelle $professionalCategoryWording a été mise à jour avec succès !!!");
    }
}
