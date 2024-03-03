@extends('layouts.main')
@section('title', 'Clients')
@section('body')
    <div class="content-body">

        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Clients</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Clients ({{ count($app) }})</h4>
                                <h4 class="card-title">Total Solde appel : <span
                                        class="badge badge-dark">{{ "$ $solde" }}</span></h4>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>UID</th>
                                            <th>SOLDE D'APPEL</th>
                                            <th>EMAIL/TEL</th>
                                            <th>NOM</th>
                                            <th>DERNIERE CONNEXION</th>
                                            <th>DATE CREATION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($app as $el)
                                            @php
                                                $actif = '';
                                                if ($el->last_login) {
                                                    $n = now()->diffInDays($el->last_login );
                                                    if($n <= 7){
                                                        $actif = '<b style="cursor:pointer" title="Utilisateur actif" data-toggle="tooltip" class="badge badge-success"> <i class="fa fa-check-circle"></i> ACTIF</b>';
                                                    }
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{ $el->uid }}</td>
                                                <td>
                                                    <span class="badge badge-danger font-weight-bold"
                                                        style="min-width: 120px">
                                                        {{ "$ " . number_format($el->soldes()->first()->solde_usd, 2, '.', ' ') }}
                                                    </span>
                                                </td>
                                                <td>{!! "$el->email<br>$el->telephone" !!}</td>
                                                <td>{{ $el->nom ?? '-' }}</td>
                                                <td>{{ $el->last_login?->format('d-m-Y H:i:s') }} {!! $actif !!}</td>
                                                <td>{{ $el->date?->format('d-m-Y H:i:s') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #/ container -->
    </div>
@endsection
@section('js-code')
    <link href="{{ asset('plugins/tables/css/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <script src="{{ asset('plugins/tables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/tables/js/datatable-init/datatable-basic.min.js') }}"></script>
    <script>
        $(function() {

        })
    </script>
@endsection
