<?php

namespace App\Exports;

use App\Models\Activity;
use App\Models\Contract;
use App\Models\Demand;
use App\Models\ProfessionalCategory;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class VisaBrancheCategorieSexeExport implements FromView
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
        $banches = array();
        $activityGroups = Activity::all()->groupBy('wording');
        $professionalCategoryGroups = ProfessionalCategory::all()->groupBy('wording');
        foreach ($activityGroups as $activityName => $activitiesGroup) {
            $rofessionalCategoryStats = array();
            $activity = $activitiesGroup[0];
            foreach ($professionalCategoryGroups as $rofessionalCategoryName => $professionalCategoriesGroup) {
                # code...
                $professionalCategory = $professionalCategoriesGroup[0];
                $professionalCategoryId = $professionalCategory->id;
                $employerIds = $activity->employer->pluck('id');
                $contratIds = Contract::whereIn('employer_id', $employerIds)->pluck('id');

                $demandes = Demand::where('created_at', '>=', Carbon::parse($this->dateDebut)->format('Y-m-d'))
                    ->where('created_at', '<=', Carbon::parse($this->dateFin)->format('Y-m-d'))
                    ->whereIn('contract_id', $contratIds)
                    ->whereIn('state', [1])->get()
                    ->filter(function ($demande) use ($professionalCategoryId) {
                        $contract = $demande->contract;
                        return $contract->professional_category_id == $professionalCategoryId;
                    });
                $nbrMale = 0;
                $nbrFemale = 0;
                foreach ($demandes as $demande) {
                    # code...
                    $employee = $demande->contract->employee;
                    $nbrMale = $employee->genre == 'male' ? $nbrMale + 1 : $nbrMale ;
                    $nbrFemale = $employee->genre == 'female' ? $nbrFemale + 1 : $nbrFemale;
                }
                $rofessionalCategoryStats["$rofessionalCategoryName"] = array(
                    'homme' => $nbrMale,
                    'femme' => $nbrFemale
                );
            }
            $banches["$activityName"] = $rofessionalCategoryStats;
        }
        //
        return view('backoffice.pages.statistic.table.vbcs', [
            'banches' => $banches, 'professionalCategoryGroups' => $professionalCategoryGroups
        ]);
    }
}
