<?php

namespace App\Http\Livewire\Activity;

use App\Models\Activity;
use Livewire\Component;
use Illuminate\Support\Str;

class Create extends Component
{
    public $activity;
    public $activityId;
    public $activities;
    public $wording;
    public $state;
    public $secteur;
    public $description;

    public function render()
    {
        return view('livewire.activity.create');
    }

    public function mount() {
        $this->activities = [];
        // $this->activities = Activity::where('type', 'sector')->get();
    }

    public function saveActivity() {
        $validatedData = $this->validate([
            'wording' => 'required|unique:localities,wording',
            'secteur' => 'required',
            'description' => 'nullable',
        ]);

        $validatedData['ref'] = Str::uuid();
        $validatedData['activity_id'] = $this->activityId ? $this->activityId : null;
        $activity = Activity::create($validatedData);
        return redirect()->route('activities.create')->with('success', "Branche d'activité $activity->wording a été enregistrée avec succès !!!");
    }
}
