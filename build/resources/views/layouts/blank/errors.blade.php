<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title')</title>

    <meta name="description" content="Plateforme de demande des Visas de travail - MTPS NIGER">
    <meta name="author" content="ezyky">
    <meta name="email" content="cezechiel81@gmail.com">
    <meta name="robots" content="noindex, nofollow">

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts and Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/custom.css') }}">
    <style id="" media="all">
        .error-style {
            font-family: montserrat, sans-serif;
            position: relative;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            font-size: 224px;
            font-weight: 900;
            margin-top: 0;
            margin-bottom: 0;
            margin-left: -12px;
            color: #030005;
            text-transform: uppercase;
            text-shadow: -3px -3px 0 #45921d, 3px 3px 0 #e57b05;
            letter-spacing: -20px;
        }

        .bg-gd-dusk {
            background: #e57b05;
            background: linear-gradient(135deg, #e57b05 0%, #45921d 100%) !important;
        }
    </style>

    @yield('css_after')
</head>

<body>
    <div id="page-container" class="main-content-boxed">
        <!-- Main Container -->
        <main id="main-container">
            @include('partials.flash-message')
            <div class="bg-body-dark bg-pattern"
                style="background-image: url('assets/media/various/bg-pattern-inverse.png');">
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
                                <h2 class="h5 font-w400 text-muted mb-0">Bienvenue sur la Plateforme de production des
                                    données
                                    statistiques du Ministère de l'Emploi, du Travail et de la Protection
                                    Sociale (METS/P)</h2>
                            </div>
                            <form class="js-validation-signin">
                                @csrf
                                <div class="block block-themed block-rounded block-shadow">
                                    <div class="block-header bg-gd-dusk">
                                        <h3 class="block-title">Erreur @yield('code') - @yield('title')</h3>
                                    </div>
                                    <div class="block-content">
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <p class="text-center error-style">@yield('code') </p>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <h3 class="text-center text-danger">@yield('message')</h3>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-12">
                                                <p class="text-center">
                                                    <a type="submit" class="btn btn-primary"
                                                        href="{{ route('dashboard') }}">
                                                        <i class="si si-home mr-10"></i> Accueil
                                                    </a>
                                                </p>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</body>

</html>
