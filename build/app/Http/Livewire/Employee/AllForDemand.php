<?php

namespace App\Http\Livewire\Employee;

use App\Models\Employee;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class AllForDemand extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';

    public $demand;
    public $contract;
    public $employee_id;
    public $employeeSelected;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.employee.all-for-demand', [
            'employees' => Employee::where(DB::raw('lower(firstname)'), 'like', '%'.strtolower($this->search).'%')
                                ->orWhere(DB::raw('lower(lastname)'), 'like', '%'.strtolower($this->search).'%')
                                ->orWhere(DB::raw('lower(email)'), 'like', '%'.strtolower($this->search).'%')
                                ->orWhere(DB::raw('lower(phone)'), 'like', '%'.strtolower($this->search).'%')
                                ->orderBy('updated_at', 'desc')->paginate(10)
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
        $employee = $this->contract->employee;
        if($employee) {
            $this->employeeSelected = $employee;
            $this->employee_id = $employee->id;
        }
    }

    public function handlerBtn($employeeSelect)
    {
        $employee = $this->employeeSelected ?? null;
        if(!$employee) {
            $this->demand->step = 3;
            $this->demand->save();
        }
        $this->contract->employee_id = $employeeSelect['id'];
        $this->contract->save();

        return redirect()->route('demande.edit.employer', $this->demand)
                        ->with('success', !$this->employeeSelected ? 'Enregister' : 'Mise à jour'.' avec succès !!!');
    }
}
