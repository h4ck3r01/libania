@extends('admin.layouts.admin')

@section('title', __('views.admin.fechamento.title'))

@section('title-left')
    <i class='fa fa-money fa-fw'></i> {!! __('views.admin.fechamento.title') !!}
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
                            <h2><i class="fa fa-calendar"></i> {{__('views.admin.fechamento.index.panel_1')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-xs-6 col-sm-4 col-lg-3">
                                    {!! Form::label('data_inicial', __('views.admin.fechamento.index.periodo_1'), ['class' => 'control-label']) !!}
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

                            </div>
                            <hr/>
                            <div class="row">

                                <div class="col-xs-6 col-sm-4 col-lg-2">
                                    {!! Form::label('total', __('views.admin.fechamento.total'), ['class' => 'control-label']) !!}
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

                                <div class="col-xs-4 col-sm-2 col-lg-2">
                                    {!! Form::label('porcentagem', __('views.admin.fechamento.porcentagem'), ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon">%</span>
                                        {!! Form::number('porcentagem', '0', [
                                            'id' => 'porcentagem',
                                            'class' => 'form-control number',
                                            'max' => '100',
                                            'min' => '0'
                                            ]
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-2 col-lg-2">
                                    {!! Form::label('reserva', __('views.admin.fechamento.reserva'), ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        {!! Form::text('reserva', '0', [
                                            'id' => 'reserva',
                                            'class' => 'form-control money',
                                            'readonly' => 'readonly'
                                            ]
                                        ) !!}
                                    </div>
                                </div>

                                <div class="col-xs-4 col-sm-2 col-lg-2">
                                    {!! Form::label('lucro', __('views.admin.fechamento.lucro'), ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        <span class="input-group-addon">R$</span>
                                        {!! Form::text('lucro', '0', [
                                            'id' => 'lucro',
                                            'class' => 'form-control money',
                                            'readonly' => 'readonly'
                                            ]
                                        ) !!}
                                    </div>
                                </div>
                                <div class="col-xs-4 col-sm-2 col-lg-2">
                                    <label>&nbsp;</label>
                                    <br/>
                                    {!! Form::submit(__('views.admin.button.save'), ['id'=> 'submit', 'class' => 'btn btn-success']) !!}
                                </div>
                            </div>

                            {!! Form::text('recebimentos_cartao_hidden', '0', [
                                           'id' => 'recebimentos_cartao_hidden',
                                           'class' => 'hidden',
                                           ]
                                       ) !!}
                            {!! Form::text('recebimentos_dinheiro_hidden', '0', [
                                           'id' => 'recebimentos_dinheiro_hidden',
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
                    <h2><i class="fa fa-money"></i> {{__('views.admin.fechamento.index.panel_2')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-fechamento-cartao"
                               width="100%">
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
                    <h2 id="total_recebimentos_cartao"></h2>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-money"></i> {{__('views.admin.fechamento.index.panel_3')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-fechamento-dinheiro"
                               width="100%">
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
                    <h2 id="total_recebimentos_dinheiro"></h2>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-money"></i> {{__('views.admin.fechamento.index.panel_4')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-fechamento-pagamentos"
                               width="100%">
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

    @include('admin.modulos.financeiro.fechamento.scripts.app')
@endpush