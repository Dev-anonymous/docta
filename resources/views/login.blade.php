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
                                    <h4>{{ config('app.name') }}</h4>
                                </a>
                                <form class="mt-5 mb-5 login-input" id="log">
                                    @csrf
                                    <div class="form-group">
                                        <label for="login">Email ou Tel.</label>
                                        <input required type="email" class="form-control" name="login"
                                            id="login" placeholder="Ex: 099xxxx ou email@docta.com">
                                    </div>
                                    <div class="form-group">
                                        <label for="pass">Mot de passe</label>
                                        <input required id="pass" type="password" class="form-control"
                                            name="password" placeholder="Mot de passe">
                                    </div>
                                    <div class="w-100" id="rep"></div>
                                    <button class="btn login-form__btn submit w-100"><span></span> Connexion</button>
                                </form>
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

    <script>
        $(function() {
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


            })
        })
    </script>
</body>

</html>
