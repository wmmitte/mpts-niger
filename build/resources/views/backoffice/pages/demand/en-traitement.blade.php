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
                    <h2 class="content-heading">Demandes en cours de traitement</h2>
                </div>
            </div>
            <div class="block">
                <div class="block-content">
                    @livewire('demand.en-traitement')
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    @livewireScripts
@endsection
