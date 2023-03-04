<?php

namespace App\Http\Livewire\User;

use App\Models\Demand;
use Livewire\Component;
use Livewire\WithPagination;

class Demands extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $userId = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $demands = Demand::where('user_id', 'like', $this->userId);
        return view('livewire.user.demands', [
            'demands' => $demands->where(function($query) {
                                    $query->where('applicant_fullname', 'like', '%'.$this->search.'%')
                                    ->orWhere('applicant_phone', 'like', '%'.$this->search.'%')
                                    ->orWhere('applicant_email', 'like', '%'.$this->search.'%');
                                })
                                ->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
