@extends('admin.layouts.admin')

@section('title', __('views.admin.fiado.title'))

@section('title-left')
    <i class='fa fa-ticket fa-fw'></i> {!! __('views.admin.fiado.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('financeiro.fiado.index') !!}" class="btn btn-app">
        <span class="badge bg-blue">!</span>
        <i class="fa fa-search"></i> {{__('views.admin.button.index')}}
    </a>
@endsection

@section('content')
    <div class="clearfix"></div>
    @include('admin.messages.form')
    <div class="row">
        <div class="col-xs-12 col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class='fa fa-user fa-fw'></i> {{ __('views.admin.fiado.index.panel_1') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        <div class="form-group col-xs-3 col-lg-6">
                            {!! Form::label('nome', __('views.admin.fiado.nome'), ['class' => 'control-label']) !!}
                            {!! Form::text('nome', $fiado->pessoa->nome, [
                                    'id' => 'nome',
                                    'class' => 'form-control',
                                    'readonly' => 'readonly'
                                    ]
                                ) !!}
                        </div>

                        <div class="form-group col-xs-3 col-lg-6">
                            {!! Form::label('saldo', __('views.admin.fiado.saldo'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::text('saldo', $fiado->total, [
                                    'id' => 'saldo',
                                    'class' => 'form-control money',
                                    'readonly' => 'readonly',
                                    ]
                                ) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="form-group col-xs-4 col-lg-6">
                            {!! Form::label('data_ultimo', __('views.admin.fiado.data_ultimo'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon"><i
                                            class="fa fa-calendar-o"></i></span>
                                {!! Form::date('data_ultimo', $fiado->data_ultimo , [
                                        'id' => 'data_ultimo',
                                        'class' => 'form-control',
                                        'readonly' => 'readonly'
                                        ]
                                    ) !!}
                            </div>
                        </div>

                        <div class="form-group col-xs-3 col-lg-6">
                            {!! Form::label('total_ultimo', __('views.admin.fiado.total_ultimo'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::text('total_ultimo', $fiado->total_ultimo, [
                                        'id' => 'total_ultimo',
                                        'class' => 'form-control money',
                                        'readonly' => 'readonly'
                                        ]
                                    ) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xs-12 col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class='fa fa-money fa-fw'></i> {{ __('views.admin.fiado.index.panel_2') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open(['method'=>'PATCH', 'action'=> ['Admin\FiadoPessoasController@update', $fiado->id], 'data-parsley-validate']) !!}

                    {!! Form::hidden('pessoa_id', $fiado->pessoa_id, ['id' => 'pessoa_id']) !!}
                    {!! Form::hidden('total', $fiado->total) !!}
                    {!! Form::hidden('categoria_id', '3') !!}

                    <div class="row">
                        <div class="form-group col-xs-4 col-lg-6">
                            {!! Form::label('data', __('views.admin.fiado.data'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon"><i
                                            class="fa fa-calendar-o"></i></span>
                                {!! Form::date('data',  date('Y-m-d'), [
                                        'id' => 'data',
                                        'class' => 'form-control',
                                        'required' => 'required',
                                        'data-parsley-required-message' => ""
                                        ]
                                    ) !!}
                            </div>
                        </div>

                        <div class="form-group col-xs-3 col-lg-6">
                            {!! Form::label('pagar', __('views.admin.fiado.pagar'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::text('pagar', null, [
                                    'id' => 'pagar',
                                    'class' => 'form-control money',
                                    'required' => 'required',
                                    'data-parsley-required-message' => "",
                                    ]
                                ) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="form-group col-xs-4 col-lg-6">
                            {!! Form::label('forma_id', __('views.admin.venda.forma'), ['class' => 'control-label']) !!}
                            {!! Form::select('forma_id',
                                    [
                                        ''  =>  __('views.admin.select.default'),
                                    ] + $formas,
                                    null,
                                    [
                                        'id' => 'forma_id',
                                        'class' => 'form-control',
                                        'required' => 'required',
                                        'data-parsley-required-message' => "",
                                    ]
                                ) !!}
                        </div>

                        <div class="col-xs-2 col-lg-3">
                            {!! Form::label('&nbsp;', null, ['class' => 'control-label']) !!}
                            {!! link_to(route('financeiro.fiado.index'), __('views.admin.button.cancel'), ['class' => 'btn btn-primary col-xs-12']) !!}
                        </div>
                        <div class="col-xs-2 col-lg-3">
                            {!! Form::label('&nbsp;', null, ['class' => 'control-label']) !!}
                            {!! Form::submit(__('views.admin.button.confirm'), ['id' => 'finalizar', 'class' => 'btn btn-success col-xs-12']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

    <hr/>

    <div class="row">
        <div class="col-xs-12 col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class='fa fa-list fa-fw'></i> {{ __('views.admin.fiado.index.panel_3') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-fiado-vendas" width="100%">
                            <thead>
                            <tr>
                                <th>{{ __('views.admin.fiado.show.table_1.header_0') }}</th>
                                <th>{{ __('views.admin.fiado.show.table_1.header_1') }}</th>
                                <th>{{ __('views.admin.fiado.show.table_1.header_3') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-lg-6">
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class='fa fa-list fa-fw'></i> {{ __('views.admin.fiado.index.panel_4') }}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered nowrap" id="table-fiado-recebimentos"
                               width="100%">
                            <thead>
                            <tr>
                                <th class="hidden"></th>
                                <th>{{ __('views.admin.fiado.show.table_2.header_1') }}</th>
                                <th>{{ __('views.admin.fiado.show.table_2.header_2') }}</th>
                                <th>{{ __('views.admin.fiado.show.table_2.header_3') }}</th>
                                <th></th>
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
    @include('admin.modulos.financeiro.fiado.scripts.app')
@endpush