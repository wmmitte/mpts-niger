<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;

class Show extends Component
{
    public $employee;
    public function render()
    {
        return view('livewire.employee.show');
    }
}
