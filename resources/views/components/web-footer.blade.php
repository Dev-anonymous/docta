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
            <a href="https://x.com/Doctatam?t=PCAkDjLrPv4M0IfiJSjv3g&s=08" target="_blank" class="twitter"><i
                    class="bi bi-twitter"></i></a>
            <a href="https://www.facebook.com/people/Ton-ami-m%C3%A9decin/61564993377127" target="_blank"
                class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.threads.net/@d.o.c.t.a" target="_blank"><i class="bi bi-threads"></i></a>
            <a href="https://www.instagram.com/d.o.c.t.a?igsh=aDBzY2xoOHdzaHcx" target="_blank" class="instagram"><i
                    class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/docta-ton-ami-m%C3%A9decin-9a08b4322" target="_blank"
                class="linkedin"><i class="bi bi-linkedin"></i></i></a>
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
                // location.assign('{{ asset('docta.apk') }}');
                location.assign('https://play.google.com/store/apps/details?id=com.docta.app');
                // window.open('https://play.google.com/store/apps/details?id=com.docta.app',
                // '_blank');
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
    @guest
    localStorage.setItem('token', '')
    @endguest
    $.ajaxSetup({
        beforeSend: function(xhr) {
            xhr.setRequestHeader('Accept', 'application/json');
            xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
            xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
        }
    });

    @auth
    $('[logout]').click(function() {
        var el = $(this);
        el.html('<i class="fa fa-spinner fa-spin fa-2x"></i>');
        $.ajax({
            type: 'post',
            url: '{{ route('web.logout') }}',
            beforeSend: function(xhr) {
                xhr.setRequestHeader('Accept', 'application/json');
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
            },
            success: function(data) {
                localStorage.setItem('token', '');
                location.reload();
            },
            error: function(data) {
                alert('Error during logout.');
                location.reload();
            }
        })
    });
    @endauth

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
