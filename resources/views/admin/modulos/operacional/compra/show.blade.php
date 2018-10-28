@extends('admin.layouts.admin')

@section('title', __('views.admin.compra.title'))

@section('title-left')
    <i class='fa fa-shopping-cart fa-fw'></i> {!! __('views.admin.compra.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('operacional.compra.create') !!}" class="btn btn-app">
        <span class="badge bg-green">!</span>
        <i class="fa fa-edit"></i> {{__('views.admin.button.create')}}
    </a>
    <a href="{!! route('operacional.compra.index') !!}" class="btn btn-app">
        <span class="badge bg-blue">!</span>
        <i class="fa fa-search"></i> {{__('views.admin.button.index')}}
    </a>
@endsection

@section('content')

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
                                {!! Form::date('vencimento', $compra->vencimento, [
                                    'class' => 'form-control',
                                    'readonly' => 'readonly',
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
                            <div class="input-group">
                                {!! Form::text('pessoa_id', $compra->pessoa->nome, [
                                    'class' => 'form-control',
                                    'readonly' => 'readonly',
                                    ]
                                ) !!}
                                <span class="input-group-addon" aria-hidden="true"><i class="fa fa-user"></i></span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-8 col-lg-6">
                            <div class="form-group">
                                {!! Form::label('obs', 'Obs:', ['class' => 'control-label']) !!}
                                {!! Form::textarea('obs', $compra->obs, [
                                                                'class' => 'form-control',
                                                                'rows'=>3,
                                                                'readonly' => 'readonly',
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
                            {!! Form::tel('subtotal', ($compra->total + $compra->desconto - $compra->juros), [
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
                            {!! Form::tel('desconto', $compra->desconto, [
                                'id' => 'desconto',
                                'class' => 'form-control money',
                                'readonly' => 'readonly'
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        {!! Form::label('juros', __('views.admin.compra.juros'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            {!! Form::tel('juros', $compra->juros, [
                                'id' => 'juros',
                                'class' => 'form-control money',
                                'readonly' => 'readonly'
                                ]
                            ) !!}
                        </div>
                    </div>

                    <div class="form-group col-xs-12">
                        {!! Form::label('total', __('views.admin.compra.total'), ['class' => 'control-label']) !!}
                        <div class="input-group">
                            <span class="input-group-addon">R$</span>
                            {!! Form::text('total', $compra->total, [
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
                    <h2><i class="fa fa-barcode"></i> {{__('views.admin.movimento.create.title_2')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @foreach($compra->produtos as $key => $produto)

                        <div class="row">
                            @if($key != 0)
                                <hr/>
                            @endif

                            <div class="form-group col-xs-4">
                                {!! Form::label('produto', __('views.admin.movimento.nome'), ['class' => 'control-label']) !!}
                                {!! Form::text('produto[]', $produto->produto->nome,
                                        [
                                            'class' => 'form-control produto',
                                            'readonly' => 'readonly',
                                        ]
                                    ) !!}
                            </div>

                            <div class="form-group col-xs-2 col-lg-1">
                                {!! Form::label('quantidade', __('views.admin.movimento.quantidade'), ['class' => 'control-label']) !!}
                                {!! Form::number('quantidade[]', $produto->quantidade, [
                                    'class' => 'form-control quantidade',
                                    'readonly' => 'readonly',
                                    ]
                                ) !!}
                            </div>

                            <div class="form-group col-xs-3 col-lg-2">
                                {!! Form::label('preco', __('views.admin.compra.preco'), ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    {!! Form::text('preco[]', $produto->preco, [
                                        'class' => 'form-control money preco',
                                        'readonly' => 'readonly',
                                        ]
                                    ) !!}
                                </div>
                                <div id="preco-errors"></div>
                            </div>

                            <div class="form-group col-xs-3 col-lg-2">
                                {!! Form::label('produto_total', __('views.admin.compra.total'), ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    {!! Form::text('produto_total[]', $produto->total, [
                                        'class' => 'form-control money produto_total',
                                        'readonly' => 'readonly',
                                        ]
                                    ) !!}
                                </div>
                            </div>
                        </div>

                    @endforeach

                    <hr/>

                    <div class="row">
                        {!! Form::open(['id' => 'form-delete', 'method'=>'DELETE', 'action'=> ['Admin\ComprasController@destroy', $compra->id]]) !!}
                        <div class="col-xs-3 col-sm-2 col-lg-1">
                            {!! link_to(route('operacional.compra.index'), __('views.admin.button.back'), ['class' => 'btn btn-primary col-xs-12']) !!}
                        </div>
                        <div class="col-xs-3 col-sm-2 col-lg-1 col-xs-offset-6 col-sm-offset-8 col-lg-offset-10">
                            {!! Form::submit(__('views.admin.button.delete'), ['class' => 'btn btn-danger col-xs-12']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>

        </div>
    </div>
@stop

@push('page-scripts')
    @include('admin.modulos.operacional.compra.scripts.app')
@endpush