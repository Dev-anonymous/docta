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
<x-chatboxdocta />

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
        })
    </script>
@endsection
