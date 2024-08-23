<footer id="footer">
    <div class="container d-md-flex py-4">
        <div class="me-md-auto text-center text-md-start">
            <div class="mb-3">
                <a href="{{ route('web.terme') }}" class="mr-2">Termes et conditions</a> |
                <a href="{{ route('web.politique') }}" class="mr-2">Politique de confidentialité</a> |
                <a href="{{ route('web.mention') }}" class="mr-2">Mentions légales</a>
            </div>
            <div class="copyright">
                &copy; {{ date('Y') }} Copyright <strong><span>{{ config('app.name') }}</span></strong>. All
                Rights Reserved
            </div>

        </div>
        <div class="social-links text-center text-md-right pt-3 pt-md-0">
            <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
            <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
            <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
        </div>
    </div>
</footer>

<div id="preloader"></div>
<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
        class="bi bi-arrow-up-short"></i></a>

<script src="{{ asset('assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
<script src="{{ asset('assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

<script src="{{ asset('assets/js/main.js') }}"></script>
<script>
    document.getElementById("dapp").addEventListener("click", function() {
        event.preventDefault();
        var el = $(this);
        var ht = el.html();
        el.html("<i class='spinner-border spinner-border-sm'></i>");
        $.ajax({
            url: '{{ route('dl') }}',
            success: function() {
                location.assign('{{ asset('docta.apk') }}');
            },
            error: function() {
                alert("Echec de connexion, veuillez relancer le téléchargement SVP.")
            }
        }).always(function() {
            el.html(ht);
        });
    });
</script>

<script src="{{ asset('assets/js/jq.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Accept': 'application/json',
        }
    });
    $('#fcont').submit(function() {
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
            url: '{{ route('contact.store') }}',
            success: function(data) {
                if (data.success) {
                    form[0].reset();
                    rep.removeClass().addClass('alert alert-success');
                    setTimeout(() => {
                        rep.stop().slideUp();
                    }, 3000);
                } else {
                    rep.removeClass().addClass('alert alert-danger');
                }
                rep.html(data.message).slideDown();
            },
            error: function(data) {
                rep.removeClass().addClass('alert alert-danger').html(
                    "Oops ! please retry.").slideDown();
            }
        }).always(function() {
            btn.find('span').removeClass();
            $(':input', form).attr('disabled', false);
        })
    });

    @if (!Route::is('web.index'))
        $('.scrollto').click(function() {
            var href = '{{ route('web.index') }}';
            location.href = href + '/' + this.hash;
        });
    @endif
</script>
<x-chatbox />
