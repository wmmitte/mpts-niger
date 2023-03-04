@extends('layouts.back.admin')
@section('css_after')
    @livewireStyles
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h2 class="content-heading">Liste des employeurs</h2>
            </div>
            @cannot('general-privilege')
                @cannot('directeur-privilege')
                    <div class="col-sm-12 col-md-6 text-right">
                        <div class="d-flex align-items-center justify-content-end h-100">
                            <a class="btn btn-outline-info" href="{{ route('employers.create') }}"><i class="fa fa-plus"
                                    aria-hidden="true"></i> Nouveau employeur</a>
                        </div>
                    </div>
                @endcannot
            @endcannot
        </div>
        <div class="block">
            @livewire('employer.all')
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    @livewireScripts
@endsection
