<div>
    @switch($role)
        @case('admin')
            <span class="badge badge-dark">@include('backoffice.partials.role-name', ['role' => $role])</span>
            @break
        @case('manager')
            <span class="badge badge-primary">@include('backoffice.partials.role-name', ['role' => $role])</span>
            @break
        @case('general')
            <span class="badge badge-danger">@include('backoffice.partials.role-name', ['role' => $role])</span>
            @break
        @case('directeur')
            <span class="badge badge-warning">@include('backoffice.partials.role-name', ['role' => $role])</span>
            @break
        @case('chef')
            <span class="badge badge-info">@include('backoffice.partials.role-name', ['role' => $role])</span>
            @break
        @case('secretaire')
            <span class="badge badge-secondary">@include('backoffice.partials.role-name', ['role' => $role])</span>
            @break
        @default
            <span class="badge badge-light">@include('backoffice.partials.role-name', ['role' => $role])</span>
    @endswitch
</div>
