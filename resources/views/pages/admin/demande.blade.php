@extends('layouts.main')
@section('title', "Demande d'adhésion")
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Demande d'adhésion</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Demande d'adhésion (<span nb></span>)</h4>

                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th><span loader><i class="fa fa-spinner fa-spin"></i></span></th>
                                            <th></th>
                                            <th>STATUS</th>
                                            <th>CATEGORIE</th>
                                            <th>NOM</th>
                                            <th>EMAIL/TEL</th>
                                            <th>DATE</th>
                                            <th></th>
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

    <div class="modal fade" id="delmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Suppression</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fdel">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>Confirmer la suppression ?</p>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">NON</button>
                        <button type="submit" class="btn btn-default"><span></span> OUI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="mdlconf" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Validation du profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fconf">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <p>Confirmer la validation du profil</p>
                        <div class="form-group">
                            <label for="">Mot de passe de connexion</label>
                            <input name="pass" required class="form-control">
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">NON</button>
                        <button type="submit" class="btn btn-default"><span></span> OUI</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Détails</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fadd">
                    <div class="modal-body">
                        <div class="jumbotron p-3 data m-0">

                        </div>
                        <button type="button" class="bconf btn btn-danger mt-3">Valider ce profil</button>
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

            $('#fdel').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = form.serialize();
                var id = $('[name=id]', form).val();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'delete',
                    data: data,
                    url: '{{ route('demandeadhesion.destroy', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
                            setTimeout(() => {
                                $('.modal').modal('hide');
                            }, 10000);
                        } else {
                            rep.removeClass().addClass('alert alert-danger');
                        }
                        rep.html(data.message).slideDown();
                    },
                    error: function(data) {
                        rep.removeClass().addClass('alert alert-danger').html(
                            "Erreur, veuillez réessayer.").slideDown();
                    }
                }).always(function() {
                    btn.find('span').removeClass();
                    $(':input', form).attr('disabled', false);
                })
            });

            $('#fconf').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = form.serialize();
                var id = $('[name=id]', form).val();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'put',
                    data: data,
                    url: '{{ route('demandeadhesion.update', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
                            setTimeout(() => {
                                $('.modal').modal('hide');
                            }, 5000);
                        } else {
                            rep.removeClass().addClass('alert alert-danger');
                        }
                        rep.html(data.message).slideDown();
                    },
                    error: function(data) {
                        rep.removeClass().addClass('alert alert-danger').html(
                            "Erreur, veuillez réessayer.").slideDown();
                    }
                }).always(function() {
                    btn.find('span').removeClass();
                    $(':input', form).attr('disabled', false);
                })
            });

            var table = $('[table]');

            function getdata(interval = false) {
                $("[loader]").html('<i class="fa fa-spinner fa-spin"></i>');
                $.getJSON('{{ route('demandeadhesion.index') }}', function(data) {
                    var str = '';
                    $.each(data, function(i, e) {
                        var bdel = '';
                        var status =
                            '<span class="badge badge-danger"> <i class="fa fa-times-circle"></i> EN ATTENTE</span>';
                        if (e.valide == 1) {
                            status =
                                '<span class="badge badge-success"> <i class="fa fa-check-circle"></i> VALIDE</span>';
                        } else {
                            bdel =
                                `<button user="${escape(e.name)}" value='${e.id}' class='bdel btn btn-outline-danger btn-sm m-1'><i class='fa fa-trash'></i></button>`;
                        }

                        str += `
                        <tr>
                            <td style="width: 10px">${i+1}</td>
                            <td style='cursor:pointer' details user="${escape( JSON.stringify(e) )}" id=${e.id}>
                                <div class="">
                                    <img class='img-circle' style="object-fit: contain" src="${e.data.image}" width="80px"
                                        height="80px" alt="">
                                </div>
                            </td>
                            <td style='cursor:pointer' details user="${escape( JSON.stringify(e) )}" id=${e.id}>${status}</td>
                            <td style='cursor:pointer' details user="${escape( JSON.stringify(e) )}" id=${e.id}>${e.categorie}</td>
                            <td style='cursor:pointer' details user="${escape( JSON.stringify(e) )}" id=${e.id}>${e.data.name}</td>
                            <td style='cursor:pointer' details user="${escape( JSON.stringify(e) )}" id=${e.id}>${e.data.email}<br>${e.data.phone}</td>
                            <td style='cursor:pointer' details user="${escape( JSON.stringify(e) )}" id=${e.id} >${e.date}</td>
                            <td>
                                <div class='d-flex'>
                                    ${bdel}
                                </div>
                            </td>
                        </tr>
                        `;
                    });
                    $('[nb]').html(data.length);
                    table.DataTable().destroy();
                    table.find('tbody').html(str);
                    $('.bdel').off('click').click(function() {
                        var id = this.value;
                        var cmpt = $(this).attr('user');
                        var mdl = $('#delmdl');
                        $('[name=id]', mdl).val(id);
                        mdl.modal('show');
                    })

                    $('[details]').off('click').click(function() {
                        var id = $(this).attr('id');
                        var d = $(this).attr('user');
                        var mdl = $('#detmdl');
                        var dem = JSON.parse(unescape(d));
                        var pro = dem.data;

                        var status =
                            '<span class="badge badge-danger"> <i class="fa fa-times-circle"></i> EN ATTENTE</span>';
                        if (dem.valide == 1) {
                            status =
                                '<span class="badge badge-success"> <i class="fa fa-check-circle"></i> VALIDE</span>';
                        }

                        var fcarte = '';
                        var ffile = '';
                        $(pro.carteidentite).each(function(e, r) {
                            var h = '{{ asset('storage') }}/' + r;
                            fcarte +=
                                `<p class="m-0"><a href="${h}" target="_blank">Fichier ${e+1}</a></p> `;
                        });
                        $(pro.files).each(function(e, r) {
                            var h = '{{ asset('storage') }}/' + r;
                            ffile +=
                                `<p class="m-0"><a href="${h}" target="_blank">Fichier ${e+1}</a></p> `;
                        })

                        var html = `
                                <div class="d-flex justify-content-center">
                                    <div class="">
                                        <img class='img-circle' style="object-fit: contain" src="${pro.image}" width="150px"
                                            height="150px" alt="">
                                    </div>
                                </div>
                                <b>Profil</b>
                                <h4>${pro.name}</h4>
                                <h5>Tel : ${pro.phone}</h5>
                                <h5>Email : ${pro.email}</h5>
                                <h5>Catégorie : ${dem.categorie}</h5>
                                <h5>Langues : ${pro.langues.join(', ')}</h5>
                                <h5>Date de naissance : ${pro.datenaissance} (${pro.age})</h5>
                                <h5>Adresse : ${pro.adresse}</h5>
                                <h5>Status profil : ${status}</h5>
                                <hr>
                                <b>Questions</b>
                                <p class='m-0'>Disposez vous d'un permis de travail en RDC ?</p>
                                <b class="text-danger mb-2">${pro.permistravail}</b>
                                <p class='m-0'>Travaillez vous ?</p>
                                <b class="text-danger mb-2">${pro.travail}</b>
                                <p class='m-0'>Etes-vous disposé à être disponible lorsqu'on a besoin de vous 24/24h par une personne ayant besoin de vos services ? </p>
                                <b class="text-danger mb-2">${pro.disponibilite}</b>
                                <p class='m-0'>Avez vous déjà travaillé en ligne avant ? </p>
                                <b class="text-danger mb-2">${pro.travailenligne}</b>
                                <p class='m-0'>Quelles sont vos plus grandes forces? Enumerez-en 5 dans l'ordre.</p>
                                <b class="text-danger mb-2">${pro.forces}</b>
                                <p class='m-0'>Où avez-vous entendu parler de nous ?</p>
                                <b class="text-danger mb-2">${pro.source}</b>
                                <hr>
                                <b>Carte d'identité (Passeport, Carte d'identité nationale ou carte d'électeur)</b>
                                ${fcarte}
                                <b>CV, diplôme de médecine et autres</b>
                                ${ffile}
                                `;
                        $('.data', mdl).html(html);
                        $('[name=id]', $('#fconf')).val(dem.id);
                        dem.valide == 1 ? $('.bconf').hide() : $('.bconf').show();
                        mdl.modal('show');
                    });

                    table.DataTable({
                        stateSave: true
                    });
                }).always(function() {
                    $("[loader]").html('');
                })
            }
            getdata();

            $('.bconf').click(function() {
                $('.modal').modal('hide');
                $('#mdlconf').modal('show');
            })
        })
    </script>
@endsection
