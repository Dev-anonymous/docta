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
                                <div class="card-body pb-0 d-flex justify-content-between">
                                    <div class="d-flex justify-content-between">
                                        <h4 class="mb-1">Statistique de téléchargements</h4>
                                        <div class="ml-2 d-flex justify-content-end">
                                            <div class="datetime"
                                                style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; border-radius: 10px;">
                                                <i class="fa fa-calendar"></i>&nbsp;
                                                <span></span> <i class="fa fa-caret-down"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chart0"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body pb-0 d-flex justify-content-between">
                                    <div>
                                        <h4 class="mb-1">Statistique de visites</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chart1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body pb-0 d-flex justify-content-between">
                                    <div>
                                        <h4 class="mb-1">Statistique des appels</h4>
                                    </div>
                                </div>
                                <div class="card-body">
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
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <script>
        $(function() {

            // $('.datetime').daterangepicker({
            //     startDate: moment().startOf('hour'),
            //     endDate: moment().startOf('hour').add(32, 'hour'),
            //     locale: {
            //         format: 'M/DD hh:mm A'
            //     }
            // });

            var start = moment().subtract(29, 'days');
            var end = moment();

            function cb(start, end) {
                $('.datetime span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
            }

            $('.datetime').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                }
            }, cb);

            cb(start, end);

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

            function stat() {
                $.ajax({
                    url: '{{ route('stat.index') }}',
                    success: function(r) {
                        $('[clients]').html(r.clients);
                        $('[clientactifs]').html(r.clientactifs);
                        $('[docta]').html(r.docta);

                        chart0.updateSeries([{
                            data: r.telechargement,
                        }]);
                        chart1.updateSeries([{
                            data: r.visites,
                        }])

                    }
                }).always(function() {
                    setTimeout(() => {
                        stat();
                    }, 3000);
                })
            }

            stat();
        })
    </script>
@endsection
