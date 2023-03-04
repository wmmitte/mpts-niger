<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use App\Models\User;
use App\Models\WorkVisa;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    public function dashboard(Request $request) {

        $user = $request->user();
        $userId = $user ? $user->id : null;
        $service = $user ? $user->entity : null;
        $userServiceId = $service ? $service->id : null;

        $visaDemands = Demand::where(function($query) use ($userServiceId, $userId) {
            $query->where('dealing_structure', $userServiceId)
                ->orWhere(function($query) use ($userServiceId, $userId) {
                    $query->whereHas('structures', function($query) use ($userId, $userServiceId) {
                        $query->where('user_id', $userId)->orWhere(function($query) use ($userServiceId) {
                            $query->whereHas('chargeOf', function($query) use ($userServiceId) {
                                $query->where('entity_id', $userServiceId);
                            });
                        });
                    });
                });
        });

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

        $_demand = clone $visaDemands;
        $nbrDemands =$visaDemands->count();

        // $nbrDemands = Demand::where('state', '!=', -1)->count();
        $nbrRejectedDemands = $visaDemands->where('state', -2)->count(); // status = -2
        $visaDemands = clone $_demand;

        $nbrWorkVisas = $visas->where('state', 0)->count();
        $visaDemands = clone $_demand;

        $nbrIssuedWorkVisas = $visas->where('state', -3)->count();
        $visaDemands = clone $_demand;

        $nbrRecours = $visaDemands->where('has_recours', true)->where('state', 0)->count(); // hasa_recours = true
        $visaDemands = clone $_demand;

        $nbrUsers = User::count();
        // $nbrRejectedWorkVisas = WorkVisa::where('')->count();
        return view('backoffice.pages.dashboard', compact('nbrDemands', 'nbrRejectedDemands', 'nbrWorkVisas', 'nbrIssuedWorkVisas', 'nbrUsers','nbrRecours'));
    }
}
