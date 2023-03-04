<?php

namespace App\Http\Livewire\Decision;

use Carbon\Carbon;
use Livewire\Component;

class Couriel extends Component
{
    public $demand;
    public $fullField;

    public $paragrapheOneCouriel;
    public $paragrapheTwoCouriel;
    public $paragrapheThreeCouriel;
    public $paragrapheFourCouriel;
    public $paragrapheFiveCouriel;
    public $amOneCouriel;
    public $amTwoCouriel;
    public $amThreeCouriel;
    public $refCouriel;
    public $objetCouriel;
    public $numeroCouriel;
    public $ministreName;
    public $dateDecision;

    public function render()
    {
        return view('livewire.decision.couriel');
    }

    public function mount()
    {
        $this->paragrapheOneCouriel = $this->demand->paragraphe_one_couriel;
        $this->paragrapheTwoCouriel = $this->demand->paragraphe_two_couriel;
        $this->paragrapheThreeCouriel = $this->demand->paragraphe_three_couriel;
        $this->paragrapheFourCouriel = $this->demand->paragraphe_four_couriel;
        $this->paragrapheFiveCouriel = $this->demand->paragraphe_five_couriel;
        $this->amOneCouriel = $this->demand->am_one_couriel;
        $this->amTwoCouriel = $this->demand->am_two_couriel;
        $this->amThreeCouriel = $this->demand->am_three_couriel;
        $this->refCouriel = $this->demand->ref_couriel;
        $this->objetCouriel = $this->demand->objet_couriel ? $this->demand->objet_couriel : 'Retour de contrat';
        $this->numeroCouriel = $this->demand->numero_couriel;
        $this->ministreName = $this->demand->nom_ministre;
        $this->dateDecision = $this->demand->date_decision ? Carbon::parse($this->demand->date_decision)->toDateString() : '';
    }

    public function genrerCourier()
    {

        $validatedData = $this->validate([
            'dateDecision' => 'required',
            'ministreName' => 'required',
            'numeroCouriel' => 'nullable',
            'objetCouriel' => 'required',
            'refCouriel' => 'nullable',
            'amOneCouriel' => 'required',
            'amTwoCouriel' => 'required',
            'amThreeCouriel' => 'nullable',
            'paragrapheOneCouriel' => 'nullable',
            'paragrapheTwoCouriel' => 'nullable',
            'paragrapheThreeCouriel' => 'nullable',
            'paragrapheFourCouriel' => 'nullable',
            'paragrapheFiveCouriel' => 'nullable',
        ]);

        return route('demande.couriel.generate', $this->demand);
    }
}
