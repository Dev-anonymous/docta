@extends('layouts.main')
@section('title', 'Docteurs')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Docteurs</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Docteurs (<span nb></span>)</h4>
                                <div class="">
                                    <a class="mb-2 btn btn-danger" href="{{ asset('docta-admin.apk') }}">
                                        <i class="fa fa-download"></i> App Mobile Docta Admin</a>
                                    <button class="mb-2 btn btn-default" data-toggle="modal" data-target="#addmdl">
                                        Nouveau Docteur</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th><span loader><i class="fa fa-spinner fa-spin"></i></span></th>
                                            <th>NOM</th>
                                            <th>EMAIL/TEL</th>
                                            <th>MESSAGE</th>
                                            <th>DERNIERE CONNEXION</th>
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

    <div class="modal fade" id="addmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau Docteur</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fadd">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Type</label>
                            <select name="type" id="" class="form-control">
                                <option value="interne">Interne</option>
                                <option value="externe">Externe</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Catégorie du docteur</label>
                            <select name="categorie_id" id="" class="form-control">
                                @foreach ($categories as $el)
                                    <option value="{{ $el->id }}">{{ ucfirst($el->categorie) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Dossier du médecin (optionnel) : .pdf 1.2Mo Max</label>
                            <input type="file" accept=".pdf" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nom</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Téléphone</label>
                            <input type="text" class="form-control" name="phone" maxlength="10" minlength="10"
                                placeholder="Ex : 099xxxxxxx" required>
                        </div>
                        <div class="form-group">
                            <label for="">Biographie</label>
                            <textarea class="form-control" name="bio" cols="30" rows="3" maxlength="255"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Image du médecin (optionnel) : png,jpg,jpeg 1.2Mo Max</label>
                            <input type="file" accept=".png,.jpg,.jpeg" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Mot de passe de connexion</label>
                            <input type="password" role="presentation" autocomplete="off" class="form-control" required
                                name="pass">
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default"><span></span> Valider</button>
                    </div>
                </form>

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
                        <p>Confirmer la suppression du compte de <i compte></i> ?</p>
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

    <div class="modal fade" id="editmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Modification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fedit">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Catégorie du docteur</label>
                            <select name="categorie_id" id="" class="form-control">
                                @foreach ($categories as $el)
                                    <option value="{{ $el->id }}">{{ ucfirst($el->categorie) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Dossier du médecin (optionnel) : .pdf 1.2Mo Max</label>
                            <input type="file" accept=".pdf" class="form-control" name="file">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Nom</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Téléphone</label>
                            <input type="text" class="form-control" name="phone" maxlength="10" minlength="10"
                                placeholder="Ex : 099xxxxxxx" required>
                        </div>
                        <div class="form-group">
                            <label for="">Biographie</label>
                            <textarea class="form-control" name="bio" cols="30" rows="3" maxlength="255"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Image du médecin (optionnel) : png,jpg,jpeg 1.2Mo Max</label>
                            <input type="file" accept=".png,.jpg,.jpeg" class="form-control" name="image">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Mot de passe de
                                connexion(optionnel)</label>
                            <input type="password" role="presentation" autocomplete="off" class="form-control"
                                name="pass">
                        </div>
                        <div class="form-group">
                            <div id="rep"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-default"><span></span> Valider</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="detmdl" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Détails du compte</h5>
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
            $('#fadd').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = new FormData(form[0]);
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'post',
                    data: data,
                    contentType: false,
                    processData: false,
                    url: '{{ route('doctas.store') }}',
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdocta();
                            setTimeout(() => {
                                $('.modal').modal('hide');
                            }, 2000);
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
                    url: '{{ route('doctas.destroy', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdocta();
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

            $('#fedit').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = new FormData(form[0]);
                var id = $('[name=id]', form).val();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'post',
                    data: data,
                    contentType: false,
                    processData: false,
                    url: '{{ route('doctas.update', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdocta();
                            setTimeout(() => {
                                $('.modal').modal('hide');
                            }, 2000);
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

            function getdocta(interval = false) {
                $("[loader]").html('<i class="fa fa-spinner fa-spin"></i>');
                $.getJSON('{{ route('doctas.index') }}', function(data) {
                    var str = '';
                    $.each(data, function(i, e) {
                        str += `
                        <tr>
                            <td style="width: 10px">${i+1}</td>
                            <td style='cursor:pointer' details id=${e.id}>
                                <div class="">
                                    <img class='img-circle' style="object-fit: contain" src="${e.image}" width="80px"
                                        height="80px" alt="">
                                </div>
                                ${e.name}
                            </td>
                            <td style='cursor:pointer' details id=${e.id}>${e.email}<br>${e.phone}</td>
                            <td class='text-nowrap' style='cursor:pointer' details id=${e.id}>
                                <b>Chats : <span class='badge badge-dark badge-pill'>${e.conversation}</span></b></br>
                                <b>Messages envoyés : <span class='badge badge-dark badge-pill'>${e.messageenvoye}</span></b></br>
                                <b>Messages recus : <span class='badge badge-dark badge-pill'>${e.messagerecu}</span></b></br>
                                <b>Solde : <span class='badge badge-danger badge-pill' style='font-size:15px'>${e.solde}</span></b>
                            </td>
                            <td style='cursor:pointer' details id=${e.id} >${e.derniere_connexion} ${e.actif}</td>
                            <td>
                                <div class='d-flex'>
                                    <button user="${escape(e.name)}" value='${e.id}' class='bdel btn btn-outline-danger btn-sm m-1'><i class='fa fa-trash'></i></button>
                                    <button user="${escape( JSON.stringify(e) )}" class='bedit btn btn-default btn-sm m-1'><i class='fa fa-edit'></i></button>
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
                        $('[compte]', mdl).html(unescape(cmpt));
                        mdl.modal('show');
                    })
                    $('.bedit').off('click').click(function() {
                        var d = $(this).attr('user');
                        var cmpt = JSON.parse(unescape(d));
                        var mdl = $('#editmdl');
                        $('[name=id]', mdl).val(cmpt.id);
                        $('[name=bio]', mdl).val(cmpt.bio);
                        $('[name=categorie_id]', mdl).val(cmpt.categorie_id);
                        $('[name=name]', mdl).val(cmpt.name);
                        $('[name=email]', mdl).val(cmpt.email);
                        $('[name=phone]', mdl).val(cmpt.phone);
                        mdl.modal('show');
                    });
                    $('[details]').off('click').click(function() {
                        var id = $(this).attr('id');
                        var mdl = $('#detmdl');

                        $('.data', mdl).html(
                            '<div class="w-100 text-center"><i class="fa fa-spin fa-spinner fa-5x"></i></div>'
                        );

                        $.ajax({
                            url: '{{ route('doctas.show', '') }}/' + id,
                            success: function(rep) {
                                var trans = rep.transfert;
                                var pro = rep.profil;
                                var mess = rep.message;
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
                                <h5>Code docteur : ${pro.code}</h5>
                                <h5>Lien docteur : {{ route('codedocta', '') }}/${pro.code}</h5>
                                <h5>Solde : <span class="badge badge-info">${pro.solde}</span></h5>
                                <h5>Catégorie : ${pro.categorie}</h5>
                                <h5>Type : ${pro.type}</h5>
                                <h5>Bio : ${pro.bio}</h5>
                                <h5>Status compte : ${pro.status}</h5>
                                <h5>Dossier PDF : ${pro.dossier}</h5>
                                <hr>
                                <b>Message</b>
                                <h5>Clients assignés : ${mess.client}</h5>
                                <h5>Message envoyé : ${mess.messageenvoye}</h5>
                                <h5>Message re&ccirc;u : ${mess.messagerecu}</h5>
                                <hr>
                                <b class="pb-5">Historique de transferts</b>
                                <div style="max-height:500px; overflow:auto;">
                                `;

                                var p = '';
                                trans.forEach(element => {
                                    p += `
                                        <div class="card m-0 mb-2" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                                            <div class="card-body p-2 d-flex">
                                                <div class="">
                                                    <img style="object-fit: contain" src="{{ asset('images/mmoney.png') }}" width="50px"
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
                    });


                    $("[data-toggle='tooltip']").tooltip('dispose');
                    $("[data-toggle='tooltip']").off('tooltip').tooltip();
                    table.DataTable({
                        stateSave: true
                    });
                }).always(function() {
                    $("[loader]").html('');
                    if (interval) {
                        setTimeout(() => {
                            getdocta(true);
                        }, 3000);
                    }
                })
            }
            getdocta(true);
        })
    </script>
@endsection
