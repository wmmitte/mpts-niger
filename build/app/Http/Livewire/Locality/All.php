<?php

namespace App\Http\Livewire\Locality;

use App\Models\Locality;
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
        return view('livewire.locality.all', [
            'localities' => Locality::where(DB::raw('lower(wording)'), 'like', '%'.strtolower($this->search).'%')
                                    ->where('type', $this->typeLocality)
                                    ->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
