<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use Barryvdh\DomPDF\Facade\Pdf as DomPDFPDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
// use PDF;

class GenerateDocController extends Controller
{
    //

    public function demandeCourielGenerate(Request $request, Demand $demand)
    {
        DomPDFPDF::setOptions([
            "defaultFont" => "Courier",
            "defaultPaperSize" => "a4",
            "dpi" => 300
        ]);
        $contrat = $demand->contract;
        $visa = $demand->visa;
        $employeur = $contrat ? $contrat->employer : null;
        $employee = $contrat ? $contrat->employee : null;

        $jobEmploye = $contrat->job;
        $organisation = $employeur->raison_social;
        $nameEmploye = "$employee->lastname $employee->firstname";
        $sexeEmploye = $employee->genre;
        $nationaliteEmploye = $employee->nationalite;

        $nowDate = Carbon::now()->locale('fr_FR')->isoFormat('Do MMM YYYY');
        $namePage = 'Couriel pdf';
        $villeDate = "Niamey, le $nowDate";
        $armoirieNiger = public_path('media/logo/armoirie-niger.png');


        $decisionDate = $request->dateDecision;
        if(!$decisionDate) {
            $decisionDate = $demand->date_decision;
        } else {
            $demand->date_decision = $decisionDate;
        }
        $decisionDateFormate = $decisionDate ? \Carbon\Carbon::parse($decisionDate)->locale('fr_FR')->isoFormat('Do MMM YYYY') : '';

        $ministreName = $request->ministreName;
        if(!$ministreName) {
            $ministreName = $demand->nom_ministre;
        } else {
            $demand->nom_ministre = $ministreName;
        }

        $refCouriel = $request->refCouriel;
        if($refCouriel) {
            $demand->ref_couriel = $refCouriel;
        }
        $numeroCouriel = $request->numeroCouriel;
        if($numeroCouriel) {
            $demand->numero_couriel = $numeroCouriel;
        }

        $objetCouriel = $request->objetCouriel ? $request->objetCouriel : "Retour de contrat";
        $demand->objet_couriel = $objetCouriel;

        $position = $sexeEmploye == 'female' ? 'dame' : 'sieur';
        $paragrapheOneCouriel = "Par lettre citée en référence, vous transmettiez la demande de visa de travail, introduite par $organisation, au profit de $position $nameEmploye, $jobEmploye, de nationalité $nationaliteEmploye.";
        $paragrapheOneCouriel = $request->paragrapheOneCouriel ? $request->paragrapheOneCouriel : $paragrapheOneCouriel;
        $demand->paragraphe_one_couriel = $paragrapheOneCouriel;

        $paragrapheTwoCouriel = "A ce sujet, j’ai l’honneur de vous informer que suivant instructions, de Monsieur le Ministre en date du $decisionDateFormate, il a été émis un avis défavorable à la requête de l’employeur avec injonction à ce dernier de prospecter sur le marché local.";
        $paragrapheTwoCouriel = $request->paragrapheTwoCouriel ? $request->paragrapheTwoCouriel : $paragrapheTwoCouriel;
        $demand->paragraphe_two_couriel = $paragrapheTwoCouriel;

        $paragrapheThreeCouriel = "Vous voudriez bien répercuter ces informations au requérant";
        $paragrapheThreeCouriel = $request->paragrapheThreeCouriel ? $request->paragrapheThreeCouriel : $paragrapheThreeCouriel;
        $demand->paragraphe_three_couriel = $paragrapheThreeCouriel;

        $paragrapheFourCouriel = "";
        $paragrapheFourCouriel = $request->paragrapheFourCouriel ? $request->paragrapheFourCouriel : $paragrapheFourCouriel;
        $demand->paragraphe_four_couriel = $paragrapheFourCouriel;

        $paragrapheFiveCouriel = "";
        $paragrapheFiveCouriel = $request->paragrapheFiveCouriel ? $request->paragrapheFiveCouriel : $paragrapheFiveCouriel;
        $demand->paragraphe_five_couriel = $paragrapheFiveCouriel;

        $amOneCouriel = $request->amOneCouriel;
        if($amOneCouriel) {
            $demand->am_one_couriel = $amOneCouriel;
        }

        $amTwoCouriel = $request->amTwoCouriel;
        if($amTwoCouriel) {
            $demand->am_two_couriel = $amTwoCouriel;
        }

        $amThreeCouriel = $request->amThreeCouriel;
        if($amThreeCouriel) {
            $demand->am_three_couriel = $amThreeCouriel;
        }

        $demand->save();
        $pdf = DomPDFPDF::loadView('backoffice.pages.generate.couriel-visa-accorde', compact(
            'armoirieNiger',
            'villeDate',
            'namePage',
            'paragrapheOneCouriel',
            'paragrapheTwoCouriel',
            'paragrapheThreeCouriel',
            'paragrapheFourCouriel',
            'paragrapheFiveCouriel',
            'amOneCouriel',
            'amTwoCouriel',
            'amThreeCouriel',
            'refCouriel',
            'objetCouriel',
            'numeroCouriel',
            'ministreName'
        ));
        return $pdf->stream();
    }
}
