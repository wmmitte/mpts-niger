@switch($status)
    @case(-2)
        <span class="badge badge-pill badge-danger"><i class="fa fa-close"></i> Rejet à notifier</span>
    @break

    @case(-1)
        <span class="badge badge-pill badge-light"><i class="fa fa-list"></i> incomplète</span>
    @break

    @case(1)
        @if ($hasVisaCompleted > 0)
            <span class="badge badge-pill badge-success"> <i class="fa fa-check" aria-hidden="true"></i> visa accordé</span>
        @else
            <span class="badge badge-pill badge-primary text-white"> <i class="fa fa-file-zip-o" aria-hidden="true"></i> accord à notifier </span>
        @endif
    @break

    @default
        {{--  <span class="badge badge-pill badge-{{ $hasRecour ? 'secondary' : 'dark' }}"><i class="fa fa-chevron-right"
                aria-hidden="true"></i> Pour avis</span> --}}
        <span class="badge badge-pill badge-{{ $hasRecour ? 'dark' : 'dark' }}"><i class="fa fa-chevron-right"
                aria-hidden="true"></i> Pour avis</span>

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
