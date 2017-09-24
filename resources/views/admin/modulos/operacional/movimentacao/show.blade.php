@extends('admin.layouts.admin')

@section('title', __('views.admin.movimento.title'))

@section('title-left')
    <i class='fa fa-line-chart fa-fw'></i> {!! __('views.admin.movimento.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('operacional.movimento.create') !!}" class="btn btn-app">
        <span class="badge bg-green">!</span>
        <i class="fa fa-edit"></i> {{__('views.admin.button.create')}}
    </a>
    <a href="{!! route('operacional.movimento.index') !!}" class="btn btn-app">
        <span class="badge bg-blue">!</span>
        <i class="fa fa-search"></i> {{__('views.admin.button.index')}}
    </a>
@endsection

@section('content')

    <div class="clearfix"></div>
    <div class="row">
        <div class="col-xs-12">
            @include('admin.messages.form')
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-edit"></i> {{__('views.admin.movimento.create.title_1')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-2">
                            {!! Form::label('data', __('views.admin.movimento.data'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                {!! Form::date('data', $movimento->data, [
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
                        <div class="form-group col-xs-12 col-sm-6">
                            {!! Form::label('fluxo', __('views.admin.movimento.fluxo'), ['class' => 'control-label']) !!}
                            {!! Form::text('fluxo', $movimento->fluxo, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6">
                            <div class="form-group">
                                {!! Form::label('obs', 'Obs:', ['class' => 'control-label']) !!}
                                {!! Form::textarea('obs', $movimento->obs, [
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

        <div class="col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-barcode"></i> {{__('views.admin.movimento.create.title_2')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @foreach($movimento->produtos as $key => $produto)
                        <div class="row">

                            @if($key != 0)
                                <hr/>
                            @endif

                            <div class="form-group col-xs-6">
                                {!! Form::label('produto', __('views.admin.movimento.nome'), ['class' => 'control-label']) !!}
                                {!! Form::text('produto[]', $produto->produto->nome, ['class' => 'form-control', 'disabled' => 'disabled']) !!}
                            </div>

                            <div class="form-group col-xs-3 col-sm-2 col-lg-1">
                                {!! Form::label('quantidade', __('views.admin.movimento.quantidade'), ['class' => 'control-label']) !!}
                                {!! Form::text('quantidade[]', $produto->quantidade, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
                            </div>

                        </div>
                    @endforeach

                    <hr/>

                    <div class="row">
                        {!! Form::open(['id' => 'form-delete', 'method'=>'DELETE', 'action'=> ['Admin\MovimentosController@destroy', $movimento->id]]) !!}
                        <div class="col-xs-3 col-sm-2 col-lg-1">
                            {!! link_to(route('operacional.movimento.index'), __('views.admin.button.back'), ['class' => 'btn btn-primary col-xs-12']) !!}
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
    @include('admin.modulos.operacional.movimentacao.scripts.app')
@endpush