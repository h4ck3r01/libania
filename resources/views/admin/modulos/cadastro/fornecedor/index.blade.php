@extends('admin.layouts.admin')

@section('title', 'Fornecedor')

@section('title-left')
    {!! __('views.admin.fornecedor.index.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('cadastro.fornecedor.create') !!}" class="btn btn-app">
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
                        <table width="100%" class="table table-striped table-bordered" id="fornecedor-table"
                               role="grid">
                            <thead>
                            <tr>
                                <th class="hidden">{{ __('views.admin.fornecedor.index.table_header_0') }}</th>
                                <th>{{ __('views.admin.fornecedor.index.table_header_1') }}</th>
                                <th>{{ __('views.admin.fornecedor.index.table_header_2') }}</th>
                                <th>{{ __('views.admin.fornecedor.index.table_header_3') }}</th>
                                <th>{{ __('views.admin.fornecedor.index.table_header_4') }}</th>
                                <th>{{ __('views.admin.fornecedor.index.table_header_5') }}</th>
                                <th>{{ __('views.admin.fornecedor.index.table_header_6') }}</th>
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
            $('#fornecedor-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.15/i18n/Portuguese-Brasil.json'
                },
                ajax: '{!! route('cadastro.datatable.fornecedor') !!}',
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'nome', name: 'nome'},
                    {data: 'telefone', name: 'telefone'},
                    {data: 'email', name: 'email'},
                    {data: 'identificador', name: 'identificador'},
                    {data: 'cep', name: 'cep'},
                    {data: 'endereco', name: 'endereco'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
                createdRow: function (row) {
                    $('td', row).eq(0).addClass('hidden');
                    $('td', row).eq(7).addClass('text-center');
                }
            });
        });
    </script>
@endpush