@switch($type)
    @case('continent')
        Continent
        @break
    @case('country')
        Pays
        @break
    @case('district')
        Région
        @break
    @case('city')
        Ville
        @break
    @default
        Localité
@endswitch
