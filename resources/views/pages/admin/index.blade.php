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
                                    <h2 class="text-white">{{ $client }}</h2>
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
                                    <h2 class="text-white">{{ $clientactif }}</h2>
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
                                    <h2 class="text-white">{{ $docta }}</h2>
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
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body pb-0 d-flex justify-content-between">
                                    <div>
                                        <h4 class="mb-1">Statistique des appels</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div id="chart1"></div>
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
            var options = {
                series: [{
                    name: "Appels traités",
                    data: [350, 200, 100, 10, 10, 30, 500, 200, 100, 40, 210, 300],
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

            var chart = new ApexCharts(document.querySelector("#chart1"), options);
            chart.render();
        })
    </script>
@endsection
