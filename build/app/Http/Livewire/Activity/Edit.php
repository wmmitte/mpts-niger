<?php

namespace App\Http\Livewire\Activity;

use App\Models\Activity;
use Livewire\Component;

class Edit extends Component
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
        return view('livewire.activity.edit');
    }

    public function mount() {
        if($this->activity) {
            $this->activityId = $this->activity->activity_id ?? '';
            $this->wording = $this->activity->wording;
            $this->secteur = $this->activity->secteur;
        }
        $this->activities = [];
    }

    public function updateActivity() {
        $validatedData = $this->validate([
            'wording' => 'required|unique:localities,wording,'.$this->activity->id,
            'secteur' => 'required',
            'description' => 'nullable',
        ]);
        $validatedData['activity_id'] = !$this->activityId ? null : $this->activityId;
        $this->activity->update($validatedData);
        $activityWording = $this->activity->wording;
        return redirect()->route('activities.edit', $this->activity)->with('success', "Branche d'activité $activityWording a été mise à jour avec succès !!!");
    }
}
