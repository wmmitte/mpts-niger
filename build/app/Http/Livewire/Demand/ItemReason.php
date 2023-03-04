<?php

namespace App\Http\Livewire\Demand;

use Livewire\Component;

class ItemReason extends Component
{
    public $reason;
    public $readMore;
    public function render()
    {
        return view('livewire.demand.item-reason');
    }
    public function mount()
    {
        $this->readMore = false;
    }

    public function handlerReadMore()
    {
        $this->readMore = !$this->readMore;
    }
}
