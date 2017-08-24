@extends('admin.layouts.admin')

@section('title', __('views.admin.produto.title'))

@section('title-left')
    <i class='fa fa-user fa-fw'></i> {!! __('views.admin.produto.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('cadastro.produto.index') !!}" class="btn btn-app">
        <span class="badge bg-green">!</span>
        <i class="fa fa-search"></i> {{__('views.admin.button.index')}}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            @include('admin.messages.form')
            <div class="x_panel">
                <div class="x_title">
                    <h2><i class="fa fa-edit"></i> {{__('views.admin.produto.create.title')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open(['method'=>'POST', 'action'=> 'Admin\ProdutosController@store', 'data-parsley-validate']) !!}

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-lg-4">
                            {!! Form::label('nome', __('views.admin.produto.nome'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                {!! Form::text('nome', null, [
                                    'class' => 'form-control',
                                    'data-parsley-errors-container' => "#nome-errors",
                                    'required' => 'required',
                                    ]
                                ) !!}
                                <span class="input-group-addon" aria-hidden="true"><i class="fa fa-user"></i></span>
                            </div>
                            <div id="nome-errors"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-8 col-sm-4 col-lg-2">
                            {!! Form::label('categoria_id', __('views.admin.produto.categoria'), ['class' => 'control-label']) !!}
                            {!! Form::select('categoria_id',
                                [
                                    ''  =>  __('views.admin.produto.categoria_0'),
                                ] + $categorias,
                                null,
                                [
                                    'class' => 'form-control select2',
                                    'required' => 'required'
                                ]
                            ) !!}
                        </div>
                    </div>

                    <hr/>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! link_to(route('cadastro.produto.index'), __('views.admin.button.cancel'), ['class' => 'btn btn-primary col-xs-5 col-sm-2 col-lg-1']) !!}
                                {!! Form::reset(__('views.admin.button.reset'), ['class' => 'btn btn-primary col-xs-5 col-sm-2 col-lg-1']) !!}
                                {!! Form::submit(__('views.admin.button.save'), ['class' => 'btn btn-success col-xs-5 col-sm-2 col-lg-1']) !!}
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@stop

@push('page-scripts')
    @include('admin.modulos.cadastro.produto.scripts.create')
@endpush