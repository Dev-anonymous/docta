<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="theme-color" content="#02BBFF">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Connexion | {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body class="h-100">
    <div id="preloader">
        <div class="loader">
            <svg class="circular" viewBox="25 25 50 50">
                <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3"
                    stroke-miterlimit="10" />
            </svg>
        </div>
    </div>

    <div class="login-form-bg h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="col-xl-6">
                    <div class="form-input-content">
                        <div class="card login-form mb-0">
                            <div class="card-body pt-5">
                                <a class="text-center" href="/">
                                    <h4>
                                        <img src="{{ asset('images/logo.png') }}" alt="" width="150px">
                                    </h4>
                                </a>
                                <div id="dlog">
                                    <form class="mt-5 mb-5 login-input" id="log">
                                        <h3 class="text-center">Connexion</h3>
                                        @csrf
                                        <div class="form-group">
                                            <label for="login">Email ou Tel.</label>
                                            <input required class="form-control" name="login" id="login"
                                                placeholder="Ex: 099xxxx ou email@docta.com">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass">Mot de passe</label>
                                            <input required id="pass" type="password" class="form-control"
                                                name="password" placeholder="Mot de passe">
                                        </div>
                                        <div class="form-check form-check-inline mb-3">
                                            <input name="remember" class="form-check-input" type="checkbox"
                                                id="inlineCheckbox1">
                                            <label class="form-check-label" for="inlineCheckbox1">Resté connecté</label>
                                        </div>
                                        <div class="w-100" id="rep"></div>
                                        <button class="btn btn-block" style="background: var(--appcolor);">
                                            <span></span>
                                            Connexion
                                        </button>
                                        <button type="button" bcmpt class="btn btn-link mt-2"><i
                                                class="fa fa-user-plus"></i>
                                            Créer un compte</button>
                                    </form>
                                </div>
                                <div id="dcmpt" style="display: none">
                                    <form class="mt-5 mb-5 login-input" id="cmpt">
                                        <h3 class="text-center">Nouveau compte</h3>
                                        @csrf
                                        <div class="form-group">
                                            <label for="login">Nom</label>
                                            <input required class="form-control" name="name"
                                                placeholder="Votre nom complet">
                                        </div>
                                        <div class="form-group">
                                            <label for="login">Email</label>
                                            <input required class="form-control" name="email"
                                                placeholder="Votre email">
                                        </div>
                                        <div class="form-group">
                                            <label for="tel">Tel</label>
                                            <input required class="form-control phone" placeholder="Votre numero">
                                        </div>
                                        <div class="form-group">
                                            <label for="pass">Mot de passe</label>
                                            <input required type="password" class="form-control" name="password"
                                                placeholder="Mot de passe">
                                        </div>
                                        <div class="w-100" id="rep"></div>
                                        <button class="btn btn-block" style="background: var(--appcolor);">
                                            <span></span>
                                            Je créer mon compte
                                        </button>
                                        <button type="button" blog class="btn btn-link mt-2"><i
                                                class="fa fa-lock"></i>
                                            Se connecter</button>
                                    </form>
                                </div>

                            </div>
                            <div class="card-footer">
                                <button onclick="history.back()" class="btn btn-link"><i
                                        class="fa fa-arrow-left"></i>
                                    Retour</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/common/common.min.js') }}"></script>
    <script src="{{ asset('js/custom.min.js') }}"></script>
    <script src="{{ asset('js/settings.js') }}"></script>
    <script src="{{ asset('js/gleek.js') }}"></script>
    <script src="{{ asset('js/styleSwitcher.js') }}"></script>

    <script src="{{ asset('plugins/intl/js.js') }}"></script>
    <script src="{{ asset('plugins/intl/imask.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('plugins/intl/css.css') }}">
    <style>
        .iti.iti--show-flags.iti--inline-dropdown {
            width: 100% !important
        }
    </style>
    <script>
        window.intlTelInput($('.phone')[0], {
            separateDialCode: true,
            initialCountry: "auto",
            geoIpLookup: function(callback) {
                $.get("https://ipinfo.io", function() {}, "jsonp").always(function(resp) {
                    var countryCode = (resp && resp.country) ? resp.country : "CD";
                    callback(countryCode);
                });
            },
        });

        $('.phone').each(function(i, e) {
            IMask(e, {
                mask: '00000000000'
            });
        });

        $('[bcmpt]').click(function() {
            event.preventDefault();
            $('#dlog').stop().slideUp();
            $('#dcmpt').stop().slideDown();
        });
        $('[blog]').click(function() {
            event.preventDefault();
            $('#dcmpt').stop().slideUp();
            $('#dlog').stop().slideDown();
        })

        $('#log').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form);
            btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
            var data = form.serialize();
            $(':input', form).attr('disabled', true);
            var rep = $('#rep', form);
            rep.stop().slideUp();
            $.ajax({
                type: 'post',
                data: data,
                url: '{{ route('web.login') }}',
                success: function(data) {
                    if (data.success) {
                        form[0].reset();
                        localStorage.setItem('token', data.data.token);
                        rep.removeClass().addClass('alert alert-success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        rep.removeClass().addClass('alert alert-danger');
                    }
                    rep.html(data.message).slideDown();
                },
                error: function(data) {
                    rep.removeClass().addClass('alert alert-danger').html(
                        "Erreur, veuillez réessayer.").slideDown();
                }
            }).always(function() {
                btn.find('span').removeClass();
                $(':input', form).attr('disabled', false);
            })


        });

        $('#cmpt').submit(function() {
            event.preventDefault();
            var form = $(this);
            var btn = $(':submit', form);
            btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
            var data = form.serialize();
            var d = $('.iti__selected-dial-code').html().trim();
            var p = $('.phone').val();
            var phone = '' + d + p;
            data += '&phone=' + phone;

            $(':input', form).attr('disabled', true);
            var rep = $('#rep', form);
            rep.stop().slideUp();


            $.ajax({
                type: 'post',
                data: data,
                url: '{{ route('web.signup') }}',
                success: function(data) {
                    if (data.success) {
                        form[0].reset();
                        localStorage.setItem('token', data.data.token);
                        rep.removeClass().addClass('alert alert-success');
                        setTimeout(() => {
                            location.reload();
                        }, 2000);
                    } else {
                        rep.removeClass().addClass('alert alert-danger');
                    }
                    rep.html(data.message).slideDown();
                },
                error: function(data) {
                    rep.removeClass().addClass('alert alert-danger').html(
                        "Erreur, veuillez réessayer.").slideDown();
                }
            }).always(function() {
                btn.find('span').removeClass();
                $(':input', form).attr('disabled', false);
            });

        })
    </script>
</body>

</html>
