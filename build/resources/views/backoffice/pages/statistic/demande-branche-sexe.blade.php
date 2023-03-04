@extends('layouts.back.admin')
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-sm-12">
                <h2 class="content-heading">Répartition des demandes de visa enregistrées par Branches d'activités et par sexes</h2>
            </div>
        </div>
        <div class="block p-4">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="card-title mt-2 mb-1">Veuillez definir les dates</h5>
                    <form method="Post" action="{{route('statistics.fetch.demands.branche.sexe')}}">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="dateDebut" class="col-form-label">Date debut</label>
                                    <input type="date" value="{{old('dateDebut') ?? $dateDebut}}" class="form-control @error('dateDebut') is-invalid @enderror" name="dateDebut">
                                    @error('dateDebut')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-group">
                                    <label for="dateFin" class="col-form-label">Date fin</label>
                                    <input type="date" value="{{old('dateFin') ?? $dateFin}}" class="form-control @error('dateFin') is-invalid @enderror" name="dateFin">
                                    @error('dateFin')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-md-2">
                                <div class="d-flex align-items-center w-100 h-100">
                                    <button class="btn btn-success" type="submit">Generer le tableau</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="block p-4">
            <div class="row">
                @if ($isFetch)
                    @if (count($banches ?? []) > 0)
                    <div class="col-sm-12 col-md-6">
                        <a class="btn btn-dark mb-4" href="#"
                            onclick="event.preventDefault(); document.getElementById('export-excel-branche-sexe-export').submit();">
                            <i class="si si-cloud-download mr-5"></i> Export sous format excel
                        </a>
                        <form id="export-excel-branche-sexe-export" action="{{ route('statistics.demands.branche.sexe.export') }}" method="POST" style="display: none;">
                            @csrf
                            <input type="date" value="{{old('dateDebut') ?? $dateDebut}}" class="form-control @error('dateDebut') is-invalid @enderror" name="dateDebut">
                            <input type="date" value="{{old('dateFin') ?? $dateFin}}" class="form-control @error('dateFin') is-invalid @enderror" name="dateFin">
                        </form>
                    </div>
                    @endif
                    <div class="col-12">
                        <div class="table-responsive">
                            @include('backoffice.pages.statistic.table.dbs', ['banches' => $banches])
                        </div>
                    </div>
                @else
                    <div class="col-12 text-center">Veuillez selectionnéer la période</div>
                @endif
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

