@extends('layouts.back.admin')
@section('css_after')
    @livewireStyles
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h2 class="content-heading">Liste des visa</h2>
            </div>
            {{-- <div class="col-sm-12 col-md-6 text-right">
                <div class="d-flex align-items-center justify-content-end h-100">
                    <a class="btn btn-success" href="{{route('work-visas.create')}}">Nouvelle visa</a>
                </div>
            </div> --}}
        </div>
        <div class="block">
            <div class="block-content">
                <div class="row">
                    <div class="col-12">
                        @livewire('work-visa.relauch')
                    </div>
                </div>
            </div>
            @livewire('work-visa.all')
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    @livewireScripts
@endsection
