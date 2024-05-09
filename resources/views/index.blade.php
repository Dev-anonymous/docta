<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Accueil - {{ config('app.name') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
    <meta name="description" content="Your health is our priority.">
    <meta property="og:title" content="Welcome to {{ config('app.name') }}">
    <meta property="og:description" content="Your health is our priority.">
    <meta property="og:image" content="{{ asset('images/logo.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">

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

    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope"></i> <a href="mailto:contact@docta-tam.com">contact@docta-tam.com</a>
                <i class="bi bi-phone"></i> <a href="tel:+243851810869" class="text-muted">+243 85 18 10 869</a>
            </div>
            <div class="d-none d-lg-flex social-links align-items-center">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
            </div>
        </div>
    </div>

    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">

            <a href="/" class="logo me-auto"><img src="{{ asset('images/logo.png') }}" alt=""
                    class="img-fluid"></a>

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a class="nav-link scrollto active" href="#hero">Home</a></li>
                    <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

            <a href="#" class="appointment-btn" id="dapp">
                <span class="d-none d-md-inline"><i class="fa fa-download"></i> Download </span>APP
            </a>

        </div>
    </header>

    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <h1>Welcome to {{ config('app.name') }}</h1>
            <h2>Your health is our priority.</h2>
            <a href="#contact" class="btn-get-started scrollto">Get Started</a>
        </div>
    </section>

    <main id="main">

        <section id="why-us" class="why-us">
            <div class="container">

                <div class="row">
                    <div class="col-lg-4 d-flex align-items-stretch">
                        <div class="content">
                            <h3>Why Choose {{ config('app.name') }}?</h3>
                            <p>
                                No need for an appointment or waiting in line, chat instantly with a doctor from the
                                comfort of your bedroom, living room, office, etc. at any time and from any location on
                                the globe. Docta, your doctor friend.
                            </p>
                            {{-- <div class="text-center">
                                <a href="#" class="more-btn">Learn More <i class="bx bx-chevron-right"></i></a>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-8 d-flex align-items-stretch">
                        <div class="icon-boxes d-flex flex-column justify-content-center">
                            <div class="row">
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-check-circle"></i>
                                        <h4>Reassuring</h4>
                                        <p>Your well-being is our priority! we will do our best to provide you with the
                                            best of ourselves.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-check-circle"></i>
                                        <h4>Fast</h4>
                                        <p>No need to wait in line at the hospital! with Docta, just a call or a message
                                            will save you from long processes.</p>
                                    </div>
                                </div>
                                <div class="col-xl-4 d-flex align-items-stretch">
                                    <div class="icon-box mt-4 mt-xl-0">
                                        <i class="bx bx-check-circle"></i>
                                        <h4>Discreet</h4>
                                        <p>Ask a special doctor in complete discretion, none of your data will be kept.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <section id="counts" class="counts">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="count-box">
                            <i class="fas fa-user-md"></i>
                            <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Doctors</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                        <div class="count-box">
                            <i class="far fa-hospital"></i>
                            <span data-purecounter-start="0" data-purecounter-end="8" data-purecounter-duration="1"
                                class="purecounter"></span>
                            <p>Departments</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-user-group"></i>
                            <span data-purecounter-start="0" data-purecounter-end="2028"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Users</p>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                        <div class="count-box">
                            <i class="fas fa-phone"></i>
                            <span data-purecounter-start="0" data-purecounter-end="1200"
                                data-purecounter-duration="1" class="purecounter"></span>
                            <p>Calls</p>
                        </div>
                    </div>

                </div>

            </div>
        </section>

        <section id="contact" class="contact">
            <div class="container">

                <div class="section-title">
                    <h2>Contact</h2>
                    <p>Need more informations? don't hesitate to contact us.</p>
                </div>
            </div>

            <div>
                <iframe style="border:0; width: 100%; height: 350px;"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125032.68739457447!2d27.41979049233817!3d-11.675162240022242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19723ea34874cbd9%3A0xa1c6f5a74f805b2f!2sLubumbashi!5e0!3m2!1sen!2scd!4v1715285465474!5m2!1sen!2scd"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>

            <div class="container">
                <div class="row mt-5">

                    <div class="col-lg-4">
                        <div class="info">
                            <div class="address">
                                <i class="bi bi-geo-alt"></i>
                                <h4>Location:</h4>
                                <p>Lubumbashi, DRC</p>
                            </div>

                            <div class="email">
                                <i class="bi bi-envelope"></i>
                                <h4>Email:</h4>
                                <p>contac@docta-tam.com</p>
                            </div>

                            <div class="phone">
                                <i class="bi bi-phone"></i>
                                <h4>Call:</h4>
                                <p>
                                    <a href="tel:+243851810869" class="text-muted">+243 85 18 10 869</a>
                                </p>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-8 mt-5 mt-lg-0">

                        <form id="fcont" action="#" class="php-email-form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Your Name" required>
                                </div>
                                <div class="col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Your Email or Phone" required>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <input type="text" class="form-control" name="subject" id="subject"
                                    placeholder="Subject" required>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                            </div>
                            <div class="my-3">
                                <div id="rep" class="loading"></div>
                            </div>
                            <div class="text-center"><button type="submit"><span></span> Send Message</button></div>
                        </form>

                    </div>

                </div>

            </div>
        </section>

    </main>

    <footer id="footer">
        <div class="container d-md-flex py-4">
            <div class="me-md-auto text-center text-md-start">
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
    {{-- <script src="{{ asset('assets/vendor/php-email-form/validate.js') }}"></script> --}}

    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script>
        document.getElementById("dapp").addEventListener("click", function() {
            event.preventDefault();
            location.assign('{{ asset('docta.apk') }}');
        });
    </script>

    <script src="{{ asset('assets/js/jq.min.js') }}"></script>
    <script>
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
        })
    </script>
</body>

</html>
