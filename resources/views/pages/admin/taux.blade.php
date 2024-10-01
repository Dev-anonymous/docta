@extends('layouts.main')
@section('title', 'Taux')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Taux</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Taux</h4>

                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Taux</th>
                                            <th>Date MAJ</th>
                                            {{-- <th style="width: 100px !important"></th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-nowrap">
                                            <td>
                                                1 CDF = {{ $data->cdf_usd }} USD <br>
                                                1 USD = {{ $data->usd_cdf }} CDF <br>
                                            </td>
                                            <td>
                                                {{ $data->date?->format('d-m-d H:i:s') }}
                                            </td>
                                            {{-- <td>
                                                <button data-toggle="modal" data-target="#editmdl"
                                                    class='bedit btn btn-default btn-sm m-1'>
                                                    <i class='fa fa-edit'></i>
                                                </button>
                                            </td> --}}
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
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Combien vaut 1 USD en CDF</label>
                            <input type="number" min="0.0001" step="0.000001" value="{{ $data->usd_cdf }}"
                                class="form-control" name="usd_cdf" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Combien vaut 1 CDF en USD</label>
                            <input type="number" min="0.0001" step="0.000001" value="{{ $data->cdf_usd }}"
                                class="form-control" name="cdf_usd" required>
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

            $('[name=usd_cdf]').keyup(function() {
                var val = this.value;
                val = Number(val);
                if (val) {
                    var v = 1 / val;
                    v = v.toFixed(6);
                    $('[name=cdf_usd]').val(v)
                }
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
                    url: '{{ route('taux.update', '') }}/' + id,
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
