@extends('admin.layouts.admin')

@section('title', __('views.admin.recebimentos.title'))

@section('title-left')
    <i class='fa fa-money fa-fw'></i> {!! __('views.admin.recebimentos.title') !!}
@endsection

@section('content')

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-xs-12">
            @include('admin.messages.form')
            <div class="row">
                <div class="col-xs-6 col-sm-4 col-lg-3">

                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-calendar"></i> {{__('views.admin.recebimentos.index.panel_1')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="row">
                                <div class="col-xs-12">
                                    {!! Form::label('data_inicial', __('views.admin.recebimentos.index.periodo_1'), ['class' => 'control-label']) !!}
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
                            <br/>
                            <div class="row">
                                <div class="col-xs-12">
                                    {!! Form::label('data_final', __('views.admin.recebimentos.index.periodo_2'), ['class' => 'control-label']) !!}
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
                            </div>

                        </div>
                    </div>

                </div>
                <div class="col-xs-6 col-sm-8 col-lg-9">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2><i class="fa fa-filter"></i> {{__('views.admin.recebimentos.index.panel_2')}}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                            <div class="row">
                                <div class="form-group col-xs-8 col-sm-4 col-lg-3">
                                    {!! Form::label('categoria', __('views.admin.recebimentos.categoria') . ':', ['class' => 'control-label']) !!}
                                    {!! Form::select('categoria', [''=> __('views.admin.select.default')] + $categorias,
                                              null,
                                               ['class' => 'form-control select2',
                                               'id' => 'categoria']) !!}
                                </div>
                                <div class="form-group col-xs-8 col-sm-4 col-lg-3">
                                    {!! Form::label('cliente', __('views.admin.recebimentos.pessoa') . ':', ['class' => 'control-label']) !!}
                                    {!! Form::select('cliente', [''=> __('views.admin.select.default')] + $pessoas,
                                              null,
                                               ['class' => 'form-control select2',
                                               'id' => 'cliente']) !!}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
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
                    <h2 id="total"></h2>
                </div>
            </div>
        </div>

    </div>

    @include('admin.modulos.financeiro.recebimentos.partials.modal')
@stop

@push('page-scripts')
    {!! $dataTable->scripts() !!}

    @include('admin.modulos.financeiro.recebimentos.scripts.app')
@endpush