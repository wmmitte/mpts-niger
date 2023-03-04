<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\QualificationArea;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class DemandeDomaineSexeExport implements FromView
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
        $qualificationAreas = array();
        $qualificationAreaGroups = QualificationArea::all()->groupBy('wording');
        foreach ($qualificationAreaGroups as $key => $qualificationAreasGroup) {
            foreach ($qualificationAreasGroup as $qualificationAreaGroup) {
                # code...
                $qualificationAreaId = $qualificationAreaGroup->id;
                $demandes = collect([]);
                $contracts = $qualificationAreaGroup->contracts;
                foreach ($contracts as $contract) {
                    # code...
                    $demande = $contract->demands;
                    $createdAt = Carbon::parse($demande->created_at);
                    $dateDebutFormate = Carbon::parse($this->dateDebut);
                    $dateFinFormate = Carbon::parse($this->dateFin);
                    if(
                        $createdAt->gte($dateDebutFormate) &&
                        $createdAt->lte($dateFinFormate) &&
                        ($demande->state == -2 || $demande->state == 0 || $demande->state == 1)
                    ) {
                        $demandes->push($demande);
                    }
                }
                $demandes = $demandes->groupBy('type');
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
                $qualificationAreas["$key"] = $stat;
            }
        }
        //
        return view('backoffice.pages.statistic.table.dds', [
            'qualificationAreas' => $qualificationAreas
        ]);
    }
}
