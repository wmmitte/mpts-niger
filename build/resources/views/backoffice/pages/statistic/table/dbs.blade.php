
<table class="table table-bordered">
    <thead>
        <tr>
            <th rowspan="2">Branche</th>
            <th colspan="2" class="text-center box-tble">Nouvelle</th>
            <th colspan="2" class="text-center box-tble">Renouvellement</th>
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
        @foreach ($banches as $key => $banche)
            <tr>
                @php
                    $total = $banche['nouvelle']['homme'] +
                                $banche['nouvelle']['femme'] +
                                $banche['renouvellement']['homme'] +
                                $banche['renouvellement']['femme'];
                    $totalTotale = $totalTotale + $total;
                    $totalNHomme = $totalNHomme + $banche['nouvelle']['homme'];
                    $totalNFemme = $totalNFemme + $banche['nouvelle']['femme'];
                    $totalRHomme = $totalRHomme + $banche['renouvellement']['homme'];
                    $totalRFemme = $totalRFemme + $banche['renouvellement']['femme'];
                    $totalNouveau = $totalNouveau + $banche['nouvelle']['homme'] +
                                $banche['nouvelle']['femme'];
                    $totalRenouveau = $totalRenouveau + $banche['renouvellement']['homme'] +
                                $banche['renouvellement']['femme'];
                @endphp
                <td>{{$key}}</td>
                <td class="text-center">{{$banche['nouvelle']['homme']}}</td>
                <td class="text-center">{{$banche['nouvelle']['femme']}}</td>
                <td class="text-center">{{$banche['renouvellement']['homme']}}</td>
                <td class="text-center">{{$banche['renouvellement']['femme']}}</td>
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
