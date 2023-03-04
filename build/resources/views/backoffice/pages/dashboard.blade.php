@extends('layouts.back.admin')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="my-50 text-center">
            <h2 class="font-w700 text-black mb-10">Tableau de bord</h2>
            <h3 class="h5 text-muted mb-0">Bienvenu sur la Plateforme de production des données statistiques du Ministère de
                l'Emploi, du Travail et de la Protection Sociale (METP/S)</h3>
        </div>

        <div class="row">
            <div class="col-12">
                @livewire('work-visa.relauch')
            </div>
        </div>
        <div class="row invisible" data-toggle="appear">
            <!-- Row #1 -->
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{ route('demands.index') }}">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-doc fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000"
                            data-to="{{ $nbrDemands }}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Demande(s)</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{ route('demande.states.rejected') }}">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-close fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000"
                            data-to="{{ $nbrRejectedDemands }}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Rejet(s)</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{ route('work-visas.index') }}">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-briefcase fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600"><span data-toggle="countTo" data-speed="1000"
                                data-to="{{ $nbrWorkVisas }}">0</span></div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Visa(s)</div>
                    </div>
                </a>
            </div>
            <div class="col-6 col-xl-3">
                <a class="block block-link-shadow text-right" href="{{ route('demande.states.recours') }}">
                    <div class="block-content block-content-full clearfix">
                        <div class="float-left mt-10 d-none d-sm-block">
                            <i class="si si-users fa-3x text-body-bg-dark"></i>
                        </div>
                        <div class="font-size-h3 font-w600" data-toggle="countTo" data-speed="1000"
                            data-to="{{ $nbrRecours }}">0</div>
                        <div class="font-size-sm font-w600 text-uppercase text-muted">Recour(s)</div>
                    </div>
                </a>
            </div>
            <!-- END Row #1 -->
        </div>
    </div>
    <!-- END Page Content -->
@endsection
