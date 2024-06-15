@extends('layouts.main')
@section('title', 'Log')
@section('body')
    <div class="content-body">
        <div class="row page-titles mx-0">
            <div class="col p-md-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                    <li class="breadcrumb-item active"><a href="javascript:void(0)">Log</a></li>
                </ol>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h4 class="card-title">Log</h4>

                            </div>
                            <div class="table-responsive">
                                <table table class="table table-striped table-hover table-condensed zero-configuration"
                                    style="'width:100%">
                                    <thead>
                                        <tr>
                                            <th>1</th>
                                            <th>Log</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $i => $el)
                                            <tr>
                                                <th>{{ $i + 1 }}</th>
                                                <td>{{ $el->data }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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



        })
    </script>
@endsection
