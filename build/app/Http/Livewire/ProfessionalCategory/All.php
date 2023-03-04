<?php

namespace App\Http\Livewire\ProfessionalCategory;

use App\Models\ProfessionalCategory;
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
        return view('livewire.professional-category.all', [
            'professionalCategories' => ProfessionalCategory::where(DB::raw('lower(wording)'), 'like', '%'.strtolower($this->search).'%')
                                    ->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
