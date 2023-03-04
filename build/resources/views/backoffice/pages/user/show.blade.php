@extends('layouts.back.admin')
@section('css_after')
    @livewireStyles
@endsection
@section('content')
    <!-- Page Content -->
    @php
        $userConnectInfo = Auth::user()
    @endphp
    <div class="content">
        <div class="content">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    <h2 class="content-heading">Détail sur le profil</h2>
                </div>
                <div class="col-sm-12 col-md-6 text-right">
                    <div class="d-flex align-items-center justify-content-end h-100">
                        @if ($userConnectInfo->id !== $user->id && ($user->role !== 'admin' && $user->userConnectInfo !== 'admin'))
                            <button type="button" class="btn btn-warning mr-2"
                                data-toggle="modal" data-target="#showUserGeneratePassword"
                            >
                                Générer un nouveau mot de passe
                            </button>
                            <div class="modal fade text-left" id="showUserGeneratePassword" tabindex="-1" aria-labelledby="{{"showUserGeneratePasswordLabel"}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">

                                        <div class="block block-themed block-transparent mb-0">
                                            <div class="block-header bg-primary-dark text-left">
                                                <h3 class="block-title">Avertissement</h3>
                                                <div class="block-options">
                                                    <button type="button" class="btn-block-option" data-dismiss="modal" aria-label="Close">
                                                        <i class="si si-close"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="block-content text-left">
                                                <p class="mb-0">Etes vous sur de bien vouloir effecturer cette action ?</p>
                                                <p class="text-danger"><strong>NB</strong>: Le nouveau mot de passe généré sera envoie à l'adresse
                                                    <strong>{{$user->email}}</strong> au l'utilisateur <strong>{{$user->lastname.' '.$user->firstname}}.</strong></p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <a href="{{route('users.password.reset', $user)}}" class="btn btn-warning">Générer et envoyer le mot de passe par mail</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <a class="btn btn-dark" href="{{route('users.index')}}">Return à la liste</a>
                    </div>
                </div>
            </div>
            <div class="block bg-transparent">
                <div class="block-content bg-transparent p-0">
                    @livewire('user.show', ['user' => $user])
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection

@section('js_after')
    @livewireScripts
@endsection
