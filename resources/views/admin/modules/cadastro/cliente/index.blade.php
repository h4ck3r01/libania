@extends('admin.layouts.admin')

@section('title', 'Cliente')

@section('title-left')
    {!! __('views.admin.clients.index.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('cadastro.cliente.create') !!}" class="btn btn-app">
        <span class="badge bg-green">!</span>
        <i class="fa fa-edit"></i> Cadastrar
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    <div class="col-md-12 table-responsive">
                        <table width="100%" class="table table-striped table-bordered" id="clients-table" role="grid">
                            <thead>
                            <tr>
                                <th class="hidden">{{ __('views.admin.clients.index.table_header_0') }}</th>
                                <th>{{ __('views.admin.clients.index.table_header_1') }}</th>
                                <th>{{ __('views.admin.clients.index.table_header_2') }}</th>
                                <th>{{ __('views.admin.clients.index.table_header_3') }}</th>
                                <th width="10%"></th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(function () {
            $('#clients-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
                },
                ajax: '{!! route('cadastro.datatable.cliente') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'phone', name: 'phone'},
                    {data: 'email', name: 'email'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                createdRow: function (row) {
                    $('td', row).eq(0).addClass('hidden');
                    $('td', row).eq(4).addClass('text-center');
                }
            });
        });
    </script>
@endpush