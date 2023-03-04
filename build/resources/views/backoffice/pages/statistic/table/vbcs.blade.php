
<table class="table table-bordered">
    <thead>
        <tr>
            <th></th>
            <th class="text-center box-tble" colspan="{{$professionalCategoryGroups->count() * 2}}">Categorie</th>
            <th></th>
        </tr>
        <tr>
            <th rowspan="2">Branche</th>
            @foreach ($professionalCategoryGroups as $key => $value)
            @php
                $value['total'] = 0;
                $value['hommeTotal'] = 0;
                $value['femmeTotal'] = 0;
                $totalTotale = 0;
                $sousTotale = 0;
            @endphp
            <th colspan="2" class="text-center box-tble">{{$key}}</th>
            @endforeach
            <th rowspan="2" class="text-center">Total</th>
        </tr>
        <tr>
            @foreach ($professionalCategoryGroups as $key => $value)
            <th class="text-center">Homme</th>
            <th class="text-center">Femme</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($banches as $key => $banche)
            <tr>
                <td>{{$key}}</td>
                @php
                    $total = 0;
                @endphp
                @foreach ($banche as $category => $stat)
                    <td class="text-center">{{$stat['homme']}}</td>
                    <td class="text-center">{{$stat['femme']}}</td>
                    @php
                    $total = $total + $stat['homme'] + $stat['femme'];
                    $professionalCategoryGroups["$category"]["total"] = $professionalCategoryGroups["$category"]["total"] + $stat['homme'] + $stat['femme'];
                    $totalTotale = $totalTotale + $stat['homme'] + $stat['femme'];
                    $professionalCategoryGroups["$category"]['hommeTotal'] = $professionalCategoryGroups["$category"]['hommeTotal'] + $stat['homme'];
                    $professionalCategoryGroups["$category"]['femmeTotal'] = $professionalCategoryGroups["$category"]['femmeTotal'] + $stat['femme'];
                    @endphp
                @endforeach
                <td class="text-center">{{$total}}</td>
            </tr>
        @endforeach
        <tr>
            <td>Sous total</td>
            @foreach ($professionalCategoryGroups as $key => $value)
            @php
                $sousTotale = $sousTotale + $professionalCategoryGroups["$key"]['hommeTotal'] + $professionalCategoryGroups["$key"]['femmeTotal'];
            @endphp
            <td class="text-center">{{$professionalCategoryGroups["$key"]['hommeTotal']}}</td>
            <td class="text-center">{{$professionalCategoryGroups["$key"]['femmeTotal']}}</td>
            @endforeach
            <td class="text-center">{{$sousTotale}}</td>
        </tr>
        <tr>
            <td>TOTAL GENERAL</td>
            @foreach ($professionalCategoryGroups as $key => $value)
                <td colspan="2" class="text-center">{{$professionalCategoryGroups["$key"]["total"]}}</td>
            @endforeach
            <td class="text-center">{{$totalTotale}}</td>
        </tr>
    </tbody>
</table>
