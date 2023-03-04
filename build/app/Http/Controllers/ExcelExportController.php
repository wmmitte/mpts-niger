<?php

namespace App\Http\Controllers;

use App\Exports\DemandeBrancheSexeExport;
use App\Exports\DemandeDomaineSexeExport;
use App\Exports\TableauSuiviVisaExport;
use App\Exports\VisaBrancheCategorieSexeExport;
use App\Exports\VisaBrancheSexeExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelExportController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

     public function exportDemandeBrancheSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        return Excel::download(new DemandeBrancheSexeExport($dateDebut, $dateFin), "demande-visa-par-branche-et-sexe.xlsx");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function exportVisaBrancheSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        return Excel::download(new VisaBrancheSexeExport($dateDebut, $dateFin), "visa-par-branche-et-sexe.xlsx");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function exportVisaBrancheCategorieSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        return Excel::download(new VisaBrancheCategorieSexeExport($dateDebut, $dateFin), "visa-par-branche-categorie-professionnel-et-sexe.xlsx");
    }



    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function exportDemandeDomaineSexe(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        return Excel::download(new DemandeDomaineSexeExport($dateDebut, $dateFin), "visa-par-branche-categorie-professionnel-et-sexe.xlsx");
    }


    /**
     * Show the form for creating a new resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function exportTableauSuiviVisa(Request $request)
    {
        $request->validate([
            "dateDebut" => 'required|date|before:dateFin',
            "dateFin" => 'required|date',
        ]);
        $dateDebut = $request->dateDebut;
        $dateFin = $request->dateFin;
        return Excel::download(new TableauSuiviVisaExport($dateDebut, $dateFin), "Tableau-de-suivi-des-visa.xlsx");
    }
}
