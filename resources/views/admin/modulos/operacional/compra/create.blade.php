@extends('admin.layouts.admin')

@section('title', __('views.admin.compra.title'))

@section('title-left')
    <i class='fa fa-shopping-cart fa-fw'></i> {!! __('views.admin.compra.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('operacional.compra.index') !!}" class="btn btn-app">
        <span class="badge bg-blue">!</span>
        <i class="fa fa-search"></i> {{__('views.admin.button.index')}}
    </a>
@endsection

@section('content')
    {!! Form::open(['method'=>'POST', 'action'=> 'Admin\ComprasController@store', 'data-parsley-validate', 'id' => 'form']) !!}

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-xs-8 col-lg-9">
            @include('admin.messages.form')
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-edit"></i> {{__('views.admin.compra.create.title_1')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        <div class="form-group col-xs-6 col-sm-2">
                            {!! Form::label('vencimento', __('views.admin.compra.vencimento'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                {!! Form::date('vencimento', null, [
                                    'class' => 'form-control',
                                    'required' => 'required',
                                    'data-parsley-required-message' => '',
                                    ]
                                ) !!}
                                <span class="input-group-addon" aria-hidden="true"><i
                                            class="fa fa-calendar-o"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-8 col-lg-6">
                            {!! Form::label('pessoa_id', __('views.admin.compra.fornecedor'), ['class' => 'control-label']) !!}
                            {!! Form::select('pessoa_id',
                                       [
                                           ''  =>  __('views.admin.select.default'),
                                       ] + $fornecedores,
                                       null,
                                       [
                                           'id' => 'fornecedor',
                                           'class' => 'form-control select2',
                                           'required' => 'required',
                                           'data-parsley-errors-container' => "#fornecedor-errors",
                                       ]
                                   ) !!}
                            <div id="fornecedor-errors"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-8 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('obs', 'Obs:', ['class' => 'control-label']) !!}
                                {!! Form::textarea('obs', null, [
                                                                'class' => 'form-control',
                                                                'rows'=>3,
                                                                'required' => 'required',
                                                                ]
                                ) !!}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-xs-4 col-lg-3">
            <div class="x_panel">
                <div class="x_content">

                    <div class="form-group col-xs-12">
                        {!! Form::label('subtotal', __('views.admin.compra.subtotal'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            {!! Form::tel('subtotal', 0, [
                                'id' => 'subtotal',
                                'class' => 'form-control money',
                                'readonly' => 'readonly',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        {!! Form::label('desconto', __('views.admin.compra.desconto'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            {!! Form::tel('desconto', 0, [
                                'id' => 'desconto',
                                'class' => 'form-control money',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        {!! Form::label('juros', __('views.admin.compra.juros'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            {!! Form::tel('juros', 0, [
                                'id' => 'juros',
                                'class' => 'form-control money',
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        {!! Form::label('total', __('views.admin.compra.total'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            {!! Form::tel('total', 0, [
                                'id' => 'total',
                                'class' => 'form-control money',
                                'readonly' => 'readonly',
                                ]
                            ) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        <div class="col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-barcode"></i> {{__('views.admin.compra.create.title_2')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @for ($i = 0; $i < 100; $i++)

                        <div id="{{$i}}" class="row @if($i != 0 ) hidden @endif">
                            <div class="form-group col-xs-4">
                                {!! Form::label('produto', __('views.admin.compra.nome'), ['class' => 'control-label']) !!}
                                {!! Form::select('produto[' . $i . ']',
                                        [
                                            ''  =>  __('views.admin.select.default'),
                                        ] + $produtos,
                                        null,
                                        [
                                            'class' => 'form-control select2 produto',
                                            'data-parsley-required-message' => "",
                                        ]
                                    ) !!}
                            </div>

                            <div class="form-group col-xs-2 col-lg-1">
                                {!! Form::label('quantidade', __('views.admin.compra.quantidade'), ['class' => 'control-label']) !!}
                                {!! Form::number('quantidade[' . $i . ']', null, [
                                    'class' => 'form-control quantidade',
                                    'data-parsley-required-message' => "",
                                    ]
                                ) !!}
                            </div>

                            <div class="form-group col-xs-3 col-lg-2">
                                {!! Form::label('preco', __('views.admin.compra.preco'), ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    {!! Form::tel('preco[' . $i . ']', null, [
                                        'class' => 'form-control money preco',
                                        'data-parsley-required-message' => "",
                                        ]
                                    ) !!}
                                </div>
                            </div>

                            <div class="form-group col-xs-3 col-lg-2">
                                {!! Form::label('produto_total', __('views.admin.compra.total'), ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    {!! Form::tel('produto_total[' . $i . ']', null, [
                                        'class' => 'form-control money produto_total',
                                        'readonly' => 'readonly',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-xs-12">
                                <hr/>
                            </div>
                        </div>

                    @endfor

                    {!! Form::button("<span class='fa fa-plus-square'></span>", ['id' => 'add', 'class' => 'btn btn-success']) !!}

                    <hr/>

                    <div class="row">
                        <div class="col-xs-12">
                            {!! link_to(route('operacional.compra.index'), __('views.admin.button.cancel'), ['class' => 'btn btn-primary col-xs-3 col-sm-2 col-lg-1']) !!}
                            {!! Form::reset(__('views.admin.button.reset'), ['class' => 'btn btn-primary col-xs-3 col-sm-2 col-lg-1']) !!}
                            {!! Form::submit(__('views.admin.button.save'), ['class' => 'btn btn-success col-xs-3 col-sm-2 col-lg-1']) !!}
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {!! Form::close() !!}
@stop

@push('page-scripts')
    @include('admin.modulos.operacional.compra.scripts.app')
@endpush