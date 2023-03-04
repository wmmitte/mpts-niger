<?php

namespace App\Http\Livewire\User;

use App\Models\User;
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
        $userConnect = Auth::user();
        $userEntityId = $userConnect->entity_id ?? null;
        $users = null;
        if ($userConnect->role == 'admin' || $userConnect->role == 'super' || $userConnect->role == 'observateur') {
            $users = User::where(function($query) {
                $query->where('role', '!=', 'super');
            })->where(function($query) {
                $query->where(DB::raw('lower(firstname)'), 'like', '%'.strtolower($this->search).'%')
                            ->orWhere(DB::raw('lower(lastname)'), 'like', '%'.strtolower($this->search).'%');
                })->orderBy('updated_at', 'desc')->paginate(10);
        } else if ($userConnect->role !== 'agent') {
            $users = User::with('entity')->where(function($query) use ($userEntityId) {
                $query->where('entity_id', $userEntityId)
                    ->orWhere(function($query) use ($userEntityId) {
                        $query->whereHas('entity', function($query) use ($userEntityId) {
                            $query->where('entity_id', $userEntityId);
                        });
                    });
            })->where(function($query) {
                $query->where(DB::raw('lower(firstname)'), 'like', '%'.strtolower($this->search).'%')
                ->orWhere(DB::raw('lower(lastname)'), 'like', '%'.strtolower($this->search).'%');
            })->orderBy('updated_at', 'desc')->paginate(10);
        }
        return view('livewire.user.all', [
            'users' => $users,
            'userConnectInfo' => $userConnect,
        ]);
    }
}
