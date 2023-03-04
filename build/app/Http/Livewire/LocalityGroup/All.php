<?php

namespace App\Http\Livewire\LocalityGroup;

use App\Models\GroupLocality;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class All extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $typeLocality = 'continent';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.locality-group.all', [
            'groups' => GroupLocality::where(DB::raw('lower(wording)'), 'like', '%'.strtolower($this->search).'%')
                                    ->withCount('localities')
                                    ->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
