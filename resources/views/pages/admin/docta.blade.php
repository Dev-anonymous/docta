@extends('layouts.main')
@section('title', 'Docta')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Docta</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Docta (<span nb></span>)</h4>
                                <button class="btn btn-default" data-toggle="modal" data-target="#addmdl">Nouveau
                                    Docta</button>
                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>NOM</th>
                                            <th>EMAIL/TEL</th>
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
                    <h5 class="modal-title">Nouveau docta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fadd">
                    <div class="modal-body">
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
                            <input type="text" class="form-control" name="phone" maxlength="10" minlength="10" "[0-9]"
                                placeholder="Ex : 099xxxxxxx" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Mot de passe de connexion</label>
                            <input type="password" class="form-control" required name="pass">
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
                    <h5 class="modal-title">Edit docta</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fedit">
                    <input type="hidden" name="id">
                    <div class="modal-body">
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
                            <input type="text" class="form-control" name="phone" maxlength="10"
                                minlength="10" "[0-9]" placeholder="Ex : 099xxxxxxx" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Mot de passe de connexion(optionnel)</label>
                            <input type="password" class="form-control" name="pass">
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
                var data = form.serialize();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'post',
                    data: data,
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
                            }, 2000);
                        } else {
                            rep.removeClass().addClass('alert alert-danger');
                        }
                        rep.html(data.message).slideDown();
                    },
                    error: function(data) {
                        console.log(rep);
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
                var data = form.serialize();
                var id = $('[name=id]', form).val();
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'put',
                    data: data,
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

            function getdocta() {
                $.getJSON('{{ route('doctas.index') }}', function(data) {
                    var str = '';
                    $.each(data, function(i, e) {
                        str += `
                        <tr>
                            <td>${e.name}</td>
                            <td>${e.email}<br>${e.phone}</td>
                            <td>${e.derniere_connexion}</td>
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
                        $('[name=name]', mdl).val(cmpt.name);
                        $('[name=email]', mdl).val(cmpt.email);
                        $('[name=phone]', mdl).val(cmpt.phone);
                        mdl.modal('show');
                    })
                    table.DataTable();
                })
            }

            getdocta();
        })
    </script>
@endsection
