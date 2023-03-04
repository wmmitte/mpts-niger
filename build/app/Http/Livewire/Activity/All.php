<?php

namespace App\Http\Livewire\Activity;

use App\Models\Activity;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class All extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $secteur = 'tous';
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $_secteur = !$this->secteur ||
                    $this->secteur == '' ||
                    $this->secteur == 'tous' ? '' : $this->secteur;

        return view('livewire.activity.all',[
            'activities' => Activity::where(DB::raw('lower(wording)'), 'like', '%'.strtolower($this->search).'%')
                                        ->where('secteur', 'like', '%'.$_secteur.'%')
                                        ->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}
