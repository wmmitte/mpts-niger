@extends('layouts.blank.blank')

@section('content')
    <div class="bg-body-dark bg-pattern" style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
        <div class="row mx-0 justify-content-center">
            <div class="hero-static col-lg-6 col-xl-4">
                <div class="content content-full overflow-hidden">
                    <!-- Header -->
                    <div class="py-30 text-center">
                        <a class="link-effect font-w700" href="/">
                            {{-- <i class="si si-fire"></i> --}}
                            <span class="font-size-xl text-primary-dark">METPS</span><span
                                class="ml-1 font-size-xl text-success"></span>
                        </a>
                        <h1 class="h4 font-w700 mt-30 mb-10">
                            <img height="100" src="{{ asset('media/logo/armoirie-niger.png') }}" />
                        </h1>
                        <h2 class="h5 font-w400 text-muted mb-0">Bienvenue sur la Plateforme de production des données
                            statistiques du Ministère de l'Emploi, du Travail et de la Protection
                            Sociale (METS/P)</h2>
                    </div>
                    <form class="js-validation-signin" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="block block-themed block-rounded block-shadow">
                            <div class="block-header bg-gd-dusk">
                                <h3 class="block-title">Veuillez vous authentifier</h3>
                                {{-- <div class="block-options">
                                <button type="button" class="btn-block-option">
                                    <i class="si si-wrench"></i>
                                </button>
                            </div> --}}
                            </div>
                            <div class="block-content">
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="email">Adresse mail</label>
                                        <input type="email" id="email" name="email" required autofocus
                                            class="form-control" value="{{ old('email') ?? '' }}"
                                            placeholder="Renseigner l'adresse mail" />
                                        @error('email')
                                            <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-12">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" required
                                            autocomplete="current-password" placeholder="Renseigner le mot de passe" />
                                        @error('password')
                                            <div class="form-text invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row mb-0">
                                    <div class="col-sm-6 d-sm-flex align-items-center push">
                                        <div class="custom-control custom-checkbox mr-auto ml-0 mb-0">
                                            <input type="checkbox" class="custom-control-input" id="login-remember-me"
                                                name="login-remember-me">
                                            <label class="custom-control-label" for="login-remember-me">Se souvenir de
                                                moi</label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 text-sm-right push">
                                        <button type="submit" class="btn btn-alt-primary">
                                            <i class="si si-login mr-10"></i> Se connecter
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
