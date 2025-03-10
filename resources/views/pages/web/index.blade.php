 @extends('layouts.web')
 @section('title', 'Accueil')
 @section('meta')
     @include('components.defaultmeta')
 @endsection

 @section('body')
     <section id="hero" class="d-flex align-items-center">
         <div class="container">
             <h1>Bienvenue chez {{ config('app.name') }}</h1>
             <h2>Votre Bien-être est notre Priorité</h2>
             {{-- <a href="#contact" class="btn-get-started scrollto">Contact</a> --}}
         </div>
     </section>

     <main id="main">
         <section id="why-us" class="why-us">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-4 d-flex align-items-stretch">
                         <div class="content">
                             <h3>Pourquoi choisir {{ config('app.name') }}?</h3>
                             <p>
                                 Pas besoin de rendez-vous ni de file d'attente, de partout où vous vous trouvez discutez
                                 instantanément avec un médecin.
                                 <br><br>
                                 Docta, ton ami médecin
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
                                         <h4>Rassurant</h4>
                                         <p>
                                             Docta met à votre disposition des professionnels pour que votre joie soit
                                             parfaite. Votre bien être est notre priorité !
                                         </p>
                                     </div>
                                 </div>
                                 <div class="col-xl-4 d-flex align-items-stretch">
                                     <div class="icon-box mt-4 mt-xl-0">
                                         <i class="bx bx-check-circle"></i>
                                         <h4>Rapide</h4>
                                         <p>
                                             Le service est instantané, vous avez besoin de parler à un médecin ? Choisissez
                                             Docta !
                                         </p>
                                     </div>
                                 </div>
                                 <div class="col-xl-4 d-flex align-items-stretch">
                                     <div class="icon-box mt-4 mt-xl-0">
                                         <i class="bx bx-check-circle"></i>
                                         <h4>Discret</h4>
                                         <p>Aucune de vos données n'est conservée, discutez tranquillement de votre santé ou
                                             de celle de vos proches avec DOCTA.
                                         </p>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

             </div>
         </section>

         {{-- <section id="counts" class="counts">
             <div class="container">
                 <div class="row">
                     <div class="col-lg-3 col-md-6">
                         <div class="count-box">
                             <i class="fas fa-user-md"></i>
                             <span class="d-flex justify-content-center">
                                 <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="1"
                                     class="purecounter"></span>+</span>
                             <p>Docteurs</p>
                         </div>
                     </div>

                     <div class="col-lg-3 col-md-6 mt-5 mt-md-0">
                         <div class="count-box">
                             <i class="far fa-hospital"></i>
                             <span class="d-flex justify-content-center">
                                 <span data-purecounter-start="0" data-purecounter-end="3" data-purecounter-duration="1"
                                     class="purecounter"></span>
                             </span>
                             <p>Departements</p>
                         </div>
                     </div>

                     <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                         <div class="count-box">
                             <i class="fas fa-user-group"></i>
                             <span class="d-flex justify-content-center">
                                 <span class="d-flex justify-content-center">
                                     <span data-purecounter-start="0" data-purecounter-end="2028"
                                         data-purecounter-duration="1" class="purecounter"></span>+
                                 </span>
                             </span>
                             <p>Utilisateurs</p>
                         </div>
                     </div>

                     <div class="col-lg-3 col-md-6 mt-5 mt-lg-0">
                         <div class="count-box">
                             <i class="fas fa-phone"></i>
                             <span class="d-flex justify-content-center">
                                 <span data-purecounter-start="0" data-purecounter-end="3000" data-purecounter-duration="1"
                                     class="purecounter"></span>+
                             </span>
                             <p>Appels</p>
                         </div>
                     </div>

                 </div>

             </div>
         </section> --}}

         @if (count($slides))
             <section class="contact py-0 mb-5">
                 <div class="container">
                     <div class="row">
                         <div class="col-md-12">
                             <div>
                                 <div style="box-shadow: 0px 10px 45px rgba(0, 0, 0, 0.1);" id="carousela"
                                     class="carousel slide" data-ride="carousel" data-interval="3000">
                                     <ol class="carousel-indicators">
                                         @foreach ($slides as $k => $el)
                                             <li data-target="#carousela" data-slide-to="{{ $k }}"
                                                 class="@if (0 == $k) active @endif">
                                             </li>
                                         @endforeach
                                     </ol>
                                     <div class="carousel-inner">
                                         @foreach ($slides as $k => $el)
                                             <div class="carousel-item @if (0 == $k) active @endif">
                                                 <img height="250px" class="d-block w-100"
                                                     src="{{ asset('storage/' . $el->file) }}" style="border-radius: 10px;">
                                                 @if ($el->title or $el->text)
                                                     <div class="carousel-caption d-none d-md-block">
                                                         <div style="border-radius: 10px; background-color: rgba(15, 8, 8, 0.25)"
                                                             class="p-2">
                                                             <h5 class="font-weight-bold">{{ $el->title }}</h5>
                                                             <p class="font-weight-bold">{{ $el->text }}</p>
                                                         </div>
                                                     </div>
                                                 @endif
                                             </div>
                                         @endforeach
                                     </div>
                                     <a class="carousel-control-prev" href="#carousela" role="button" data-slide="prev">
                                         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                         <span class="sr-only">Previous</span>
                                     </a>
                                     <a class="carousel-control-next" href="#carousela" role="button" data-slide="next">
                                         <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                         <span class="sr-only">Next</span>
                                     </a>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </section>
         @endif



         <section class="contact py-0" id="about">
             <div class="container">
                 <div class="section-title">
                     <h2>Docta, qu'est ce ?</h2>
                     <p>
                         <i>Docta, ton ami médecin</i> est une plateforme virtuelle d'interaction instantanée avec un
                         médecin
                         qui a pour but de vous accompagner dans toutes vos questions et préoccupations
                         en ce qui concerne votre santé ou celle de vos proches sans avoir à vous déplacer.
                     </p>
                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2>Mission</h2>
                     <p>
                         Docta , ton ami médecin a pour mission de vous faciliter la vie en vous accompagnant dans toutes
                         vos questions relatives à la santé ( votre santé ou celle de vos proches ), afin de mieux
                         comprendre votre corps et sa santé, prendre les décisions bien éclairées et explicitées en francais
                         facile. En effet, Docta met à votre disposition des médecins régulièrement inscrits à l'ordre des
                         médecins et disposant d'une expérience clinique minimale de 3 ans.
                     </p>
                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2> Services offerts</h2>
                     <div class="d-flex justify-content-center">
                         <ul class="text-start">
                             <li>La version simple permet une interaction instantanée avec un médecin par appel ou
                                 messagerie (
                                 avec possibilité de joindre un fichier et/ou faire un audio ).</li>
                             <li>
                                 La version premium : bientôt disponible vous rendra la vie encore plus facile.
                             </li>
                         </ul>
                     </div>
                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2>Paiement</h2>
                     <div class="d-flex justify-content-center">
                         <ul class="text-start">
                             {{-- <li><i class="fa fa-check-circle text-success"></i> Online banking via carte bancaire</li> --}}
                             <li><i class="fa fa-check-circle text-success"></i> Mobile money pour les résidants de la
                                 République démocratique du Congo : Airtel money, Orange money, M-pesa, Afrimoney</li>
                         </ul>
                     </div>
                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2>Pourquoi choisir Docta ?</h2>
                     <p>Docta, ton ami médecin vient réellement vous procurer un ami médecin et vous faire gagner du
                         temps en vous
                         donnant la capacité de le joindre de manière instantanée via son application depuis le lieu
                         où vous êtes(
                         chambre, bureau, taxi, etc.)
                     </p>

                 </div>
             </div>
             <div class="container">
                 <div class="section-title">
                     <h2> Docta, y a-t-il des restrictions ? </h2>
                     <p>Docta, est réellement ton ami médecin et ne connait donc pas de restriction dans son service en
                         ce qui concerne : la religion, la race, le sexe, l'âge, l'appartenance tribale, etc..Docta, se
                         limite à vous répondre et vous accompagner dans la bonne compréhension et prise de décision pour
                         votre bonne santé.
                     </p>

                 </div>
             </div>
         </section>

         <section id="contact" class="contact py-0">
             {{-- <div class="container">
                 <div class="section-title">
                     <h2>Contact</h2>
                     <p>Besoin de plus d'informations ? n'hésitez pas à nous contacter.</p>
                 </div>
             </div> --}}
             {{-- <div>
                 <iframe style="border:0; width: 100%; height: 350px;"
                     src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d125032.68739457447!2d27.41979049233817!3d-11.675162240022242!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19723ea34874cbd9%3A0xa1c6f5a74f805b2f!2sLubumbashi!5e0!3m2!1sen!2scd!4v1715285465474!5m2!1sen!2scd"
                     allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
             </div> --}}
             <div class="container">
                 <div class="row mt-5">
                     <div class="section-title">
                         <h2>Contact</h2>
                         <p>Besoin de plus d'informations ? n'hésitez pas à nous contacter.</p>
                     </div>
                     <div class="col-lg-4">
                         <div class="info">
                             {{-- <div class="address">
                                 <i class="bi bi-geo-alt"></i>
                                 <h4>Adresse:</h4>
                                 <p>N°465, Av/ kintambo, golf faustin, commune Annexe, Lubumbashi, RDC </p>
                             </div> --}}

                             <div class="email">
                                 <i class="bi bi-envelope"></i>
                                 <h4>Email:</h4>
                                 <p><a href="mailto:contact@docta-tam.com" class="text-muted">contact@docta-tam.com</a>
                                 </p>
                             </div>

                             <div class="phone">
                                 <i class="bi bi-phone"></i>
                                 <h4>Appel:</h4>
                                 <p>
                                     <a href="tel:+243980004002" class="text-muted">+243 98 000 40 02</a>
                                 </p>
                             </div>
                         </div>
                     </div>

                     <div class="col-lg-8 mt-5 mt-lg-0 mb-5" id="contact-form">

                         <form id="fcont" action="#" class="php-email-form">
                             @csrf
                             <div class="row">
                                 <div class="col-md-6 form-group">
                                     <input type="text" name="name" class="form-control" id="name"
                                         placeholder="Votre nom" required>
                                 </div>
                                 <div class="col-md-6 form-group mt-3 mt-md-0">
                                     <input class="form-control" name="email" id="email"
                                         placeholder="Votre Email ou Phone" required>
                                 </div>
                             </div>
                             <div class="form-group mt-3">
                                 <input type="text" class="form-control" name="subject" id="subject"
                                     placeholder="Subjet" required>
                             </div>
                             <div class="form-group mt-3">
                                 <textarea class="form-control" name="message" rows="5" placeholder="Message" required></textarea>
                             </div>
                             <div class="form-group mt-3">
                                 {!! NoCaptcha::renderJs('fr') !!}
                                 {!! NoCaptcha::display() !!}
                             </div>
                             <div class="my-3">
                                 <div id="rep" class="loading"></div>
                             </div>
                             <div class="alert alert-warning">
                                 <b class="text-danger">
                                     <i class="fa fa-exclamation-triangle "></i>
                                     Le message que vous envoyez via ce formulaire N'EST TRANSFÉRÉ À AUCUN DOCTEUR mais
                                     plutôt à l'entreprise, si vous souhaitez vous adresser à un docteur, Cliquez sur
                                     l'icône message en <span class="text-info">BLEU</span> en bas de la page.
                                 </b>
                             </div>
                             <div class="text-center"><button type="submit"><span></span> Envoyer</button></div>
                         </form>

                     </div>

                 </div>

             </div>
         </section>

     </main>
 @endsection

 @section('js')
     <style>
         .carousel {
             position: relative;
         }

         .carousel-inner {
             position: relative;
             width: 100%;
             overflow: hidden;
         }

         .carousel-item {
             position: relative;
             display: none;
             align-items: center;
             width: 100%;
             backface-visibility: hidden;
             perspective: 1000px;
         }

         .carousel-item.active,
         .carousel-item-next,
         .carousel-item-prev {
             display: block;
             transition: transform 0.6s ease;
         }

         @media screen and (prefers-reduced-motion: reduce) {

             .carousel-item.active,
             .carousel-item-next,
             .carousel-item-prev {
                 transition: none;
             }
         }

         .carousel-item-next,
         .carousel-item-prev {
             position: absolute;
             top: 0;
         }

         .carousel-item-next.carousel-item-left,
         .carousel-item-prev.carousel-item-right {
             transform: translateX(0);
         }

         @supports (transform-style: preserve-3d) {

             .carousel-item-next.carousel-item-left,
             .carousel-item-prev.carousel-item-right {
                 transform: translate3d(0, 0, 0);
             }
         }

         .carousel-item-next,
         .active.carousel-item-right {
             transform: translateX(100%);
         }

         @supports (transform-style: preserve-3d) {

             .carousel-item-next,
             .active.carousel-item-right {
                 transform: translate3d(100%, 0, 0);
             }
         }

         .carousel-item-prev,
         .active.carousel-item-left {
             transform: translateX(-100%);
         }

         @supports (transform-style: preserve-3d) {

             .carousel-item-prev,
             .active.carousel-item-left {
                 transform: translate3d(-100%, 0, 0);
             }
         }

         .carousel-fade .carousel-item {
             opacity: 0;
             transition-duration: .6s;
             transition-property: opacity;
         }

         .carousel-fade .carousel-item.active,
         .carousel-fade .carousel-item-next.carousel-item-left,
         .carousel-fade .carousel-item-prev.carousel-item-right {
             opacity: 1;
         }

         .carousel-fade .active.carousel-item-left,
         .carousel-fade .active.carousel-item-right {
             opacity: 0;
         }

         .carousel-fade .carousel-item-next,
         .carousel-fade .carousel-item-prev,
         .carousel-fade .carousel-item.active,
         .carousel-fade .active.carousel-item-left,
         .carousel-fade .active.carousel-item-prev {
             transform: translateX(0);
         }

         @supports (transform-style: preserve-3d) {

             .carousel-fade .carousel-item-next,
             .carousel-fade .carousel-item-prev,
             .carousel-fade .carousel-item.active,
             .carousel-fade .active.carousel-item-left,
             .carousel-fade .active.carousel-item-prev {
                 transform: translate3d(0, 0, 0);
             }
         }

         .carousel-control-prev,
         .carousel-control-next {
             position: absolute;
             top: 0;
             bottom: 0;
             display: flex;
             align-items: center;
             justify-content: center;
             width: 15%;
             color: #fff;
             text-align: center;
             opacity: 0.5;
         }

         .carousel-control-prev:hover,
         .carousel-control-prev:focus,
         .carousel-control-next:hover,
         .carousel-control-next:focus {
             color: #fff;
             text-decoration: none;
             outline: 0;
             opacity: .9;
         }

         .carousel-control-prev {
             left: 0;
         }

         .carousel-control-next {
             right: 0;
         }

         .carousel-control-prev-icon,
         .carousel-control-next-icon {
             display: inline-block;
             width: 20px;
             height: 20px;
             background: transparent no-repeat center center;
             background-size: 100% 100%;
         }

         .carousel-control-prev-icon {
             background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E");
         }

         .carousel-control-next-icon {
             background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E");
         }

         .carousel-indicators {
             position: absolute;
             right: 0;
             bottom: 10px;
             left: 0;
             z-index: 15;
             display: flex;
             justify-content: center;
             padding-left: 0;
             margin-right: 15%;
             margin-left: 15%;
             list-style: none;
         }

         .carousel-indicators li {
             position: relative;
             flex: 0 1 auto;
             width: 30px;
             height: 3px;
             margin-right: 3px;
             margin-left: 3px;
             text-indent: -999px;
             cursor: pointer;
             border-radius: 50px;
             background-color: rgba(15, 8, 8, 0.5);
         }

         .carousel-indicators li::before {
             position: absolute;
             top: -10px;
             left: 0;
             display: inline-block;
             width: 100%;
             height: 10px;
             content: "";
         }

         .carousel-indicators li::after {
             position: absolute;
             bottom: -10px;
             left: 0;
             display: inline-block;
             width: 100%;
             height: 10px;
             content: "";
         }

         .carousel-indicators .active {
             background-color: #02BBFF;
         }

         .carousel-caption {
             position: absolute;
             right: 15%;
             bottom: 20px;
             left: 15%;
             z-index: 10;
             padding-top: 20px;
             padding-bottom: 20px;
             color: #fff;
             text-align: center;
         }
     </style>
     <script src="{{ asset('plugins/common/common.min.js') }}"></script>
 @endsection
