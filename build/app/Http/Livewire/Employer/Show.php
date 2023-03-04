<?php

namespace App\Http\Livewire\Employer;

use Livewire\Component;

class Show extends Component
{
    public $employer;
    public function render()
    {
        return view('livewire.employer.show');
    }
}
