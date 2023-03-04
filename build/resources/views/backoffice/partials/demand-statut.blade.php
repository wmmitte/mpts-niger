@switch($status)
    @case(-2)
        Demande rejetée
    @break

    @case(1)
        Demande accepter
    @break

    @default
        Pour avis
@endswitch


{{--
* State :
* -2 = rejeter
* -1 = brouillon
*  0 = enregistrement definitif
*  1 = accepter
*  2 = courier
*  3 = contrat
*  4 = operation
*  5 = DG
*  6 = DAEP
*  7 = SG
*  8 = Ministre
--}}
