<!DOCTYPE html>
<html lang="fr">

<head>
    <meta name="theme-color" content="#02BBFF">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title') - {{ config('app.name') }} </title>
    @yield('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @include('files.css')
</head>

<body>
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div id="main-wrapper">
        <div class="nav-header" style="background-color: #fff">
            <div class="brand-logo">
                <a href="{{ route('admin.home') }}">
                    <b class="logo-abbr">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                    </b>
                    <span class="logo-compact">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                    </span>
                    <span class="brand-title">
                        <img src="{{ asset('images/logo.png') }}" alt="">
                    </span>
                </a>
            </div>
        </div>

        <x-header />
        <x-sidebar />

        @yield('body')

        <div class="footer">
            <div class="copyright">
                <p>Copyright &copy; {{ date('Y') }}, {{ config('app.name') }}</p>
            </div>
        </div>
    </div>

    @include('files.js')
    @yield('js-code')

</body>

</html>
