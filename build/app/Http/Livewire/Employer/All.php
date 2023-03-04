<?php

namespace App\Http\Livewire\Employer;

use App\Models\Employer;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class All extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.employer.all', [
            'employers' => Employer::where(DB::raw('lower(raison_social)'), 'like', '%'.strtolower($this->search).'%')
                                ->orWhere(DB::raw('lower(email)'), 'like', '%'.strtolower($this->search).'%')
                                ->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
