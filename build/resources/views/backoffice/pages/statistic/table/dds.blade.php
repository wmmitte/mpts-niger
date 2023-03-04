
<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2">Domaine de qualification</th>
            <th colspan="2" class="text-center box-tble">DEMANDES INITIALES</th>
            <th colspan="2" class="text-center box-tble">DEMANDES DE RENOUVELLEMENT</th>
            <th rowspan="2" class="text-center">Total</th>
        </tr>
        <tr>
            <th class="text-center">Homme</th>
            <th class="text-center">Femme</th>
            <th class="text-center">Homme</th>
            <th class="text-center">Femme</th>
        </tr>
    </thead>
    <tbody>
        @php
            $totalNouveau = 0;
            $totalRenouveau = 0;
            $totalTotale = 0;

            $totalNHomme = 0;
            $totalNFemme = 0;
            $totalRHomme = 0;
            $totalRFemme = 0;
        @endphp
        @foreach ($qualificationAreas as $key => $qualificationArea)
            <tr>
                @php
                    $total = $qualificationArea['nouvelle']['homme'] +
                                $qualificationArea['nouvelle']['femme'] +
                                $qualificationArea['renouvellement']['homme'] +
                                $qualificationArea['renouvellement']['femme'];
                    $totalTotale = $totalTotale + $total;
                    $totalNouveau = $totalNouveau + $qualificationArea['nouvelle']['homme'] +
                                $qualificationArea['nouvelle']['femme'];
                    $totalRenouveau = $totalRenouveau + $qualificationArea['renouvellement']['homme'] +
                                $qualificationArea['renouvellement']['femme'];

                    $totalNHomme = $totalNHomme + $qualificationArea['nouvelle']['homme'];
                    $totalNFemme = $totalNFemme + $qualificationArea['nouvelle']['femme'];
                    $totalRHomme = $totalRHomme + $qualificationArea['renouvellement']['homme'];
                    $totalRFemme = $totalRFemme + $qualificationArea['renouvellement']['femme'];
                @endphp
                <td>{{$key}}</td>
                <td class="text-center">{{$qualificationArea['nouvelle']['homme']}}</td>
                <td class="text-center">{{$qualificationArea['nouvelle']['femme']}}</td>
                <td class="text-center">{{$qualificationArea['renouvellement']['homme']}}</td>
                <td class="text-center">{{$qualificationArea['renouvellement']['femme']}}</td>
                <td class="text-center">{{$total}}</td>
            </tr>
        @endforeach
        <tr>
            <td>Sous total</td>
            <td class="text-center">{{$totalNHomme}}</td>
            <td class="text-center">{{$totalNFemme}}</td>
            <td class="text-center">{{$totalRHomme}}</td>
            <td class="text-center">{{$totalRFemme}}</td>
            <td class="text-center">{{$totalNHomme + $totalNFemme + $totalRHomme + $totalRFemme}}</td>
        </tr>
        <tr>
            <td>TOTAL GENERAL </td>
            <td colspan="2" class="text-center">{{$totalNouveau}}</td>
            <td colspan="2" class="text-center">{{$totalRenouveau}}</td>
            <td class="text-center">{{$totalTotale}}</td>
        </tr>
    </tbody>
</table>
