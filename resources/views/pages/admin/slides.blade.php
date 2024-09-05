@extends('layouts.main')
@section('title', 'Slides')

@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Slides</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Slides (<span nb></span>)</h4>
                                <button class="btn btn-default" data-toggle="modal" data-target="#addmdl">Nouveau
                                    Slide</button>
                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th style="width: 10px"></th>
                                            <th>Titre</th>
                                            <th>Contenu</th>
                                            <th></th>
                                            <th style="width: 100px !important"></th>
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
                    <h5 class="modal-title">Nouveau slide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fadd">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Titre (100 caractères max)</label>
                            <input type="text" class="form-control" name="title" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contenu (450 caractères max)</label>
                            <textarea name="text" maxlength="450" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fichier (*) : .gif,.png,.jpg,.jpeg, 1.2Mo Max</label>
                            <input type="file" accept=".gif,.png,.jpg,.jpeg" class="form-control" name="file"
                                required>
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
                        <p>Confirmer la suppression du slide <i compte></i> ?</p>
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
                    <h5 class="modal-title">Mis à jour du slide</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fedit">
                    <input type="hidden" name="id">
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-form-label">Titre (100 caractères max)</label>
                            <input type="text" class="form-control" name="title" maxlength="100">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Contenu (450 caractères max)</label>
                            <textarea name="text" maxlength="450" class="form-control" cols="30" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fichier (optionnel) : .gif,.png,.jpg,.jpeg, 1.2Mo Max</label>
                            <input type="file" accept=".gif,.png,.jpg,.jpeg" class="form-control" name="file">
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
                var data = new FormData(form[0]);
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'post',
                    data: data,
                    contentType: false,
                    processData: false,
                    url: '{{ route('slide.store') }}',
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
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
                    url: '{{ route('slide.destroy', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
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
                    url: '{{ route('slide.update', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            getdata();
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

            function getdata() {
                $.getJSON('{{ route('slide.index') }}', function(data) {
                    var str = '';
                    $.each(data, function(i, e) {
                        if (e.isimage) {
                            var file =
                                `<img class="img-rounded" height="70px" width="100px" src="{{ asset('storage') }}/${e.file}"/>`;
                        } else {
                            var file = '';
                        }
                        str += `
                        <tr>
                            <td>${i+1}</td>
                            <td>${e.title??''}</td>
                            <td>${e.text??''}</td>
                            <td>
                                ${file}
                            </td>
                            <td>
                                <div class='d-flex'>
                                    <button data="${escape( JSON.stringify(e) )}" class='bdel btn btn-outline-danger btn-sm m-1'><i class='fa fa-trash'></i></button>
                                    <button data="${escape( JSON.stringify(e) )}" class='bedit btn btn-default btn-sm m-1'><i class='fa fa-edit'></i></button>
                                </div>
                            </td>
                        </tr>
                        `;
                    });
                    $('[nb]').html(data.length);
                    table.DataTable().destroy();
                    table.find('tbody').html(str);
                    $('.bdel').off('click').click(function() {
                        var d = $(this).attr('data');
                        var data = JSON.parse(unescape(d));
                        var mdl = $('#delmdl');
                        $('[name=id]', mdl).val(data.id);
                        mdl.modal('show');
                    })
                    $('.bedit').off('click').click(function() {
                        var d = $(this).attr('data');
                        var data = JSON.parse(unescape(d));
                        var mdl = $('#editmdl');
                        $('[name=id]', mdl).val(data.id);
                        $('[name=title]', mdl).val(data.title);
                        $('[name=text]', mdl).val(data.text);
                        mdl.modal('show');
                    })
                    table.DataTable();
                })
            }

            getdata();
        })
    </script>
@endsection
