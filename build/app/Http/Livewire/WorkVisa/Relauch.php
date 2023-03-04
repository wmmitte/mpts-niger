<?php

namespace App\Http\Livewire\WorkVisa;

use App\Models\WorkVisa;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class Relauch extends Component
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

        $dateCompare = Carbon::now()->addMonth(2);

        $visas = WorkVisa::where('email_comment', null)->whereDate('end_date', '<=', $dateCompare)
            ->whereHas('demand', function($query) use ($userServiceId, $userId) {
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
            })->latest();

            $_visas = clone $visas;
            $nbrVisa = $visas->get()->count();
        return view('livewire.work-visa.relauch', [
            'workVisas' => $_visas->paginate(10),
            'nombre' => $nbrVisa
        ]);
    }
}
