<?php

namespace App\Exports;

use App\Models\WorkVisa;
use App\Models\QualificationArea;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;

class TableauSuiviVisaExport implements FromView
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
        $visaStats = WorkVisa::with(['demand' => function($query) {
            $query->with(['contract' => function($query) {
                $query->with(['employer', 'employee', 'professionalCategory', 'qualificationArea']);
            }]);
        }])->where('created_at', '>=', Carbon::parse($this->dateDebut)->format('Y-m-d'))
        ->where('created_at', '<=', Carbon::parse($this->dateFin)->format('Y-m-d'))
        ->get();
        return view('backoffice.pages.statistic.table.tsv', [
            'visaStats' => $visaStats
        ]);
    }
}
