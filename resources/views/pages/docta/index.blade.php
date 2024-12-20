@extends('layouts.main')
@section('title', 'Dashboard')
@section('body')
    @php
        $user = auth()->user();
        $profil = $user->profils()->first();
    @endphp
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pb-0 pt-0">
                                    <div class="d-flex justify-content-center">
                                        <div class="mt-4">
                                            <img class='img-circle' style="object-fit: contain" src="{{ userimage($user) }}"
                                                width="150px" height="150px" alt="">
                                        </div>
                                    </div>
                                    @php
                                        if ($user->type == 'interne') {
                                            $status = '<span class="badge badge-success badge-pill">ACTIF</span>';
                                        } else {
                                            $status = $profil->actif
                                                ? '<span class="badge badge-success badge-pill">ACTIF</span>'
                                                : '<span class="badge badge-danger badge-pill">INACTIF</span>';
                                        }
                                        $do = '-';
                                        if ($profil->file) {
                                            $h = asset('storage/' . $profil->file);
                                            $do = "<a href='$h' target='_blank'><i class='fa fa-file'></i></a>";
                                        }
                                        $link = route('codedocta', $profil->code);

                                        $chat = $user->chats();
                                        $c = $chat->count();
                                        $ma = App\Models\Message::whereIn('chat_id', $chat->pluck('id')->all())
                                            ->where('fromuser', 1)
                                            ->count();
                                        $mr = App\Models\Message::whereIn('chat_id', $chat->pluck('id')->all())
                                            ->where('fromuser', 0)
                                            ->count();

                                    @endphp
                                    <b>Profil</b>
                                    <h4>{{ $user->name }}</h4>
                                    <h5>Tel : {{ $user->phone }}</h5>
                                    <h5>Email : {{ $user->email }}</h5>
                                    <h5>Code docteur : {{ $profil->code }}</h5>
                                    <h5>Lien docteur : <a href="{{ $link }}">{{ $link }}</a></h5>
                                    <h5>Catégorie : {{ $profil->categorie->categorie }}</h5>
                                    <h5>Type : {{ $user->type }}</h5>
                                    <h5>Bio : {{ $profil->bio ?? '-' }}</h5>
                                    <h5>Status compte : {!! $status !!}</h5>
                                    <h5>Dossier PDF : {!! $do !!}</h5>
                                    <hr>
                                    <b>Message</b>
                                    <h5>Clients assignés : {{ $c }}</h5>
                                    <h5>Message envoyé : {{ $ma }}</h5>
                                    <h5>Message recu : {{ $mr }}</h5>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-1">Statistique de messages</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div id="chart3"></div>
                                </div>
                                <div class="card-footer">
                                    <h4>Statistiques</h4>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Messages journalièrs :
                                        <span class="badge badge-success badge-pill font-weight-bold text-white"
                                            style="font-size: 13px" messagejournaliere></span>
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Messages d'hier :
                                        <span class="badge badge-danger badge-pill font-weight-bold" style="font-size: 13px"
                                            messagehier></span>
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Messages hebdomadaires :
                                        <span class="badge badge-info badge-pill font-weight-bold" style="font-size: 13px"
                                            messagehebdomadaire></span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div>
                                        <h4 class="mb-1">Statistique des appels</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div id="chart2"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script src="{{ asset('assets/js/jq.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Authorization': 'Bearer ' + localStorage.getItem('token'),
            'Accept': 'application/json',
        }
    });
</script>
@if (!$mustpay)
    <x-chatboxdocta />
@endif

@if ($mustpay)
    <div class="modal fade" id="mdlinfo" tabindex="-1" role="dialog" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Activation du profil</h5>
                </div>
                <div class="modal-body">
                    <div class="jumbotron">
                        <h2 class="text-danger">
                            <i class="fa fa-info-circle"></i>
                            Vous devez activer votre compte avant
                            de l'utiliser.
                        </h2>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default bok"><span></span> D'accord</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="mdlpay" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
        <div class="modal-dialog" role="document">
            <div class="modal-content ">
                <div class="modal-body">
                    <div class="p-3 rounded-5" style="background-color: rgba(0, 0, 0, 0.075)">
                        <div class="d-flex justify-content-between">
                            <h4>Paiement</h4>
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
                        @php
                            $tel = substr(auth()->user()->phone, -9);
                        @endphp
                        <form action="#" class="was-validated" id="f-pay">
                            <div class="form-group">
                                <label for="">Télephone Mobile Money</label>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">+243</span>
                                    </div>
                                    <input type="text" required pattern="[0-9.]+" value="{{ $tel }}"
                                        class="form-control" placeholder="Votre numéro Tel." name="telephone"
                                        maxlength="9">
                                </div>
                            </div>
                            <div class="form-group">
                                <h4>Montant de paiemnt : {{ v($montant, 'USD') }}</h4>
                            </div>
                            <div class="mt-3 mb-3">
                                <div id="rep"></div>
                            </div>
                            <button class="btn btn-outline-info" type="submit">
                                <span></span>
                                PAYER
                            </button>

                            <button type="button" class="btn btn-light my-2" id="btncancel"
                                style="display: none">Annuler
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


@section('js-code')
    <script src="{{ asset('js/apexchart.js') }}"></script>
    <script>
        $(function() {

            var options2 = {
                series: [{
                    name: "Appels",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                }],
                colors: ['#02BBFF'],
                chart: {
                    type: 'area',
                    height: 350,
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                labels: [
                    'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre',
                    'Octobre', 'Novembre',
                    'Decembre'
                ],

                legend: {
                    horizontalAlign: 'left'
                }
            };

            var chart2 = new ApexCharts(document.querySelector("#chart2"), options2);
            chart2.render();

            var options3 = {
                series: [{
                    name: "Message",
                    data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
                }],
                colors: ['#02BBFF'],
                chart: {
                    type: 'area',
                    height: 405,
                    zoom: {
                        enabled: false
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                labels: [
                    'Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre',
                    'Octobre', 'Novembre',
                    'Decembre'
                ],

                legend: {
                    horizontalAlign: 'left'
                }
            };

            var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
            chart3.render();

            function stat(interval = true) {
                $.ajax({
                    url: '{{ route('stat.index') }}',
                    type: 'POST',
                    crossDomain: true,
                    contentType: false,
                    processData: false,
                    success: function(r) {
                        $('[clients]').html(r.clients);
                        $('[clientactifs]').html(r.clientactifs);
                        $('[docta]').html(r.docta);

                        $('[visitejournaliere]').html(r.visitejournaliere);
                        $('[visitehier]').html(r.visitehier);
                        $('[visitehebdomadaire]').html(r.visitehebdomadaire);
                        $('[telechargementjournaliere]').html(r.telechargementjournaliere);
                        $('[telechargementhier]').html(r.telechargementhier);
                        $('[telechargementhebdomadaire]').html(r.telechargementhebdomadaire);
                        $('[messagejournaliere]').html(r.messagejournaliere);
                        $('[messagehier]').html(r.messagehier);
                        $('[messagehebdomadaire]').html(r.messagehebdomadaire);
                        chart3.updateSeries([{
                            data: r.messages,
                        }]);

                    },
                    error: function(e, b, c) {
                        console.log(e, b, c);
                    }
                }).always(function() {
                    if (!interval) {
                        return;
                    }
                    setTimeout(() => {
                        stat();
                    }, 3000);
                })
            }
            stat();

            @if ($mustpay)
                $('#mdlinfo').modal('show');
                $('.bok').click(function() {
                    $('.modal').modal('hide');
                    $('#mdlpay').modal('show');
                });


                CANSHOW = true;
                var xhr = [];
                var interv = null;

                var callback = function() {
                    var x =
                        $.ajax({
                            url: '{{ route('api.docta.paycheck') }}',
                            data: {
                                myref: REF,
                            },
                            success: function(res) {
                                var trans = res.transaction;
                                var status = trans?.status;
                                if (status === 'success') {
                                    $('#btncancel').hide();
                                    clearInterval(interv);
                                    var form = $('#f-pay');
                                    var btn = $(':submit', form).attr('disabled', false);
                                    btn.html('<span></span> PAYER');
                                    rep = $('#rep', form);
                                    rep.html(
                                        `<b>TRANSACTION EFFECTUEE !</b>`
                                    ).removeClass();
                                    rep.addClass('alert alert-success');
                                    rep.slideDown();
                                    setTimeout(() => {
                                        location.reload();
                                    }, 3000);

                                } else if (status === 'failed') {
                                    clearInterval(interv);
                                    $('#btncancel').hide();
                                    var form = $('#f-pay');
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
                    var form = $('#f-pay');
                    var btn = $(':submit', form).attr('disabled', false);
                    btn.html('<span></span> PAYER');
                    var rep = $('#rep', form);
                    rep.html("Paiement annulé.").removeClass();
                    rep.addClass('alert alert-danger');
                    $(xhr).each(function(i, e) {
                        e.abort();
                    });
                });

                $('#f-pay').submit(function() {
                    event.preventDefault();
                    var form = $(this);
                    var btn = $(':submit', form);
                    var rep = $('#rep', form);
                    rep.html('').removeClass();
                    var data = form.serialize();
                    data = data.split('telephone=').join('telephone=+243');

                    btn.attr('disabled', true).find('span').removeClass().addClass(
                        'fa fa-spin fa-spinner');
                    $.ajax({
                        url: '{{ route('api.docta.payinit') }}',
                        type: 'post',
                        data: data,
                        success: function(res) {
                            if (res.success) {
                                rep.html(res.message).removeClass();
                                rep.addClass('alert alert-success');
                                btn.html(
                                    '<i class="fa fa-spin fa-spinner"></i> Confirmez votre Pin au téléphone...'
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
            @endif
        })
    </script>
@endsection
