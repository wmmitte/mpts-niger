@extends('layouts.back.admin')
@section('css_after')
    @livewireStyles
@endsection
@section('content')
    <!-- Page Content -->
    <div class="content">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <h2 class="content-heading">Demande de visa</h2>
            </div>
            <div class="col-sm-12 col-md-6 text-right">
                <div class="d-flex align-items-center justify-content-end h-100">
                    <a class="btn btn-dark" href="{{ route('employers.create') }}">Quitter</a>
                </div>
            </div>
        </div>
        <div class="block cesw-stepper-box">
            <ul class="nav justify-content-center nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" href="#btabs-demand-general">
                        <i class="si si-globe mr-2"></i> Générale
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#btabs-demand-contract">
                        <i class="si si-notebook mr-2"></i> Contrat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#btabs-demand-employee">
                        <i class="si si-user mr-2"></i> Employé
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#btabs-demand-employer">
                        <i class="si si-briefcase mr-2"></i> Employeur
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#btabs-demand-piece">
                        <i class="si si-paper-clip mr-2"></i> Pièces
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#btabs-demand-recap">
                        <i class="si si-layers mr-2"></i> Terminé
                    </a>
                </li>
                {{-- <li class="nav-item ml-auto">
                    <a class="nav-link" href="#btabs-alt-static-settings"><i class="si si-settings"></i></a>
                </li> --}}
            </ul>
            <div class="block-content tab-content pt-0">
                <div class="tab-pane active" id="btabs-demand-general" role="tabpanel">
                    <div class="block-content">
                        <h5 class="font-w400"><strong>Information sur la demande</strong> - <span
                                class="text-danger font-size-xs">*</span>
                            <span class="font-size-xs">Champs requis</span>
                        </h5>
                        @livewire('demand.stepper.general', ['demand' => $demand])
                    </div>
                </div>
                <div class="tab-pane" id="btabs-demand-contract" role="tabpanel">
                    <h5 class="font-w400"><strong>Information sur le contrat</strong></h5>
                </div>
                <div class="tab-pane" id="btabs-demand-employee" role="tabpanel">
                    <h4 class="font-w400">Employee Content</h4>
                    <p>...</p>
                </div>
                <div class="tab-pane" id="btabs-demand-employer" role="tabpanel">
                    <h4 class="font-w400">Employer Content</h4>
                    <p>...</p>
                </div>
                <div class="tab-pane" id="btabs-demand-piece" role="tabpanel">
                    <h4 class="font-w400">Pièce de la demande</h4>
                    <p>...</p>
                </div>
                <div class="tab-pane" id="btabs-demand-recap" role="tabpanel">
                    <h4 class="font-w400">recap</h4>
                    <p>...</p>
                </div>
                {{-- <div class="tab-pane" id="btabs-alt-static-settings" role="tabpanel">
                    <h4 class="font-w400">Settings Content</h4>
                    <p>...</p>
                </div> --}}
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    @if (!request()->is('demands/create'))
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Avertissement</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">Etre vous sur de bien vouloir supprimer ce dossier !?</p>
                        <p class="text-danger"><strong>NB</strong>: Si vous acceptez, le dossier en cour sera supprimer
                            definitivement.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-dark" data-dismiss="modal">Annuler</button>
                        <a class="btn btn-danger" href="{{ route('employers.create') }}"
                            onclick="event.preventDefault(); document.getElementById('delete-new-demand').submit();">
                            Supprimer le dossier et quitter
                        </a>
                        <form id="delete-new-demand" action="{{ route('demands.destroy', $demand) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@section('js_after')
    @livewireScripts
@endsection
