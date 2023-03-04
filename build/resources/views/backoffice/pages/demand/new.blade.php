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
                    @if (!request()->is('demands/create') && $demand)
                        <a class="btn btn-danger mr-2" href="#" data-toggle="modal" data-target="#staticBackdrop">
                            Supprimer et quitter
                        </a>
                    @endif
                    <a class="btn btn-dark" href="{{ url()->previous() }}">Quitter</a>
                </div>
            </div>
        </div>
        <div class="block cesw-stepper-box">
            <ul class="nav justify-content-center nav-tabs nav-tabs-alt" data-toggle="tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link{{ !$currentStep ? ' active' : '' }}"
                        onclick="location.href='{{ route('demande.edit.general', $demand) }}'" href="#btabs-demand-general">
                        <i class="si si-globe mr-2"></i> Générale
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $currentStep == 1 ? ' active' : '' }}{{ $unlockStep < 1 ? ' disabled' : '' }}"
                        onclick="location.href='{{ route('demande.edit.contract', $demand) }}'"
                        href="#btabs-demand-contract">
                        <i class="si si-notebook mr-2"></i> Contrat
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $currentStep === 2 ? ' active' : '' }}{{ $unlockStep < 2 ? ' disabled' : '' }}"
                        onclick="location.href='{{ route('demande.edit.employee', $demand) }}'"
                        href="#btabs-demand-employee">
                        <i class="si si-user mr-2"></i> Employé
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $currentStep === 3 ? ' active' : '' }}{{ $unlockStep < 3 ? ' disabled' : '' }}"
                        onclick="location.href='{{ route('demande.edit.employer', $demand) }}'"
                        href="#btabs-demand-employer">
                        <i class="si si-briefcase mr-2"></i> Employeur
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $currentStep === 4 ? ' active' : '' }}{{ $unlockStep < 4 ? ' disabled' : '' }}"
                        onclick="location.href='{{ route('demande.edit.piece', $demand) }}'" href="#btabs-demand-piece">
                        <i class="si si-paper-clip mr-2"></i> Pièces
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link{{ $currentStep === 5 ? ' active' : '' }}{{ $unlockStep < 5 ? ' disabled' : '' }}"
                        onclick="location.href='{{ route('demande.edit.summer', $demand) }}'" href="#btabs-demand-summary">
                        <i class="si si-layers mr-2"></i> Terminé
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link{{$currentStep === 5 ? ' active' : ''}}{{$unlockStep < 5 ? ' disabled' : ''}}"
                        href="#btabs-demand-recap">
                        <i class="si si-layers mr-2"></i> Terminé
                    </a>
                </li> --}}
                {{-- <li class="nav-item ml-auto">
                    <a class="nav-link" href="#btabs-alt-static-settings"><i class="si si-settings"></i></a>
                </li> --}}
            </ul>
            <div class="block-content tab-content pb-4">
                <div class="tab-pane{{ !$currentStep ? ' active' : '' }}" id="btabs-demand-general" role="tabpanel">
                    <div class="block-content">
                        <h5 class="font-w400"><strong>Informations sur la demande</strong> - <span
                                class="text-danger font-size-xs">*</span>
                            <span class="font-size-xs">Champs requis</span>
                        </h5>
                        @livewire('demand.stepper.general', ['demand' => $demand])
                    </div>
                </div>

                @if ($currentStep === 1)
                    <div class="tab-pane{{ $currentStep === 1 ? ' active' : '' }}" id="btabs-demand-contract"
                        role="tabpanel">
                        <h5 class="font-w400"><strong>Informations sur le contrat</strong> - <span
                                class="text-danger font-size-xs">*</span>
                            <span class="font-size-xs">Champs requis</span>
                        </h5>
                        @livewire('demand.stepper.contract', ['demand' => $demand])
                    </div>
                @endif

                @if ($currentStep === 2)
                    <div class="tab-pane{{ $currentStep === 2 ? ' active' : '' }}" id="btabs-demand-employee"
                        role="tabpanel">
                        <h5 class="font-w400"><strong>Informations sur l'employée</strong> - <span
                                class="text-danger font-size-xs">*</span>
                            <span class="font-size-xs">Champs requis</span>
                        </h5>
                        @livewire('demand.stepper.employee', ['demand' => $demand])
                    </div>
                @endif
                @if ($currentStep === 3)
                    <div class="tab-pane{{ $currentStep === 3 ? ' active' : '' }}" id="btabs-demand-employer"
                        role="tabpanel">
                        <h5 class="font-w400"><strong>Informations sur l'employeur</strong> - <span
                                class="text-danger font-size-xs">*</span>
                            <span class="font-size-xs">Champs requis</span>
                        </h5>
                        @livewire('demand.stepper.employer', ['demand' => $demand])
                    </div>
                @endif
                @if ($currentStep === 4)
                    <div class="tab-pane{{ $currentStep === 4 ? ' active' : '' }}" id="btabs-demand-piece" role="tabpanel">
                        <h5 class="font-w400"><strong>Les pièces jointes</strong> - <span
                                class="text-danger font-size-xs">*</span>
                            <span class="font-size-xs">Champs requis</span>
                        </h5>
                        @livewire('demand.stepper.attachment', ['demand' => $demand])
                    </div>
                @endif
                @if ($currentStep === 5)
                    <div class="tab-pane{{ $currentStep === 5 ? ' active' : '' }}" id="btabs-demand-summary"
                        role="tabpanel">
                        <h5 class="font-w400"><strong>Recapitulatif des informations de la demande</strong></h5>
                        @livewire('demand.stepper.summary', ['demand' => $demand])
                    </div>
                @endif
            </div>
        </div>
    </div>
    <!-- END Page Content -->
    @if (!request()->is('demands/create') && $demand)
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
                        <a class="btn btn-danger" href="{{ route('employers.destroy', $demand) }}"
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
