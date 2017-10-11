@extends('admin.layouts.admin')

@section('title', __('views.admin.caixa.title'))

@section('title-left')
    <i class='fa fa-money fa-fw'></i> {!! __('views.admin.caixa.title') !!}
@endsection

@section('content')

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-xs-12">
            @include('admin.messages.form')
            <div class="row">
                <div class="col-xs-12">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-calendar"></i> {{__('views.admin.caixa.index.panel_1')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-xs-6 col-sm-4 col-lg-3">
                                    {!! Form::label('data_inicial', __('views.admin.caixa.index.periodo_1'), ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        {!! Form::date('data_inicial', date('Y-m-d'), [
                                            'id' => 'data_inicial',
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            ]
                                        ) !!}
                                        <span class="input-group-addon" aria-hidden="true"><i
                                                    class="fa fa-calendar-o"></i></span>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-sm-4 col-lg-3">
                                    {!! Form::label('data_final', __('views.admin.caixa.index.periodo_2'), ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        {!! Form::date('data_final', date('Y-m-d'), [
                                            'id' => 'data_final',
                                            'class' => 'form-control',
                                            'required' => 'required',
                                            ]
                                        ) !!}
                                        <span class="input-group-addon" aria-hidden="true"><i
                                                    class="fa fa-calendar-o"></i></span>
                                    </div>
                                </div>

                                <div class="col-xs-6 col-xs-offset-6 col-sm-4 col-sm-offset-0 col-lg-3 col-lg-offset-3">
                                    {!! Form::label('total', __('views.admin.venda.total'), ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        {!! Form::text('total', '0', [
                                            'id' => 'total',
                                            'class' => 'form-control money',
                                            'readonly' => 'readonly'
                                            ]
                                        ) !!}
                                    </div>
                                </div>

                            </div>
                            {!! Form::text('recebimentos_hidden', '0', [
                                           'id' => 'recebimentos_hidden',
                                           'class' => 'hidden',
                                           ]
                                       ) !!}
                            {!! Form::text('pagamentos_hidden', '0', [
                                        'id' => 'pagamentos_hidden',
                                        'class' => 'hidden'
                                        ]
                                    ) !!}

                        </div>
                    </div>

                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-money"></i> {{__('views.admin.caixa.index.panel_2')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-recebimentos" width="100%">
                            <thead>
                            <tr>
                                <th class="hidden"></th>
                                <th>{{ __('views.admin.recebimentos.index.table_header_0') }}</th>
                                <th>{{ __('views.admin.recebimentos.index.table_header_1') }}</th>
                                <th>{{ __('views.admin.recebimentos.index.table_header_2') }}</th>
                                <th>{{ __('views.admin.recebimentos.index.table_header_3') }}</th>
                                <th>{{ __('views.admin.recebimentos.index.table_header_4') }}</th>
                                <th>{{ __('views.admin.recebimentos.index.table_header_5') }}</th>
                                <th class="hidden"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="x_footer text-right">
                    <div class="clearfix"></div>
                    <hr/>
                    <h2 id="total_recebimentos"></h2>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-money"></i> {{__('views.admin.caixa.index.panel_3')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-pagamentos" width="100%">
                            <thead>
                            <tr>
                                <th class="hidden"></th>
                                <th>{{ __('views.admin.pagamentos.index.table_header_0') }}</th>
                                <th>{{ __('views.admin.pagamentos.index.table_header_1') }}</th>
                                <th>{{ __('views.admin.pagamentos.index.table_header_2') }}</th>
                                <th>{{ __('views.admin.pagamentos.index.table_header_3') }}</th>
                                <th>{{ __('views.admin.pagamentos.index.table_header_4') }}</th>
                                <th>{{ __('views.admin.pagamentos.index.table_header_5') }}</th>
                                <th class="hidden"></th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
                <div class="x_footer text-right">
                    <div class="clearfix"></div>
                    <hr/>
                    <h2 id="total_pagamentos"></h2>
                </div>
            </div>

        </div>
    </div>
@stop

@push('page-scripts')

    @include('admin.modulos.financeiro.caixa.scripts.app')
@endpush