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
                                            <th style="width: 10px"><span loader><i
                                                        class="fa fa-spinner fa-spin"></i></span></th>
                                            <th>UID / DEVICE ID</th>
                                            <th>SOLDE</th>
                                            <th>NOM/TEL/EMAIL</th>
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

    </div>
    <div class="modal fade" id="addmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Détails du client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fadd">
                    <div class="modal-body">
                        <div class="jumbotron p-3 data">

                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
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
                                 <span historique id='${e.id}' style="cursor:pointer; font-size:20px" class="badge bg-${e.solde_classe} text-white font-weight-bold">${e.solde}</span>
                            </td>
                            <td>
                                ${e.nom} </br> ${e.telephone} <br> ${e.email}
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
                    $('[historique]').off('click').click(function() {
                        var id = $(this).attr('id');
                        var mdl = $('#addmdl');
                        $('.data', mdl).html(
                            '<div class="w-100 text-center"><i class="fa fa-spin fa-spinner fa-5x"></i></div>'
                        );

                        $.ajax({
                            url: '{{ route('clients.show', '') }}/' + id,
                            success: function(rep) {
                                var pai = rep.paiement;
                                var pro = rep.profil;
                                var mess = rep.message;
                                var html = `
                                <b>Profil</b>
                                <h4>${pro.client}</h4>
                                <h5>Tel : ${pro.tel}</h5>
                                <h5>Email : ${pro.email}</h5>
                                <h5>Solde : <span class="badge badge-info">${pro.solde}</span></h5>
                                <h5>Device ID : ${pro.deviceid}</h5>
                                <h5>Uid: ${pro.uid}</h5>
                                <h5>Status : ${pro.status}</h5>
                                <hr>
                                <b>Message</b>
                                <h5>Docteur assigné : ${mess.docta}</h5>
                                <h5>Message envoyé : ${mess.messageenvoye}</h5>
                                <h5>Message re&ccirc;u : ${mess.messagerecu}</h5>
                                <hr>
                                <b class="pb-5">Historique de paiement</b>
                                <div style="max-height:500px; overflow:auto;">
                                `;

                                var p = '';
                                pai.forEach(element => {
                                    p += `
                                        <div class="card m-0 mb-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                            <div class="card-body p-2 d-flex">
                                                <div class="">
                                                    <img style="object-fit: contain" src="${element.image}" width="50px"
                                                        height="50px" alt="">
                                                </div>
                                                <div class="pl-2" style="line-height: 15px">
                                                    <b>${element.montant}<br>
                                                        ${element.ref} <br>
                                                        ${element.date} </b>
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                });
                                html += p;
                                html += '</div>';

                                $('.data', mdl).html(html);
                            },
                            error: function(rep) {
                                $('.data', mdl).html(
                                    '<div class="w-100 text-center text-danger">Erreur de chargement, veuillez réessayer.</div>'
                                );
                            }
                        })

                        mdl.modal('show');
                        console.log(id);
                    });
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
