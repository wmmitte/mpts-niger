@php
    $user = Auth::user() ?? null;
    $avatar = $user ? $user->avatar ?? '' : '';
    $name = $user ? substr($user->firstname, 0, 3) . ". $user->lastname" : '';
@endphp
<!doctype html>
<html lang="{{ config('app.locale') }}" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>{{ config('app.name') }}</title>

    <meta name="description" content="Plateforme de demande des Visas de travail - MTPS NIGER">
    <meta name="author" content="ezyky,mitte,gning,coulba">
    <meta name="email" content="cezechiel81@gmail.com,wmyameogo@gmail.com">
    <meta name="robots" content="noindex, nofollow">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Icones -->
    <link rel="shortcut icon" href="{{ asset('media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png" href="{{ asset('media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <!-- Fonts et Styles -->
    @yield('css_before')
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700">
    <link rel="stylesheet" id="css-main" href="{{ mix('/css/codebase.css') }}">
    <link rel="stylesheet" id="css-main" href="{{ asset('css/custom.css') }}">

    @yield('css_after')

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>

<body>
    <!-- PC -->
    <div id="page-container"
        class="sidebar-o enable-page-overlay side-scroll page-header-moderns content_layout_full_width page-header-fixed">
        <!-- SO-->
        @include('layouts.back.admin-sideoverlay')
        <!-- ESO -->

        <!-- SB -->
        @include('layouts.back.admin-sidebar', [
            'userConnect' => $user,
            'avatar' => $avatar,
            'name' => $name,
        ])
        <!-- ESB -->

        <!-- H -->
        @include('layouts.back.admin-header', [
            'userConnect' => $user,
            'avatar' => $avatar,
            'name' => $name,
        ])
        <!-- EH -->

        <!-- MC -->
        <main id="main-container">
            @include('partials.flash-message')
            @yield('content')
        </main>
        <!-- EMC -->

        <!-- F -->
        @include('layouts.back.admin-footer')
        <!-- EF -->
    </div>
    <!-- EPC -->

    <!-- CBCS -->
    <script src="{{ mix('js/codebase.app.js') }}"></script>

    @yield('js_after')
</body>

</html>
