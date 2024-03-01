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
                                <table class="table table-striped table-bordered zero-configuration">
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
                            aria-hidden="true">×</span>
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
                            <input type="text" class="form-control" name="phone" pattern= "[0-9]"
                                placeholder="Ex : 099xxxxxxx" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label" required>Mot de passe de connexion</label>
                            <input type="password" class="form-control" name="pass">
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
                var data = form.serialize();
                $(':input', form).attr('disabled', true);
                $.ajax({
                    type: 'post',
                    url: '',
                    success: function(data) {

                    },
                    error: function(data) {

                    }
                })
            })
        })
    </script>
@endsection
