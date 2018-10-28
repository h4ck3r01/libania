@extends('admin.layouts.admin')

@section('title', __('views.admin.venda.title'))

@section('title-left')
    <i class='fa fa-line-chart fa-fw'></i> {!! __('views.admin.venda.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('operacional.venda.create') !!}" class="btn btn-app">
        <span class="badge bg-green">!</span>
        <i class="fa fa-edit"></i> {{__('views.admin.venda.create.title')}}
    </a>
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
                <div class="x_title">
                    <h2><h2><i class="fa fa-barcode"></i> {{__('views.admin.venda.create.panel_1')}}</h2>
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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($venda->produtos as $venda_produto)
                            <tr>
                                <td>{{$venda_produto->produto->nome}}</td>
                                <td class='text-center'>{{$venda_produto->quantidade}}</td>
                                <td class='text-right'>{{ parseMoney($venda_produto->total) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="col-xs-12 col-lg-3">

            @if(!empty($venda->pessoa->nome))
                <div class="x_panel">
                    <div class="x_content">
                        <div class="row">
                            <div class="form-group col-xs-6 col-sm-4 col-lg-12">
                                {!! Form::label('pessoa_id', __('views.admin.venda.cliente'), ['class' => 'control-label']) !!}
                                {!! Form::text('pessoa_id', $venda->pessoa->nome, [
                                        'id' => 'pessoa_id',
                                        'class' => 'form-control',
                                        'readonly' => 'readonly'
                                        ]
                                    ) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="x_panel">
                <div class="x_content">
                    <div class="row">
                        <div class="form-group col-xs-4 col-lg-12">
                            {!! Form::label('data', __('views.admin.venda.data'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                {!! Form::date('data', $venda->data, [
                                    'class' => 'form-control',
                                    'readonly' => 'readonly',
                                    ]
                                ) !!}
                                <span class="input-group-addon" aria-hidden="true"><i
                                            class="fa fa-calendar-o"></i></span>
                            </div>
                        </div>

                        <div class="form-group col-xs-4 col-lg-12">
                            {!! Form::label('subtotal', __('views.admin.venda.subtotal'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::text('subtotal', ($venda->total + $venda->desconto), [
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
                                {!! Form::text('desconto', $venda->desconto, [
                                    'id' => 'desconto',
                                    'class' => 'form-control money',
                                    'readonly' => 'readonly'
                                    ]
                                ) !!}
                            </div>
                        </div>

                        <div class="form-group col-xs-4 col-lg-12">
                            {!! Form::label('total', __('views.admin.venda.total'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">R$</span>
                                {!! Form::text('total', $venda->total, [
                                    'id' => 'total',
                                    'class' => 'form-control money',
                                    'readonly' => 'readonly'
                                    ]
                                ) !!}
                            </div>
                        </div>

                        @foreach($recebimentos as $recebimento)

                            <div class="form-group col-xs-4 col-lg-12">
                                <hr/>
                                {!! Form::label('forma_id', __('views.admin.venda.forma'), ['class' => 'control-label']) !!}
                                {!! Form::text('forma_id', $recebimento->forma->nome, [
                                        'class' => 'form-control',
                                        'readonly' => 'readonly'
                                        ]
                                    ) !!}
                            </div>

                            <div class="form-group col-xs-4 col-lg-12">
                                <hr class="hidden-lg"/>
                                {!! Form::label('total', __('views.admin.venda.total'), ['class' => 'control-label']) !!}
                                <div class="input-group">
                                    <span class="input-group-addon">R$</span>
                                    {!! Form::tel('total', $recebimento->total, [
                                        'class' => 'form-control money',
                                        'readonly' => 'readonly'
                                        ]
                                    ) !!}
                                </div>
                            </div>

                        @endforeach
                    </div>

                    <div class="row">
                        <hr/>
                        {!! Form::open(['id' => 'form-delete', 'method'=>'DELETE', 'action'=> ['Admin\VendasController@destroy', $venda->id]]) !!}
                        <div class="col-xs-6">
                            {!! link_to(route('operacional.venda.index'), __('views.admin.button.back'), ['class' => 'btn btn-primary col-xs-12']) !!}
                        </div>
                        <div class="col-xs-6">
                            {!! Form::submit(__('views.admin.button.cancel'), ['class' => 'btn btn-danger col-xs-12']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>

            </div>
        </div>

    </div>
@stop

@push('page-scripts')
    @include('admin.modulos.operacional.venda.scripts.app')
@endpush