@extends('layouts.main')
@section('title', 'Facturation')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Facturation</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Facturation</h4>

                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed zero-configuration">
                                    <thead>
                                        <tr>
                                            <th>Facturation</th>
                                            <th style="width: 100px !important"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="text-nowrap">
                                            <td>
                                                Appel : {{ $data->appel }} USD/Sec <br>
                                                SMS : {{ $data->sms }} USD/SMS <br>
                                                Compte docteur : {{ $data->compte }} USD pour 6 mois <br>
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
                <form id="fedit" class="was-validated">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Appel : Prix par sec</label>
                            <input type="number" min="0" step="0.001" value="{{ $data->appel }}"
                                class="form-control" name="appel" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">SMS : Prix par message</label>
                            <input type="number" min="0" step="0.001" value="{{ $data->sms }}"
                                class="form-control" name="sms" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Compte docteur</label>
                            <input type="number" min="0" step="0.001" value="{{ $data->compte }}"
                                class="form-control" name="compte" required>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="sendpush" checked
                                    id="flexCheckDefault233">
                                <label class="form-check-label text-dark" for="flexCheckDefault233">
                                    Envoyer une push notification aux clients
                                </label>
                            </div>
                        </div>
                        <div class="pushdiv">
                            <h3>Push notification</h3>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Titre</label>
                                <input class="form-control" value="Nouvelle tarification Docta" name="pushtitle">
                            </div>
                            <div class="form-group">
                                <label for="">Message</label>
                                <textarea name="pushmessage" id="" rows="10" class="form-control"></textarea>
                            </div>
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
                    url: '{{ route('forfait.update', '') }}/' + id,
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

            var sendpush = $('[name=sendpush]');
            var appel = $('[name=appel]');
            var sms = $('[name=sms]');
            var pushmessage = $('[name=pushmessage]');

            var div = $('.pushdiv');

            function toggle() {
                if (sendpush.is(':checked')) {
                    div.stop().slideDown();
                    $('[name=pushtitle]').attr('required', true);
                    $('[name=pushmessage]').attr('required', true);
                } else {
                    div.stop().slideUp();
                    $('[name=pushtitle]').attr('required', false);
                    $('[name=pushmessage]').attr('required', false);
                }
            }
            sendpush.change(function() {
                toggle();
            })
            toggle();

            var template =
                "Vous pouvez désormais discuter avec un médecin grâce à la nouvelle tarification : \nTMESSAGETAPPEL";

            function mess() {
                var fappel = Number(appel.val()) ?? 0;
                var fsms = Number(sms.val()) ?? 0;
                var m = template.split('TMESSAGE').join(`Message : ${fsms} USD/SMS`);
                if (fappel > 0) {
                    m = m.split('TAPPEL').join(`\nAppel : ${fappel} USD/Sec`);
                } else {
                    m = m.split('TAPPEL').join('');
                }

                m += "\n\nDocta Ton ami médecin"
                pushmessage.val(m);
            }

            mess();

            sms.change(function() {
                mess();
            });
            appel.change(function() {
                mess();
            })

        })
    </script>
@endsection
