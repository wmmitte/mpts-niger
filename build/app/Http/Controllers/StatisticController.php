<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Contract;
use App\Models\Demand;
use App\Models\ProfessionalCategory;
use App\Models\QualificationArea;
use App\Models\WorkVisa;
use Carbon\Carbon;
use Illuminate\Http\Request;

class StatisticController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function demandeBrancheSexe(Request $request)
    {
        $dateDebut = '';
        $dateFin = '';
        $isFetch = false;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;
        $banches = array();
        return view('backoffice.pages.statistic.demande-branche-sexe', compact('banches', 'dateDebut', 'dateFin', 'isFetch', 'totalNouveau', 'totalRenouveau', 'totalTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function fetchDemandeBrancheSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $isFetch = true;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;

        $banches = array();
        $activityGroups = Activity::all()->groupBy('wording');
        // dd($activityGroups);
        foreach ($activityGroups as $key => $activitiesGroup) {
            foreach ($activitiesGroup as $activityGroup) {
                # code...
                $activityId = $activityGroup->id;
                $employerIds = $activityGroup->employer->pluck('id');
                $contratIds = Contract::whereIn('employer_id', $employerIds)->pluck('id');

                $demandes = Demand::where('created_at', '>=', Carbon::parse($dateDebut)->format('Y-m-d'))
                    ->where('created_at', '<=', Carbon::parse($dateFin)->format('Y-m-d'))
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
        return view('backoffice.pages.statistic.demande-branche-sexe', compact('dateDebut', 'dateFin', 'isFetch', 'banches', 'totalNouveau', 'totalRenouveau', 'totalTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function visaBrancheSexe(Request $request)
    {
        $dateDebut = '';
        $dateFin = '';
        $isFetch = false;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;

        $banches = array();
        return view('backoffice.pages.statistic.visa-branche-sexe', compact('dateDebut', 'dateFin', 'isFetch', 'banches', 'totalNouveau', 'totalRenouveau', 'totalTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function fetchVisaBrancheSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $isFetch = true;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;

        $banches = array();
        $activityGroups = Activity::all()->groupBy('wording');
        foreach ($activityGroups as $key => $activitiesGroup) {
            foreach ($activitiesGroup as $activityGroup) {
                # code...
                $activityId = $activityGroup->id;
                $employerIds = $activityGroup->employer->pluck('id');
                $contratIds = Contract::whereIn('employer_id', $employerIds)->pluck('id');

                $demandes = Demand::where('created_at', '>=', Carbon::parse($dateDebut)->format('Y-m-d'))
                    ->where('created_at', '<=', Carbon::parse($dateFin)->format('Y-m-d'))
                    ->whereIn('contract_id', $contratIds)
                    ->where('state', 1)->get()
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
        return view('backoffice.pages.statistic.visa-branche-sexe', compact('dateDebut', 'dateFin', 'isFetch', 'banches', 'totalNouveau', 'totalRenouveau', 'totalTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function visaBrancheCategorieSexe(Request $request)
    {
        $dateDebut = '';
        $dateFin = '';
        $isFetch = false;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;

        $banches = array();
        return view('backoffice.pages.statistic.visa-branche-categorie-sexe', compact('dateDebut', 'dateFin', 'isFetch', 'banches', 'totalNouveau', 'totalRenouveau', 'totalTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function fetchVisaBrancheCategorieSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $isFetch = true;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;

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

                $demandes = Demand::where('created_at', '>=', Carbon::parse($dateDebut)->format('Y-m-d'))
                    ->where('created_at', '<=', Carbon::parse($dateFin)->format('Y-m-d'))
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
        // dd($professionalCategoryGroups);
        return view('backoffice.pages.statistic.visa-branche-categorie-sexe', compact('dateDebut', 'dateFin', 'isFetch', 'banches', 'professionalCategoryGroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function demandeDomaineSexe(Request $request)
    {
        $dateDebut = '';
        $dateFin = '';
        $isFetch = false;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;

        $banches = array();
        return view('backoffice.pages.statistic.demande-domaine-sexe', compact('dateDebut', 'dateFin', 'isFetch', 'banches', 'totalNouveau', 'totalRenouveau', 'totalTotal'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function fetchDemandeDomaineSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $isFetch = true;
        $totalNouveau = 0;
        $totalRenouveau = 0;
        $totalTotal = 0;

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
                    $dateDebutFormate = Carbon::parse($dateDebut);
                    $dateFinFormate = Carbon::parse($dateFin);
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
        // dd($qualificationAreas);
        return view('backoffice.pages.statistic.demande-domaine-sexe', compact('dateDebut', 'dateFin', 'isFetch', 'qualificationAreas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function suiviVisa(Request $request)
    {
        $dateDebut = '';
        $dateFin = '';
        $isFetch = false;
        return view('backoffice.pages.statistic.suivi-visa', compact('dateDebut', 'dateFin', 'isFetch'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function fetchSuiviVisa(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        $isFetch = true;
        $visaStats = WorkVisa::with(['demand' => function($query) {
            $query->with(['contract' => function($query) {
                $query->with(['employer', 'employee', 'professionalCategory', 'qualificationArea']);
            }]);
        }])->where('created_at', '>=', Carbon::parse($dateDebut)->format('Y-m-d'))
        ->where('created_at', '<=', Carbon::parse($dateFin)->format('Y-m-d'))
        ->get();
        return view('backoffice.pages.statistic.suivi-visa', compact('dateDebut', 'dateFin', 'isFetch', 'visaStats'));
    }
}
