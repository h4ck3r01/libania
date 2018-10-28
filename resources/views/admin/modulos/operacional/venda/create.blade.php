@extends('admin.layouts.admin')

@section('title', __('views.admin.venda.title'))

@section('title-left')
    <i class='fa fa-line-chart fa-fw'></i> {!! __('views.admin.venda.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('operacional.venda.index') !!}" class="btn btn-app">
        <span class="badge bg-blue">!</span>
        <i class="fa fa-search"></i> {{__('views.admin.button.index')}}
    </a>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12 col-lg-9">
            @include('admin.messages.form')
            <div class="x_panel">
                <div class="x_content">
                    {!! Form::open(['id' => 'form-add', 'data-parsley-validate']) !!}

                    <div class="row">
                        <div class="form-group col-xs-6">
                            {!! Form::label('produto', __('views.admin.venda.produto'), ['class' => 'control-label']) !!}
                            {!! Form::select('produto',
                                    [
                                        ''  =>  __('views.admin.select.default'),
                                    ] + $produtos,
                                    null,
                                    [
                                        'id' => 'produto',
                                        'class' => 'form-control select2',
                                        'required' => 'required',
                                        'data-parsley-required-message' => "",
                                    ]
                                ) !!}
                        </div>


                        <div class="form-group col-xs-2">
                            {!! Form::label('quantidade', __('views.admin.venda.quantidade'), ['class' => 'control-label']) !!}
                            {!! Form::number('quantidade', null, [
                                'id' => 'quantidade',
                                'class' => 'form-control',
                                'data-parsley-required-message' => "",
                                'required' => 'required',
                                ]
                            ) !!}
                        </div>

                        <div class="form-group col-xs-3">
                            {!! Form::label('valor', __('views.admin.venda.valor'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::tel('valor', null, [
                                    'id' => 'valor',
                                    'class' => 'form-control money',
                                    'data-parsley-required-message' => "",
                                    'required' => 'required',
                                    ]
                                ) !!}
                            </div>
                        </div>
                        <div class="form-group col-xs-1">
                            {!! Form::label('', '&nbsp;', ['class' => 'control-label']) !!}
                            <br/>
                            {!! Form::button("<span class='fa fa-plus-square'></span>", ['type'=>'submit', 'id' => 'add', 'class' => 'btn btn-success', 'disabled' => 'disabled']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-barcode"></i> {{__('views.admin.venda.create.panel_1')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-bordered table-striped nowrap" id="table-produtos">
                        <thead>
                        <tr>
                            <th class="hidden"></th>
                            <th>{{ __('views.admin.venda.create.table_header_0') }}</th>
                            <th class='text-center'>{{ __('views.admin.venda.create.table_header_1') }}</th>
                            <th class='text-right'>{{ __('views.admin.venda.create.table_header_2') }}</th>
                            <th width="10%"></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-xs-12 col-lg-3">
            {!! Form::open(['id' => 'form-finalizar', 'data-parsley-validate']) !!}
            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="form-group col-xs-6 col-sm-4 col-lg-12">
                            {!! Form::label('pessoa_id', __('views.admin.venda.cliente'), ['class' => 'control-label']) !!}
                            {!! Form::select('pessoa_id',
                                    [
                                        ''  =>  __('views.admin.select.default'),
                                    ] + $pessoas,
                                    null,
                                    [
                                        'id' => 'pessoa_id',
                                        'class' => 'form-control select2',
                                        'data-parsley-required-message' => "",
                                    ]
                                ) !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="form-group col-xs-12">
                            <div class="row">
                                <div class="col-xs-4 col-lg-12">
                                    {!! Form::label('data', __('views.admin.venda.data'), ['class' => 'control-label']) !!}
                                    <div class="input-group">
                                        {!! Form::date('data', date('Y-m-d'), [
                                            'class' => 'form-control',
                                            'data-parsley-errors-container' => "#data-errors",
                                            'required' => 'required',
                                            ]
                                        ) !!}
                                        <span class="input-group-addon" aria-hidden="true"><i
                                                    class="fa fa-calendar-o"></i></span>
                                    </div>
                                    <div id="data-errors"></div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-xs-4 col-lg-12">
                            {!! Form::label('subtotal', __('views.admin.venda.subtotal'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::tel('subtotal', '0', [
                                    'id' => 'subtotal',
                                    'class' => 'form-control money',
                                    'readonly' => 'readonly',
                                    ]
                                ) !!}
                            </div>
                        </div>

                        <div class="form-group col-xs-4 col-lg-12">
                            {!! Form::label('desconto', __('views.admin.venda.desconto'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::tel('desconto', '0', [
                                    'id' => 'desconto',
                                    'class' => 'form-control money',
                                    ]
                                ) !!}
                            </div>
                        </div>

                        <div class="form-group col-xs-4 col-lg-12">
                            {!! Form::label('total', __('views.admin.venda.total'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::tel('total', '0', [
                                    'id' => 'total',
                                    'class' => 'form-control money',
                                    'readonly' => 'readonly'
                                    ]
                                ) !!}
                            </div>
                        </div>

                        <div class="forma_id">
                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="form-group col-xs-4 col-lg-12">
                                        <hr/>
                                        {!! Form::label('forma_id', __('views.admin.venda.forma_1'), ['class' => 'control-label']) !!}
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

                                    <div class="form-group col-xs-4  col-lg-12">
                                        <hr class="hidden-lg"/>
                                        {!! Form::label('total_1', __('views.admin.venda.total'), ['class' => 'control-label']) !!}
                                        <div class="input-group">
                                            <span class="input-group-addon">R$</span>
                                            {!! Form::tel('total_1', 0, [
                                                'id' => 'total_1',
                                                'class' => 'form-control money',
                                                'data-parsley-required-message' => "",
                                                ]
                                            ) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="hidden" id="forma_2">

                            <div class="row">
                                <div class="col-xs-12">

                                    <div class="form-group col-xs-4 col-lg-12">
                                        <hr/>
                                        {!! Form::label('forma_id_opcional', __('views.admin.venda.forma_2'), ['class' => 'control-label']) !!}
                                        {!! Form::select('forma_id_opcional',
                                                [
                                                    ''  =>  __('views.admin.select.default'),
                                                ] + $formas,
                                                null,
                                                [
                                                    'id' => 'forma_id_opcional',
                                                    'class' => 'form-control',
                                                    'data-parsley-required-message' => "",
                                                ]
                                            ) !!}
                                    </div>

                                    <div class="form-group col-xs-4 col-lg-12">
                                        <hr class="hidden-lg"/>
                                        {!! Form::label('total_2', __('views.admin.venda.total'), ['class' => 'control-label']) !!}
                                        <div class="input-group">
                                            <span class="input-group-addon">R$</span>
                                            {!! Form::tel('total_2', null, [
                                                'id' => 'total_2',
                                                'class' => 'form-control money',
                                                'data-parsley-required-message' => "",
                                                ]
                                            ) !!}
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <div class="col-xs-12">
                            <hr/>
                            <div class="row">
                                <div class="col-xs-12" id="add_forma_div">
                                    {!! Form::button("<span class='fa fa-plus-square'></span>", ['type'=>'button', 'id' => 'add_forma', 'class' => 'btn btn-success']) !!}
                                </div>
                                <div class="col-xs-12 hidden" id="remove_forma_div">
                                    {!! Form::button("<span class='fa fa-minus-square'></span>", ['type'=>'button', 'id' => 'remove_forma', 'class' => 'btn btn-danger']) !!}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <hr/>
                        <div class="col-xs-4 col-lg-6">
                            {!! link_to(route('operacional.venda.index'), __('views.admin.button.cancel'), ['class' => 'btn btn-primary col-xs-12']) !!}
                        </div>
                        <div class="col-xs-4 col-xs-offset-4 col-lg-6 col-lg-offset-0">
                            {!! Form::submit(__('views.admin.venda.button.finalizar'), ['id' => 'finalizar', 'class' => 'btn btn-success col-xs-12', 'disabled' => 'disabled']) !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>

    </div>
@stop

@push('page-scripts')
    @include('admin.modulos.operacional.venda.scripts.app')
@endpush