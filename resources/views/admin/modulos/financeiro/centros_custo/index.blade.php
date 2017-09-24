@extends('admin.layouts.admin')

@section('title', __('views.admin.cc.title'))

@section('title-left')
    <i class='fa fa-institution fa-fw'></i> {!! __('views.admin.cc.title') !!}
@endsection

@section('content')

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-xs-12 col-lg-6">
            @include('admin.messages.form')
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h2><i class="fa fa-search"></i> {{__('views.admin.cc.table_1')}}</h2>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button id="centro_insert" class="btn btn-success" data-toggle="modal"
                                    data-target="#modal-centro"><i class="fa fa-plus-square"></i></button>
                            <button id="centro_update" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-centro" disabled><i class="fa fa-edit"></i></button>
                            <button id="centro_delete" class="btn btn-danger" disabled><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">

                        {!! $dataTable->table(['class' => 'table table-hover table-bordered nowrap', 'id' => 'table-centros', 'width' => '100%']) !!}

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h2><i class="fa fa-search"></i> {{__('views.admin.cc.table_2')}}</h2>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button id="categoria_insert" class="btn btn-success" data-toggle="modal"
                                    data-target="#modal-categoria" disabled><i class="fa fa-plus-square"></i></button>
                            <button id="categoria_update" class="btn btn-primary" data-toggle="modal"
                                    data-target="#modal-categoria" disabled><i class="fa fa-edit"></i></button>
                            <button id="categoria_delete" class="btn btn-danger" disabled><i class="fa fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-categorias">
                            <thead>
                            <tr>
                                <th>{{ __('views.admin.cc.index.table_2_header_0') }}</th>
                                <th>{{ __('views.admin.cc.index.table_2_header_1') }}</th>
                                <th>{{ __('views.admin.cc.index.table_2_header_2') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td colspan="3" class="text-center">
                                    {{ __('views.admin.cc.index.table_2.default') }}
                                </td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

    </div>

    @include('admin.modulos.financeiro.centros_custo.partials.modal-centro')
    @include('admin.modulos.financeiro.centros_custo.partials.modal-categoria')
@stop

@push('page-scripts')
    {!! $dataTable->scripts() !!}

    @include('admin.modulos.financeiro.centros_custo.scripts.centro')
    @include('admin.modulos.financeiro.centros_custo.scripts.categoria')
@endpush