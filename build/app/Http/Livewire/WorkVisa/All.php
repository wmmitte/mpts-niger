<?php

namespace App\Http\Livewire\WorkVisa;

use App\Models\WorkVisa;
use Illuminate\Support\Facades\Auth;
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
        $user = Auth::user();
        $userId = $user ? $user->id : null;
        $service = $user ? $user->entity : null;
        $userServiceId = $service ? $service->id : null;

        $visas = WorkVisa::whereHas('demand', function($query) use ($userServiceId, $userId) {
            $query->where(function($query) use ($userServiceId, $userId) {
                $query->where('dealing_structure', $userServiceId)->orWhere(function($query) use ($userServiceId, $userId) {
                    $query->whereHas('structures', function($query) use ($userId, $userServiceId) {
                        $query->where('user_id', $userId)->orWhere(function($query) use ($userServiceId) {
                            $query->whereHas('chargeOf', function($query) use ($userServiceId) {
                                $query->where('entity_id', $userServiceId);
                            });
                        });
                    });
                });
            });
        });
        return view('livewire.work-visa.all', [
            'workVisas' => 
            $visas->where(DB::raw('lower(numero)'), 'like', '%'.strtolower($this->search).'%')
            ->orWhere(function($query) {
                $query->whereHas('demand', function($query) {
                    $query->whereHas('contract', function($query) {
                    $query->whereHas('employee', function($query) {
                        $query->where(DB::raw("CONCAT_WS(' ', lower(firstname), lower(lastname))"), 'like', '%'.strtolower($this->search).'%')
                            ->orWhere(DB::raw("CONCAT_WS(' ', lower(lastname), lower(firstname))"), 'like', '%'.strtolower($this->search).'%')
                            ->orWhere(DB::raw('lower(email)'), 'like', '%'.strtolower($this->search).'%');
                    })->orWhere(function($query) {
                        $query->whereHas('employer', function($query) {
                            $query->where(DB::raw('lower(raison_social)'), 'like', '%'.strtolower($this->search).'%');
                        });
                    });
                });
                });
            })
                            ->orderBy('updated_at', 'desc')
                            ->paginate(10)
        ]);
    }
}
