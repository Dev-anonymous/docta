<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="theme-color" content="#02BBFF">
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>@yield('title') - {{ config('app.name') }} </title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <meta name="description" content="Votre Bien-être est notre Priorité">
    <meta property="og:title" content="Bienvenue chez {{ config('app.name') }}">
    <meta property="og:description" content="Votre bien-être est notre Priorité">
    <meta property="og:image" content="{{ asset('images/icon.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    @yield('meta')

    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>
    <x-web-header />
    @yield('body')
    <x-web-footer />
    @yield('js')
</body>

</html>
