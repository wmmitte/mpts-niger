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
                    <h2 class="content-heading">Demandes rejetées</h2>
                </div>
                @cannot('super-privilege')
                    @cannot('general-privilege')
                        @cannot('directeur-privilege')
                            <div class="col-sm-12 col-md-6 text-right">
                                <div class="d-flex align-items-center justify-content-end h-100">
                                    <a class="btn btn-success" href="{{ route('demands.create') }}">Enregistrer une demande</a>
                                </div>
                            </div>
                        @endcannot
                    @endcannot
                @endcannot
            </div>
            <div class="block">
                <div class="block-content">
                    @livewire('demand.rejected')
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    @livewireScripts
@endsection
