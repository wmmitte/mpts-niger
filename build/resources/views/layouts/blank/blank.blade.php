<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

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
            @yield('content')
        </main>
        <!-- END Main Container -->
    </div>
    <!-- END Page Container -->
</body>

</html>
