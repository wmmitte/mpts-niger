<table class="table table-bordered">
    <thead>
        <tr>
            <th class="text-center">N°</th>
            <th class="text-center">NOM ET PRENOM DU TRAVAILLEUR</th>
            <th class="text-center">EMPLOYEUR</th>
            <th class="text-center">NATIONALITE</th>
            <th class="text-center">QUALIFICATION</th>
            <th class="text-center">EMPLOI OCCUPE</th>
            <th class="text-center">DUREE DU VISA</th>
            <th class="text-center">DATE EFFET VISA</th>
            <th class="text-center">DATE EXPIRATION VISA</th>
            <th class="text-center">OBSERVATION</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($visaStats as $visaStat)
            <tr>
                @php
                    $duration = null;
                    if ($visaStat->start_date && $visaStat->end_date) {
                        $to = \Carbon\Carbon::parse($visaStat->start_date);
                        $from = \Carbon\Carbon::parse($visaStat->end_date);
                        $duration = $to->diffInDays($from);
                        if ($duration > 31) {
                            // $duration = number_format((float)($duration % 365), 2, '.', '')." moi(s)";
                            $duration = $to->diffInMonths($from);
                            if ($duration > 12) {
                                $duration = $to->diffInYears($from);
                                $duration = "$duration an(s)";
                            } else {
                                $duration = "$duration mois";
                            }
                        } else {
                            $duration = "$duration jour(s)";
                        }
                    }
                    $demand = $visaStat->demand;
                    $contract = $demand->contract;
                    $employer = $contract->employer;
                    $employee = $contract->employee;
                    $qualificationArea = $contract->qualificationArea;
                @endphp
                <td class="text-center">{{ $visaStat->numero ?? '---' }}</td>
                <td class="text-center">{{ "$employee->firstname $employee->lastname" ?? '---' }}</td>
                <td class="text-center">{{ $employer->raison_social ?? '---' }}</td>
                <td class="text-center">{{ $employee->nationalite ?? '---' }}</td>
                <td class="text-center">{{ $qualificationArea->wording ?? '---' }}</td>
                <td class="text-center">{{ $employee->profession ?? '---' }}</td>
                <td class="text-center">{{ $duration ?? '---' }}</td>
                <td class="text-center">
                    {{ $visaStat->start_date ? \Carbon\Carbon::parse($visaStat->start_date)->format('d/m/Y') : '---' }}
                </td>
                <td class="text-center">
                    {{ $visaStat->end_date ? \Carbon\Carbon::parse($visaStat->end_date)->format('d/m/Y') : '---' }}</td>
                <td class="text-center">{{ $visaStat->observation ?? '---' }}</td>
            </tr>
        @endforeach
        @if (count($visaStats) <= 0)
            <tr>
                <td class="text-center" colspan="10">Auccune donnée trouvée</td>
            </tr>
        @endif
    </tbody>
</table>
