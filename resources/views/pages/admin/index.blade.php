@extends('layouts.main')
@section('title', 'Dashboard')
@section('body')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('admin.client') }}">
                        <div class="card gradient-2">
                            <div class="card-body">
                                <h3 class="card-title text-white">Clients</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white" clients></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('admin.client') }}">
                        <div class="card gradient-3">
                            <div class="card-body">
                                <h3 class="card-title text-white">Clients Actifs</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white" clientactifs></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-users"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <a href="{{ route('admin.docteur') }}">
                        <div class="card gradient-1">
                            <div class="card-body">
                                <h3 class="card-title text-white">Docta</h3>
                                <div class="d-inline-block">
                                    <h2 class="text-white" docta></h2>
                                </div>
                                <span class="float-right display-5 opacity-5"><i class="fa fa-user-md"></i></span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="card gradient-4">
                        <div class="card-body">
                            <h3 class="card-title text-white">Appels</h3>
                            <div class="d-inline-block">
                                <h2 class="text-white">-</h2>
                            </div>
                            <span class="float-right display-5 opacity-5"><i class="fa fa-phone"></i></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-1">Statistique de téléchargements</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div id="chart0"></div>
                                </div>
                                <div class="card-footer">
                                    <h4>Statistiques</h4>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Téléchargements journalièrs :
                                        <span class="badge badge-success badge-pill font-weight-bold text-white"
                                            style="font-size: 13px" telechargementjournaliere></span>
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Téléchargements d'hier :
                                        <span class="badge badge-danger badge-pill font-weight-bold" style="font-size: 13px"
                                            telechargementhier></span>
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Téléchargements hebdomadaires :
                                        <span class="badge badge-info badge-pill font-weight-bold" style="font-size: 13px"
                                            telechargementhebdomadaire></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-1">Statistique de visites</h4>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div id="chart1"></div>
                                </div>
                                <div class="card-footer">
                                    <h4>Statistiques</h4>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Visites journalières :
                                        <span class="badge badge-success badge-pill font-weight-bold text-white"
                                            style="font-size: 13px" visitejournaliere></span>
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Visites d'hier :
                                        <span class="badge badge-danger badge-pill font-weight-bold" style="font-size: 13px"
                                            visitehier></span>
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Visites hebdomadaires :
                                        <span class="badge badge-info badge-pill font-weight-bold" style="font-size: 13px"
                                            visitehebdomadaire></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body pb-0">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-1">Statistique de messages <span doctaname></span></h4>
                                        <select name="docta" id="" class="form-control" style="width: 200px">
                                            <option value="">Tous</option>
                                            @foreach ($docta as $el)
                                                <option value="{{ $el->id }}">{{ ucwords($el->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="card-body pb-0 pt-0">
                                    <div id="chart3"></div>
                                </div>
                                <div class="card-footer">
                                    <h4>Statistiques <span doctaname></span></h4>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Messages journalièrs :
                                        <span class="badge badge-success badge-pill font-weight-bold text-white"
                                            style="font-size: 13px" messagejournaliere></span>
                                    </p>
                                    <p class="font-weight-bold m-0">
                                        <i class="fa fa-check-circle"></i> Messages d'hier :
                                        <span class="badge badge-danger badge-pill font-weight-bold"
                                            style="font-size: 13px" messagehier></span>
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
@section('js-code')
    <script src="{{ asset('js/apexchart.js') }}"></script>
    <script>
        $(function() {
            var options0 = {
                series: [{
                    name: "Téléchargements",
                    data: [],
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

            var chart0 = new ApexCharts(document.querySelector("#chart0"), options0);
            chart0.render();

            var options1 = {
                series: [{
                    name: "Visites",
                    data: [],
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

            var chart1 = new ApexCharts(document.querySelector("#chart1"), options1);
            chart1.render();

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

            var chart3 = new ApexCharts(document.querySelector("#chart3"), options3);
            chart3.render();

            $('[name=docta]').change(function() {
                stat(false);
            })

            function stat(interval = true) {
                $.ajax({
                    url: '{{ route('stat.index') }}',
                    data: {
                        'docta_id': $('[name=docta]').val(),
                    },
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
                        var doctaname = r.doctaname;
                        if (doctaname.length == 0) {
                            $('[doctaname]').html('');
                        } else {
                            $('[doctaname]').html('du Docteur ' + doctaname);
                        }

                        chart0.updateSeries([{
                            data: r.telechargement,
                        }]);
                        chart1.updateSeries([{
                            data: r.visites,
                        }]);
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
