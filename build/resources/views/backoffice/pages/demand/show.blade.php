@extends('layouts.back.admin')
@section('css_after')
    @livewireStyles
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="content">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h2 class="content-heading">Détail demande de visa</h2>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <div class="d-flex align-items-center justify-content-end h-100">
                        <a class="btn btn-dark" href="{{ route('demands.index') }}">Retour à la liste</a>
                    </div>
                </div>
            </div>
            @livewire('demand.show', ['demand' => $demand, 'hasSummerPage' => false])
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    @livewireScripts
@endsection
