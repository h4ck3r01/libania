@extends('admin.layouts.admin')

@section('title', __('views.admin.relacao_vendas.title'))

@section('title-left')
    <i class='fa fa-line-chart fa-fw'></i> {!! __('views.admin.relacao_vendas.title') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    @include('admin.messages.form')
                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel">
                            <div class="panel-heading collapsed" role="tab">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="#filter" data-toggle="collapse">
                                            <p class="panel-title">
                                                <i class="fa fa-filter"></i> {{__('views.admin.filtro')}}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="filter" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="filter">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group col-xs-8 col-sm-4 col-lg-2">
                                            {!! Form::label('data_inicial', 'Data Inicial:', ['class' => 'control-label']) !!}
                                            {!! Form::date('data_inicial',
                                                       date("Y-m-d", strtotime("-1 month", strtotime("today"))),
                                                       ['class' => 'form-control',
                                                       'id' => 'data_inicial']) !!}
                                        </div>
                                        <div class="form-group col-xs-8 col-sm-4 col-lg-2">
                                            {!! Form::label('data_final', 'Data Final:', ['class' => 'control-label']) !!}
                                            {!! Form::date('data_final',
                                                       date('Y-m-d'),
                                                       ['class' => 'form-control',
                                                       'id' => 'data_final']) !!}
                                        </div>
                                        <div class="form-group col-xs-8 col-sm-4 col-lg-3">
                                            {!! Form::label('categoria', 'Categoria:', ['class' => 'control-label']) !!}
                                            {!! Form::select('categoria', [''=> __('views.admin.select.default')] + $categorias,
                                                      null,
                                                       ['class' => 'form-control select2',
                                                       'id' => 'categoria']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-relacao-vendas" width="100%">
                            <thead>
                            <tr>

                                <th>{{ __('views.admin.relacao_vendas.index.table_header_0') }}</th>
                                <th>{{ __('views.admin.relacao_vendas.index.table_header_1') }}</th>
                                <th>{{ __('views.admin.relacao_vendas.index.table_header_2') }}</th>
                                <th>{{ __('views.admin.relacao_vendas.index.table_header_3') }}</th>
                                <th>{{ __('views.admin.relacao_vendas.index.table_header_4') }}</th>
                                <th>{{ __('views.admin.relacao_vendas.index.table_header_5') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-scripts')
    {!! $dataTable->scripts() !!}

    @include('admin.modulos.administrativo.relacao_vendas.scripts.app')
@endpush