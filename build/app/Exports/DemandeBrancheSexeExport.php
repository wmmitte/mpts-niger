<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Contract;
use App\Models\Demand;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DemandeBrancheSexeExport implements FromView
{
    use Exportable;

    public function __construct(string $dateDebut, string $dateFin)
    {
        $this->dateDebut = $dateDebut;
        $this->dateFin = $dateFin;
    }
    /**
    * @return \Illuminate\Contracts\View\View;
    */
    public function view(): View
    {
        $activityGroups = Activity::all()->groupBy('wording');
        foreach ($activityGroups as $key => $activitiesGroup) {
            foreach ($activitiesGroup as $activityGroup) {
                # code...
                $activityId = $activityGroup->id;
                $employerIds = $activityGroup->employer->pluck('id');
                $contratIds = Contract::whereIn('employer_id', $employerIds)->pluck('id');

                $demandes = Demand::where('created_at', '>=', Carbon::parse($this->dateDebut)->format('Y-m-d'))
                    ->where('created_at', '<=', Carbon::parse($this->dateFin)->format('Y-m-d'))
                    ->whereIn('contract_id', $contratIds)
                    ->whereIn('state', [-2, 0, 1])->get()
                    ->filter(function ($demande) use ($activityId) {
                        $contract = $demande->contract;
                        $employer = $contract->employer;
                        return $employer->industry_id == $activityId;
                    })
                    ->groupBy('type');
                $stat = $demandes->map(function($demandes) {
                    $employees = $demandes->map(function ($demande) {
                        return $demande->contract->employee;
                    });
                    $male = $employees->filter(function ($employee) {
                        return $employee->genre == 'male';
                    })->all();
                    $female = $employees->filter(function ($employee) {
                        return $employee->genre == 'female';
                    })->all();

                    return [
                        'homme' => count($male),
                        'femme' => count($female),
                    ];
                });
                if(!$stat->has('nouvelle')) {
                    $stat['nouvelle'] = array(
                        'homme' => 0,
                        'femme' => 0
                    );
                }

                if(!$stat->has('renouvellement')) {
                    $stat['renouvellement'] = array(
                        'homme' => 0,
                        'femme' => 0
                    );
                }
                $banches["$key"] = $stat;
            }
        }
        //
        return view('backoffice.pages.statistic.table.dbs', [
            'banches' => $banches
        ]);
    }
}
