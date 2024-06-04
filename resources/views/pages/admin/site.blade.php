@extends('layouts.main')
@section('title', 'Parametre site')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Configuration</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Configuration</h4>

                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed ">
                                    <tbody>
                                        <tr>
                                            <td bshow style="cursor: pointer">
                                                Termes et conditions
                                            </td>
                                            <td class="d-flex justify-content-end">
                                                <button bedit class='btn btn-default btn-sm m-1'>
                                                    <i class='fa fa-edit'></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-3" style="display: none; height: 500px; overflow:auto;" id="text">
                                    {!! $terme->text !!}
                                </div>
                                <div class="mt-3" style="display: none" id="zone">
                                    <form class="fadd1" action="#" editor='summernote1'>
                                        <input type="hidden" name="id" value="{{ $terme->id }}">
                                        @csrf
                                        <textarea name="text" id="summernote1" class="mb-2">{!! @$terme->text !!}</textarea>
                                        <div id="rep"></div>
                                        <button type="submit" class="btn btn-default mt-3"><span></span> Valider</button>
                                    </form>
                                </div>

                                <table table class="table table-striped table-hover table-condensed mt-4">
                                    <tbody>
                                        <tr>
                                            <td bshow style="cursor: pointer">
                                                Politique de confidentialité
                                            </td>

                                            <td class="d-flex justify-content-end">
                                                <button bedit class='btn btn-default btn-sm m-1'>
                                                    <i class='fa fa-edit'></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-3" style="display: none; height: 500px; overflow:auto;" id="text">
                                    {!! $politique->text !!}
                                </div>
                                <div class="mt-3" style="display: none" id="zone">
                                    <form class="fadd1" action="#" editor='summernote2'>
                                        <input type="hidden" name="id" value="{{ $politique->id }}">
                                        @csrf
                                        <textarea name="text" id="summernote2" class="mb-2">{!! @$politique->text !!}</textarea>
                                        <div id="rep"></div>
                                        <button type="submit" class="btn btn-default mt-3"><span></span> Valider</button>
                                    </form>
                                </div>

                                <table table class="table table-striped table-hover table-condensed mt-4">
                                    <tbody>
                                        <tr>
                                            <td bshow style="cursor: pointer">
                                                Mentions légales
                                            </td>

                                            <td class="d-flex justify-content-end">
                                                <button bedit class='btn btn-default btn-sm m-1'>
                                                    <i class='fa fa-edit'></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="mt-3" style="display: none; height: 500px; overflow:auto;" id="text">
                                    {!! $mention->text !!}
                                </div>
                                <div class="mt-3" style="display: none" id="zone">
                                    <form class="fadd1" action="#" editor='summernote3'>
                                        <input type="hidden" name="id" value="{{ $mention->id }}">
                                        @csrf
                                        <textarea name="text" id="summernote3" class="mb-2">{!! @$mention->text !!}</textarea>
                                        <div id="rep"></div>
                                        <button type="submit" class="btn btn-default mt-3"><span></span> Valider</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js-code')

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        $(function() {

            $('[bedit]').click(function() {
                var d = $(this).closest('table').next().next();
                d.stop().slideToggle('scale');
            });
            $('[bshow]').click(function() {
                var d = $(this).closest('table').next();
                d.stop().slideToggle('scale');
            });

            $('#summernote1, #summernote2, #summernote3').summernote({
                height: 300
            });


            $('.fadd1').submit(function() {
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
                    url: '{{ route('site.update', '') }}/' + id,
                    success: function(data) {
                        if (data.success) {
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
            })





        })
    </script>
@endsection
