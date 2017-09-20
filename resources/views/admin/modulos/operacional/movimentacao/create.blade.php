@extends('admin.layouts.admin')

@section('title', __('views.admin.movimento.title'))

@section('title-left')
    <i class='fa fa-exchange fa-fw'></i> {!! __('views.admin.movimento.title') !!}
@endsection

@section('title-right')
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
                    {!! Form::open(['method'=>'POST', 'action'=> 'Admin\MovimentosController@store', 'data-parsley-validate']) !!}

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-2">
                            {!! Form::label('data', __('views.admin.movimento.data'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                {!! Form::date('data', null, [
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

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6">
                            {!! Form::label('fluxo', __('views.admin.movimento.fluxo'), ['class' => 'control-label']) !!}
                            <br/>

                            <label class="radio-inline">
                                {!!  Form::radio('fluxo', '1', true); !!}
                                Entrada
                            </label>
                            <label class="radio-inline">
                                {!!  Form::radio('fluxo', '2', false); !!}
                                Saída
                            </label>

                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6">
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

        <div class="col-xs-12">

            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-barcode"></i> {{__('views.admin.movimento.create.title_2')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">

                    @for ($i = 0; $i < 10; $i++)

                        <div id="{{$i}}" class="row @if($i != 0 ) hidden @endif">
                            <div class="form-group col-xs-6">
                                {!! Form::label('produto', __('views.admin.movimento.nome'), ['class' => 'control-label']) !!}
                                {!! Form::select('produto[]',
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

                            <div class="form-group col-xs-3 col-sm-2 col-lg-1">
                                {!! Form::label('quantidade', __('views.admin.movimento.quantidade'), ['class' => 'control-label']) !!}
                                {!! Form::number('quantidade[]', null, [
                                    'id' => 'quantidade',
                                    'class' => 'form-control',
                                    'data-parsley-required-message' => "",
                                    'required' => 'required',
                                    ]
                                ) !!}
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
                            {!! link_to(route('operacional.movimento.index'), __('views.admin.button.cancel'), ['class' => 'btn btn-primary col-xs-3 col-sm-2 col-lg-1']) !!}
                            {!! Form::reset(__('views.admin.button.reset'), ['class' => 'btn btn-primary col-xs-3 col-sm-2 col-lg-1']) !!}
                            {!! Form::submit(__('views.admin.button.save'), ['class' => 'btn btn-success col-xs-3 col-sm-2 col-lg-1']) !!}
                        </div>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>
    </div>
@stop

@push('page-scripts')
    @include('admin.modulos.operacional.movimentacao.scripts.app')
@endpush