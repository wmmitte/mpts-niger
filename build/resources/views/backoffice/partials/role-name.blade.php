@switch($role)
    @case('admin')
        Administrateur
        @break
    @case('manager')
        Administrateur métier
        @break
    @case('observateur')
        Observateur
        @break
    @case('general')
        Premier Responsable
        @break
    @case('directeur')
        Responsable
        @break
    @case('chef')
        Chef de service
        @break
    @case('secretaire')
        Adjoint Responsable
        @break
    @default
        Agent
@endswitch
