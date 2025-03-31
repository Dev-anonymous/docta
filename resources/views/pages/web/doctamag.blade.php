 @extends('layouts.web')
 @section('title', 'Docta Mag')
 @section('meta')
     <link rel="icon" type="image/png" href="{{ asset('images/icon.png') }}">
     <meta property="og:image" content="{{ asset('images/icon.png') }}">
     <meta property="og:url" content="{{ url()->current() }}">

     <meta name="description"
         content="@if ($mag) {{ $mag->titre }} @else  Bienvenue sur Docta Mag @endif">
     <meta property="og:title" content="@if ($mag) {{ $mag->titre }} @else  Docta Mag @endif">
     <meta property="og:description"
         content="@if ($mag) {{ $mag->titre }} @else  Bienvenue sur Docta Mag @endif">
     <style>
         .catpanel {
             box-shadow: 0px 10px 45px rgba(0, 0, 0, 0.2);
             padding: 10px;
             border-radius: 20px;
             margin-bottom: 10px;
         }

         .carte {
             box-shadow: 0px 10px 45px rgba(0, 0, 0, 0.3);
             transition: transform .5s;
             border-radius: 20px !important;
         }

         .carte img {
             border-top-right-radius: 20px;
             border-top-left-radius: 20px;
         }

         .carte>.card-footer {
             border-bottom-left-radius: 20px !important;
             border-bottom-right-radius: 20px !important;
         }

         .carte:hover {
             box-shadow: 0px 10px 45px rgba(0, 0, 0, 0.1);
             transform: scale(1.02);
         }

         .catpanel>div:hover {
             transform: scale(1.02);
         }
     </style>
 @endsection
 @section('body')
     <section id="hero2" class="d-flex align-items-center" style="height: 80vh;">
         <div class="container">
             <h1>Bienvenue sur Docta Mag</h1>
             <h2>
                 Chaque mois, le Magazine Docta vous plonge au cœur de l'univers de la santé avec une approche claire,
                 accessible et scientifiquement rigoureuse. Conçu pour informer, sensibiliser et accompagner ses lecteurs,
                 le Magazine Docta couvre un large éventail de thématiques essentielles à votre bien-être. <br> <br>
                 Ce n'est pas tout ! Dans la rubrique "<b>Votre Minute Santé</b>", retrouvez des articles gratuits pour une santé
                 éclairée, accessibles à tous, à tout moment !
             </h2>
         </div>
     </section>

     <main id="main">
         <section class="contact" style="margin-top: 12%">
             <div class="container">
                 @if ($mag)
                     <div class="w-100" magdiv>
                         <div class="d-flex justify-content-center">
                             <div class="">
                                 <div class="mb-3">
                                     <b>Magazine du : {{ $mag->date?->format('d-m-Y') }}</b> <br>
                                     <b>Date publication : {{ $mag->datepublication?->format('d-m-Y H:i:s') }}</b> <br>
                                     <b>Catégorie : {{ $mag->categoriemagazine->categorie }}</b>
                                 </div>
                                 <div class="">
                                     <h1 class="mb-3">{{ $mag->titre }}</h1>
                                     <p>{{ $mag->description }}</p>
                                 </div>
                                 <hr>
                                 <div class="mb-5">
                                     {!! $mag->text !!}
                                 </div>
                                 <div class="mb-5">
                                     @guest
                                         <button class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#offline">
                                             <i class="fa fa-download"></i>
                                             Télécharger
                                         </button>
                                     @endguest
                                     @auth
                                         @if (@$mag->fichier)
                                             @if (candl(auth()->user(), $mag))
                                                 <button value="{{ $mag->id }}" class="btn btn-outline-info btn-sm" dlmag>
                                                     <i class="fa fa-download"></i>
                                                     Télécharger
                                                 </button>
                                             @else
                                                 <button value="{{ magkey($mag) }}"
                                                     label="{{ moislabel((int) $mag->date->format('m')) }} {{ date('Y') }}"
                                                     class="btn btn-outline-warning btn-sm" subscribe>
                                                     <i class="fa fa-download"></i>
                                                     Télécharger
                                                 </button>
                                             @endif
                                         @endif
                                     @endauth
                                 </div>
                                 <small>Date publication : {{ $mag->datepublication?->format('d-m-Y H:i:s') }}</small>
                             </div>
                         </div>
                     </div>
                 @else
                     <div class="row">
                         <div class="col-12 mb-3">
                             <div class="catpanel d-lg-flex justify-content-center">
                                 @if (request('mcat'))
                                     <div onclick="location.assign('{{ route('doctamag') }}')"
                                         class="shadow-lg rounded-5 p-2 m-1" style="cursor: pointer;background: #ccc;">
                                         <b>
                                             <i class="fa fa-check-circle"></i>
                                             <span>
                                                 Tout afficher
                                             </span>
                                         </b>
                                     </div>
                                 @endif
                                 @foreach ($cats as $el)
                                     @php
                                         $isactive = request('mcat') == $el->categorie;
                                     @endphp
                                     <div onclick="location.assign('{{ route('doctamag', ['mcat' => $el->categorie]) }}')"
                                         class="shadow-lg rounded-5 p-2 m-1" style="cursor: pointer;background: #ccc;">
                                         <b class="@if ($isactive) text-danger @endif">
                                             <i
                                                 class="fa @if ($isactive) fa-check-circle @else fa-book @endif "></i>
                                             <span>
                                                 {{ $el->categorie }}
                                                 <span class="badge  badge-pill bg-info">{{ $el->magazines_count }}</span>
                                             </span>
                                         </b>
                                     </div>
                                 @endforeach
                             </div>
                         </div>
                         <div class="row" magdiv>
                             @foreach ($magazines as $el)
                                 <div class="col-md-4 mb-3">
                                     <div class="card carte">
                                         <img src="{{ asset('storage/' . $el->image) }}" style="height: 250px; width: 100%"
                                             alt="">
                                         <div cldass="px-3">
                                             <div class="d-flex justify-content-between px-3">
                                                 <i class="text-muted small">
                                                     {{ $el->datepublication?->format('d-m-Y H:i:s') }}
                                                 </i>
                                                 <div class="">
                                                     @if (candl(auth()->user(), $el))
                                                         <div>
                                                             <span class="badge bg-success">
                                                                 <i class="fa fa-star"></i> Gratuit
                                                             </span>
                                                         </div>
                                                     @endif
                                                 </div>
                                             </div>
                                         </div>
                                         <div class="card-body pt-0" style="height: 350px; overflow: auto;">
                                             <i class="text-muted small">{{ $el->categoriemagazine->categorie }}</i>
                                             <h5 class="card-title">{{ $el->titre }}</h5>
                                             <p class="card-text">
                                             <div>
                                                 {{ $el->description }}
                                             </div>
                                             </p>
                                         </div>
                                         <div class="card-footer bg-white border-top-0 d-flex justify-content-between">
                                             <div class="">
                                                 @php

                                                 @endphp
                                                 @guest
                                                     <button class="btn btn-outline-info btn-sm" data-toggle="modal"
                                                         data-target="#offline">
                                                         <i class="fa fa-download"></i>
                                                         Télécharger
                                                     </button>
                                                 @endguest
                                                 @auth
                                                     @if ($el->fichier)
                                                         @if (candl(auth()->user(), $el))
                                                             @if ($el->free)
                                                                 <button value="{{ $el->id }}"
                                                                     class="btn btn-outline-success btn-sm" dlmag>
                                                                     <i class="fa fa-download"></i>
                                                                     Télécharger
                                                                 </button>
                                                             @else
                                                                 <button value="{{ $el->id }}"
                                                                     class="btn btn-outline-info btn-sm" dlmag>
                                                                     <i class="fa fa-download"></i>
                                                                     Télécharger
                                                                 </button>
                                                             @endif
                                                         @else
                                                             <button value="{{ magkey($el) }}"
                                                                 label="{{ moislabel((int) $el->date->format('m')) }} {{ date('Y') }}"
                                                                 class="btn btn-outline-warning btn-sm" subscribe>
                                                                 <i class="fa fa-download"></i>
                                                                 Télécharger
                                                             </button>
                                                         @endif
                                                     @endif
                                                 @endauth
                                             </div>
                                             <div class="">
                                                 @php
                                                     $n = strlen($el->text);
                                                 @endphp
                                                 @if ($n > 10)
                                                     <a href="{{ route('doctamag', ['item' => $el->id]) }}"
                                                         class="btn btn-info btn-sm">
                                                         <i class="fa fa-eye"></i>
                                                         Lire la suite
                                                     </a>
                                                 @endif
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             @endforeach
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-12 mt-4 d-flex justify-content-center">
                             {{ $magazines->appends(['mcat' => request('mcat')])->links() }}
                         </div>
                     </div>
                 @endif
             </div>
         </section>

         @guest
             <div class="modal fade" id="offline" tabindex="-1" role="dialog" aria-hidden="true" data-bs-backdrop="static">
                 <div class="modal-dialog modal-md" role="document">
                     <div class="modal-content ">
                         <div class="modal-body">
                             <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                                 <div class="d-flex justify-content-between">
                                     <h4>Veuillez vous connecter</h4>
                                     <img src="{{ asset('images/logo.png') }}" alt="" width="150px">
                                 </div>
                                 <div class="mt-4 mb-2">
                                     <h5>
                                         Connectez vous ou créez un compte pour accéder au téléchargement gratuit de <b>votre
                                             minute santé</b> et au <b>magazine Docta</b> pour <b
                                             style="font-size: 25px">1$</b>.
                                     </h5>
                                 </div>
                                 <button type="button" class="btn btn-outline-dark my-2" data-dismiss="modal">
                                     Fermer
                                 </button>
                                 <a href="{{ route('login', ['r' => url()->full()]) }}" class="btn btn-info  my-2">
                                     Connectez vous ou créez un compte
                                 </a>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
         @endguest
         <div class="modal fade" id="submdl" tabindex="-1" role="dialog" aria-hidden="true"
             data-bs-backdrop="static">
             <div class="modal-dialog modal-md" role="document">
                 <div class="modal-content ">
                     <div class="modal-body">
                         <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                             <div class="d-flex justify-content-between">
                                 <h4>Abonnement Docta Mag</h4>
                                 <i class="fa fa-lock text-success fa-2x"></i>
                             </div>
                             <hr>
                             <div class="mb-2">
                                 <div class="text-center">
                                     <b class="mr-2">Nous acceptons les paiements par </b>
                                 </div>
                                 <div class="d-flex justify-content-center">
                                     <a class="m-1">
                                         <img class="img-thumbnail shadow-lg"
                                             src="{{ asset('images/payment-method/airtel.png') }}" width="100px"
                                             height="50px" alt="" />
                                     </a>
                                     <a class="m-1">
                                         <img class="img-thumbnail shadow-lg"
                                             src="{{ asset('images/payment-method/vodacom.png') }}" width="100px"
                                             height="50px" alt="" />
                                     </a>
                                     <a class="m-1">
                                         <img class="img-thumbnail shadow-lg"
                                             src="{{ asset('images/payment-method/orange.png') }}" width="100px"
                                             height="50px" alt="" />
                                     </a>
                                     <a class="m-1">
                                         <img class="img-thumbnail shadow-lg"
                                             src="{{ asset('images/payment-method/afrimoney.png') }}" width="100px"
                                             height="50px" alt="" />
                                     </a>
                                 </div>
                             </div>
                             <form action="#" class="was-validated" id="f-pay2">
                                 <input type="hidden" name="magkey">
                                 <div class="form-group">
                                     <label for="">Télephone Mobile Money</label>
                                     <div class="input-group mb-3">
                                         <div class="input-group-prepend">
                                             <span class="input-group-text" id="basic-addon1">+243</span>
                                         </div>
                                         @php
                                             $tel = '';
                                         @endphp
                                         @auth
                                             @php
                                                 $phone = auth()->user()->phone;
                                                 $tel = substr($phone, -9);
                                             @endphp
                                         @endauth
                                         <input type="text" required pattern="[0-9.]+" class="form-control"
                                             value="{{ $tel }}" placeholder="Votre numéro Tel."
                                             name="telephone" maxlength="9">
                                     </div>
                                 </div>
                                 <div class="form-group mb-2">
                                     <label for="">Je paie en</label>
                                     <select name="devise" id="" class="form-control">
                                         <option>CDF</option>
                                         <option>USD</option>
                                     </select>
                                 </div>
                                 <div class="form-group">
                                     <h5>Montant de l'abonnement : <span montant
                                             class="text-danger font-weight-bold"></span> pour le mois de
                                         <span mois class="text-danger font-weight-bold"></span></label>
                                 </div>
                                 <div class="w-100 my-3">
                                     <p class="text-warning-emphasis font-weight-bold">
                                         <i class="fa fa-info-circle"></i> Avec cet abonnement, vous aurez accès au
                                         téléchargement de tous les magazines publiés au mois correspondant.
                                     </p>
                                 </div>
                                 <div class="mt-3 mb-3">
                                     <div id="rep"></div>
                                 </div>
                                 <button class="btn btn-outline-info" type="submit">
                                     <span></span>
                                     Valider
                                 </button>

                                 <button type="button" class="btn btn-light my-2" id="btncancel"
                                     style="display: none">Annuler
                                 </button>
                             </form>
                         </div>
                     </div>
                     <div class="modal-footer">
                         <button type="button" class="btn btn-outline-dark my-2" data-bs-dismiss="modal">
                             Fermer
                         </button>
                     </div>
                 </div>
             </div>
         </div>

     </main>
 @endsection

 @section('js')
     <script src="{{ asset('plugins/common/common.min.js') }}"></script>
     <script>
         $('[subscribe]').click(function() {
             var v = this.value;
             var lab = $(this).attr('label');
             $('span[mois]').html(lab);
             $('[name="magkey"]').val(v);
             $('#submdl').modal('show');
         });
         $('[dlmag]').click(function() {
             var v = this.value;
             var btn = $(this);
             var i = btn.find('i');
             i.removeClass().addClass('fa fa-spinner fa-spin');
             btn.attr('disabled', true);
             location.href = "{{ route('magdl', ['item' => '']) }}" + v;
             i.removeClass().addClass('fa fa-check-circle');
             setTimeout(() => {
                 i.removeClass().addClass('fa fa-download');
                 btn.attr('disabled', false);
             }, 3000);

         });

         setTimeout(() => {
             $('html,body').animate({
                 scrollTop: $('[magdiv]').offset().top - 100
             }, 1000);
         }, 1500);


         var sel = $('select[name=devise]');
         sel.change(function() {
             mt();
         });

         function mt() {
             var dev = sel.val();
             $.ajax({
                 data: {
                     devise: dev
                 },
                 url: '{{ route('subscribeval') }}',
                 beforeSend: function(xhr) {
                     xhr.setRequestHeader('Accept', 'application/json');
                     xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                     xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                 },
                 success: function(data) {
                     var v = data.val;
                     $('span[montant]').html(v);
                 },
                 error: function(data) {
                     setTimeout(() => {
                         mt();
                     }, 1000);
                 }
             })
         }
         mt();


         CANSHOW = true;
         var xhr = [];
         var interv = null;

         var callback = function() {
             var x =
                 $.ajax({
                     url: '{{ route('api.check.pay') }}',
                     data: {
                         myref: REF,
                     },
                     beforeSend: function(xhr) {
                         xhr.setRequestHeader('Accept', 'application/json');
                         xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                         xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                     },
                     success: function(res) {
                         var trans = res.transaction;
                         var status = trans?.status;
                         if (status === 'success') {
                             $('#btncancel').hide();
                             clearInterval(interv);
                             var form = $('#f-pay2');
                             var btn = $(':submit', form).attr('disabled', false);
                             btn.html('<span></span> Valider');
                             rep = $('#rep', form);
                             rep.html(
                                 `<b>TRANSACTION EFFECTUEE !</b><p>Vous pouvez maintenant télécharger vos magazines.</p>`
                             ).removeClass();
                             rep.addClass('alert alert-success');
                             rep.slideDown();
                             setTimeout(() => {
                                 location.reload();
                             }, 5000);

                         } else if (status === 'failed') {
                             clearInterval(interv);
                             $('#btncancel').hide();
                             var form = $('#f-pay2');
                             var btn = $(':submit', form).attr('disabled', false);
                             btn.html('<span></span> Valider');
                             var rep = $('#rep', form);
                             rep.html(
                                 `<b>TRANSACTION ECHOUEE !</b><p>Vous avez peut-être saisi un mauvais Pin. Merci de réessayer.</p>`
                             ).removeClass();
                             rep.addClass('alert alert-danger');
                             $(xhr).each(function(i, e) {
                                 e.abort();
                             });
                         }
                     }
                 });
             xhr.push(x);
         }
         $('#btncancel').click(function() {
             clearInterval(interv);
             $(this).hide();
             var form = $('#f-pay2');
             var btn = $(':submit', form).attr('disabled', false);
             btn.html('<span></span> Valider');
             var rep = $('#rep', form);
             rep.html("Paiement annulé.").removeClass();
             rep.addClass('alert alert-danger');
             $(xhr).each(function(i, e) {
                 e.abort();
             });
         });

         $('#f-pay2').submit(function() {
             event.preventDefault();
             var form = $(this);
             var btn = $(':submit', form);
             var rep = $('#rep', form);
             rep.html('').removeClass();
             var data = form.serialize();
             data = data.split('telephone=').join('telephone=+243');

             btn.attr('disabled', true).find('span').removeClass().addClass('spinner-border spinner-border-sm');
             $.ajax({
                 url: '{{ route('api.init.pay3') }}',
                 type: 'post',
                 data: data,
                 beforeSend: function(xhr) {
                     xhr.setRequestHeader('Accept', 'application/json');
                     xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                     xhr.setRequestHeader('Authorization', 'Bearer ' + localStorage.getItem('token'));
                 },
                 success: function(res) {
                     if (res.success) {
                         rep.html(res.message).removeClass();
                         rep.addClass('alert alert-success');
                         btn.html(
                             '<i class="spinner-border spinner-border-sm"></i> Confirmez votre Pin au téléphone...'
                         );
                         btn.attr('disabled', true);
                         clearInterval(interv);
                         REF = res.data.myref;
                         interv = setInterval(callback, 3000);
                         $('#btncancel').show();
                     } else {
                         rep.removeClass().addClass('text-danger').html(res.message);
                         btn.attr('disabled', false).find('span').removeClass();
                     }
                 }
             });
         });
     </script>
 @endsection
