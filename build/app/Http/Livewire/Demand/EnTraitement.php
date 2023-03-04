<?php

namespace App\Http\Livewire\Demand;

use App\Models\Demand;
use App\Models\Entity;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EnTraitement extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $search = '';
    public $user;
    public $userEntity;
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $this->user = Auth::user();
        $this->userEntity = $this->user ? $this->user->entity : null;
        $userEntityId = $this->userEntity->id;
        $userId = $this->user->id;

        return view('livewire.demand.en-traitement', [
            'demands' => Demand::where(function($query) use ($userEntityId, $userId) {
                $query->where('dealing_structure', $userEntityId)
                    ->orWhere(function($query) use ($userEntityId, $userId) {
                    $query->whereHas('structures', function($query) use ($userId, $userEntityId) {
                        $query->where('user_id', $userId)->orWhere(function($query) use ($userEntityId) {
                            $query->whereHas('chargeOf', function($query) use ($userEntityId) {
                                $query->where('entity_id', $userEntityId);
                            });
                        });
                    });
                });
            })
            ->where('state', 0)
            ->where(function($query) {
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
            })->orderBy('updated_at', 'desc')->paginate(10)
        ]);
    }
}

