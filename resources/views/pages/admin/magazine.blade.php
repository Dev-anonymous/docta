@extends('layouts.main')
@section('title', 'Magazines')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Magazines</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Magazines</h4>
                                <div class="">
                                    <button class="mb-2 btn btn-default" data-toggle="modal" data-target="#addmdl">
                                        Nouveau Magazine</button>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed">
                                    <thead>
                                        <tr>
                                            <th>CATEGORIE</th>
                                            <th>TITRE</th>
                                            <th>DESCRIPTION</th>
                                            <th>AFFICHE</th>
                                            <th>FICHIER</th>
                                            <th>TYPE</th>
                                            <th>DATE</th>
                                            <th>DATE PUBLICATION</th>
                                            <th>DETAILS</th>
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
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Nouveau Magazine</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">X</span>
                    </button>
                </div>
                <form id="fadd">
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Catégorie</label>
                            <select name="categoriemagazine_id" id="" class="form-control">
                                @foreach ($categories as $el)
                                    <option value="{{ $el->id }}">{{ ucfirst($el->categorie) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Fichier magazine téléchargeable(optionnel) : .pdf</label>
                            <input type="file" accept=".pdf" class="form-control" name="fichier">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Affiche du magazine : .png,.jpg,.jpeg (500x300 | 1000x500)</label>
                            <input type="file" accept=".png,.jpg,.jpeg," class="form-control" name="image" required>
                        </div>
                        <div class="form-check form-check-inline mb-3">
                            <input name="free" class="form-check-input" type="checkbox" id="inlineCheckbox12213">
                            <label class="form-check-label" for="inlineCheckbox12213">Ce magazine est gratuit</label>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Date du magaine</label>
                            <input type="text" class="form-control flatpickr" name="date" value="{{ date('Y-m-d') }}"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Titre</label>
                            <input type="text" maxlength="100" class="form-control" name="titre" required>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Petite description</label>
                            <input class="form-control" maxlength="255" name="description" required>
                        </div>
                        <div class="form-group">
                            <label for="">Longue description</label>
                            <textarea class="form-control" id="summernote"></textarea>
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


@endsection
@section('js-code')
    <x-plugins.datatable />
    <x-plugins.flatpickr />
    <x-plugins.summernote />

    <script>
        flatpickr(".flatpickr", {
            dateFormat: "Y-m-d",
        });
        $('#summernote').summernote({
            height: 900,
        });

        $(function() {
            $('#fadd').submit(function() {
                event.preventDefault();
                var form = $(this);
                var btn = $(':submit', form);
                btn.find('span').removeClass().addClass('fa fa-spinner fa-spin');
                var data = new FormData(form[0]);
                var text = $('#summernote').summernote('code');
                data.append('text', text);
                $(':input', form).attr('disabled', true);
                var rep = $('#rep', form);
                rep.stop().slideUp();
                $.ajax({
                    type: 'post',
                    data: data,
                    contentType: false,
                    processData: false,
                    url: '{{ route('magazine.store') }}',
                    success: function(data) {
                        if (data.success) {
                            form[0].reset();
                            rep.removeClass().addClass('alert alert-success');
                            dtTableObj.ajax.reload();
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
                    url: '{{ route('magazine.destroy', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
                            rep.removeClass().addClass('alert alert-success');
                            dtTableObj.ajax.reload();
                            setTimeout(() => {
                                $('.modal').modal('hide');
                            }, 3000);
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

            var dtTableObj = $('[table]').DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('magazine.index', ['datatable' => '']) }}",
                    data: function(d) {
                        // d.type = useroleselect.val();
                    },
                    error: function(err) {
                        var resp = err.responseJSON;
                        var code = err.status;
                        var m = '';
                        if (resp) {
                            m = resp.message;
                        }
                        if (!m) {
                            m = `Something went wrong ! [code:${code}]`;
                        }
                        $('[onerror]').find('span[text]').html(' : ' + m).closest('div').slideDown();
                    },

                },
                dom: 'Bfrtip',
                buttons: [
                    'pageLength', 'excel', 'pdf',
                ],
                lengthMenu: [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                order: [
                    [8, 'desc']
                ],
                columnDefs: [
                    // {
                    //     width: '1%',
                    //     targets: 0
                    // },
                    {
                        width: '1%',
                        targets: 9
                    }
                ],
                columns: [{
                        data: 'categoriemagazine_id',
                        name: 'categoriemagazine_id',
                    }, {
                        data: 'titre',
                        name: 'titre',
                    },
                    {
                        data: 'description',
                        name: 'description',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'fichier',
                        name: 'fichier',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'free',
                        name: 'free'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    },
                    {
                        data: 'datepublication',
                        name: 'datepublication'
                    }, {
                        data: 'view',
                        name: 'view',
                        orderable: true,
                        searchable: false
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            }).on('draw.dt', function() {
                $('[bdel]').off('click').click(function() {
                    var id = $(this).val();
                    $('#delmdl').modal('show')
                    $('[name=id]', $('#fdel')).val(id);
                });
            });
        })
    </script>
@endsection
