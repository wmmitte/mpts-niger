<?php

namespace App\Http\Livewire\WorkVisa;

use Livewire\Component;

class RelauchConfirm extends Component
{
    public $workVisa;
    public $email_comment;
    public function render()
    {
        return view('livewire.work-visa.relauch-confirm');
    }
}
