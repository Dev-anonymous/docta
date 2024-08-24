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
                                <h4 class="card-title">Clients (<span clients></span>)</h4>
                                <h4 class="card-title">Total Solde : <span style="font-size: 18px" class="badge badge-dark"
                                        solde></span></h4>
                            </div>
                            <div class="table-responsive">
                                <table tclient class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px"><span loader><i class="fa fa-spinner fa-spin"></i></span></th>
                                            <th>UID / DEVICE ID</th>
                                            <th>SOLDE</th>
                                            <th>EMAIL/TEL</th>
                                            <th>NOM</th>
                                            <th>DERNIERE CONNEXION</th>
                                            <th>DATE CREATION</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
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
            function getdata() {
                $("[loader]").html('<i class="fa fa-spinner fa-spin"></i>');
                $.getJSON('{{ route('clients.index') }}', function(d) {
                    var str = '';
                    var data = d.data;
                    $.each(data.clients, function(i, e) {
                        str += `
                        <tr>
                            <td>${i+1}</td>
                            <td>
                                 ${e.uid} <br> ${e.deviceid}
                            </td>
                            <td>
                                 <span class="badge bg-${e.solde_classe} text-white font-weight-bold" style="font-size:18px">${e.solde}</span>
                            </td>
                            <td>
                                 ${e.telephone} <br> ${e.email}
                            </td>
                            <td>
                                 ${e.nom}
                            </td>
                            <td>
                                 ${e.last_login??''} ${e.actif}
                            </td>
                            <td>
                                 ${e.date}
                            </td>
                        </tr>
                        `;
                    });
                    var table = $('[tclient]');
                    $('[clients]').html(data.clients.length);
                    $('[solde]').html(data.solde);
                    table.DataTable().destroy();
                    table.find('tbody').html(str);
                    table.DataTable({
                        stateSave: true
                    });
                }).always(function() {
                    $("[loader]").html('');
                    setTimeout(() => {
                        getdata();
                    }, 3000);
                })
            }

            getdata();
        })
    </script>
@endsection
