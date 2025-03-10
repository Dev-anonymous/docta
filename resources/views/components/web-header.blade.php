<div id="topbar" class="d-flex align-items-center fixed-top">
    <div class="container d-flex justify-content-between">
        <div class="contact-info d-flex align-items-center">
            <i class="bi bi-envelope"></i> <a href="mailto:contact@docta-tam.com">contact@docta-tam.com</a>
            <i class="bi bi-phone"></i> <a href="tel:+243980004002" class="text-muted">+243 98 000 40 02</a>
        </div>
        <div class="d-none d-lg-flex social-links align-items-center">
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
</div>
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center">

        <a href="/" class="logo me-auto"><img src="{{ asset('images/logo.png') }}" alt=""
                class="img-fluid"></a>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li>
                    <a class="nav-link scrollto" href="#hero">
                        <div class="">
                            <i class="fa fa-home"></i>
                            <span style="margin-left: 5px">Accueil</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="nav-link @if (Route::is('doctamag')) active @endif" href="{{ route('doctamag') }}">
                        <div class="">
                            <i class="fa fa-book-atlas"></i>
                            <span style="margin-left: 5px">Docta Mag</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto" href="#about">
                        <div class="">
                            <i class="fa fa-building"></i>
                            <span style="margin-left: 5px">A propos</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a class="nav-link scrollto" href="#contact">
                        <div class="">
                            <i class="fa fa-phone"></i>
                            <span style="margin-left: 5px">Contact</span>
                        </div>
                    </a>
                </li>
                @guest
                    <li>
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fa fa-unlock"></i>
                            <span style="margin-left: 5px">Connexion</span>
                        </a>
                    </li>
                @endguest
                @auth
                    @php
                        $user = auth()->user();
                        $abo = $user->abonnements()->orderBy('id', 'desc')->first();
                        $lab = '';
                        if ($abo) {
                            $key = explode('-', $abo->key);
                            $lab = moislabel((int) $key[0]) . " $key[1]";
                        }
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-user-alt"></i> <span style="margin-left: 5px">{{ $user->name }}</span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @if ($user->user_role == 'admin')
                                <li><a class="dropdown-item" href="{{ route('admin.home') }}">Dashboard</a></li>
                            @endif
                            {{-- <li><a class="dropdown-item" href="#">Another action</a></li> --}}
                            <li class="text-muted">
                                <small style="margin-left: 10px">Mon compte</small>
                                <p class="dropdown-item m-0">
                                    {{ $user->email }} <br>
                                    +{{ $user->phone }}
                                </p>
                                <hr>
                                <small style="margin-left: 10px">Mon abonnement</small>
                                <p class="dropdown-item m-0">
                                    @if (empty($lab))
                                        <b>Aucun abonnement</b>
                                    @else
                                        <b class="text-success"><i class="fa fa-check-circle"></i> {{ $lab }}</b>
                                    @endif
                                </p>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" onclick="event.preventDefault()" logout>
                                    Déconnexion
                                </a>
                            </li>
                        </ul>
                    </li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav>

        <a href="#" class="appointment-btn" id="dapp" style="display: none">
            <span class="d-none d-md-inline"> Télécharger l'</span> APP <i class="fa-brands fa-google-play"></i></span>
        </a>
    </div>
</header>
