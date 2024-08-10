@extends('layouts.main')
@section('title', 'App version')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">App version</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">App version</h4>

                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Type</th>
                                            <th>Version</th>
                                            <th>OBLIGATOIRE</th>
                                            <th>Note de version</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-nowrap">
                                            <td>
                                                ADMIN
                                            </td>
                                            <td>
                                                {{ @$data->versionadmin }}
                                            </td>
                                            <td>
                                                {!! @$data->requiredadmin == 0
                                                    ? "<span class='badge badge-dark'>NON</span>"
                                                    : "<span class='badge badge-danger'>OUI</span>" !!}
                                            </td>
                                            <td>
                                                {{ @$data->noteadmin }}
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#editmdl"
                                                    class='bedit btn btn-default btn-sm m-1'>
                                                    <i class='fa fa-edit'></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr class="text-nowrap">
                                            <td>
                                                CLIENT
                                            </td>
                                            <td>
                                                {{ @$data->versionclient }}
                                            </td>
                                            <td>
                                                {!! @$data->requiredclient == 0
                                                    ? "<span class='badge badge-dark'>NON</span>"
                                                    : "<span class='badge badge-danger'>OUI</span>" !!}

                                            </td>
                                            <td>
                                                {{ @$data->noteclient }}
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#editmdl"
                                                    class='bedit btn btn-default btn-sm m-1'>
                                                    <i class='fa fa-edit'></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                    <div class="modal-body">
                        <h3>Docta ADMIN</h3>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Version</label>
                            <input value="{{ @$data->versionadmin }}" class="form-control" name="versionadmin" required>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requiredadmin"
                                    @if (@$data->requiredadmin == 1) checked @endif id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Forcer le téléchargement
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Note de version</label>
                            <textarea name="noteadmin" id="" rows="3" class="form-control">{!! @$data->noteadmin !!}</textarea>
                        </div>

                        <h3>Docta CLIENT</h3>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Version</label>
                            <input value="{{ @$data->versionclient }}" class="form-control" name="versionclient" required>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requiredclient"
                                    @if (@$data->requiredclient == 1) checked @endif id="flexCheckDefault2">
                                <label class="form-check-label" for="flexCheckDefault2">
                                    Forcer le téléchargement
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Note de version</label>
                            <textarea name="noteclient" id="" rows="3" class="form-control">{!! @$data->noteclient !!}</textarea>
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

    <script>
        $(function() {

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
                    type: 'post',
                    data: data,
                    url: '{{ route('appversion.update', '') }}',
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            setTimeout(() => {
                                location.reload();
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

        })
    </script>
@endsection
