<?php

namespace App\Http\Livewire\Demand\Stepper;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employer as EmployerModel;

class Employer extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $demand;
    public $contract;
    public $employer_id;
    public $employerSelected;

    public $search = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.demand.stepper.employer', [
            'employers' => EmployerModel::where('raison_social', 'like', '%'.$this->search.'%')
                                        ->orderBy('created_at', 'asc')->paginate(10)
        ]);
    }

    public function mount()
    {
        if(!$this->demand) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }

        $this->contract = $this->demand->contract;
        if(!$this->contract) {
            return redirect()->route('demands.create')->with('error', 'Accès refusé.');
        }
        $employer = $this->contract->employer;
        if($employer) {
            $this->employerSelected = $employer;
            $this->employer_id = $employer->id;
        }
    }

    public function handlerBtn($employerSelect)
    {
        $employer = $this->employerSelected ?? null;
        if(!$employer) {
            $this->demand->step = 4;
            $this->demand->save();
        }
        $this->contract->employer_id = $employerSelect['id'];
        $this->contract->save();
        return redirect()->route('demande.edit.piece', $this->demand)
                        ->with('success', !$this->employerSelected ? 'Enregister' : 'Mise à jour'.' avec succès !!!');
    }
}
