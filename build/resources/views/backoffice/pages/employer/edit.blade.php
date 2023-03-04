@extends('layouts.back.admin')
@section('css_after')
    @livewireStyles
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h2 class="content-heading">Modifier les information d'employeur</h2>
            </div>
            <div class="col-sm-12 col-md-6 text-right">
                <div class="d-flex align-items-center justify-content-end h-100">
                    <a class="btn btn-dark" href="{{route('employers.index')}}">Retour à la liste</a>
                </div>
            </div>
        </div>
        <div class="block">
            @livewire('employer.edit', ['employer' => $employer])
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    @livewireScripts
@endsection
