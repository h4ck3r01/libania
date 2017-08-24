@extends('admin.layouts.admin')

@section('title', __('views.admin.pessoa.title'))

@section('title-left')
    <i class='fa fa-user fa-fw'></i> {!! __('views.admin.pessoa.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('cadastro.pessoa.index') !!}" class="btn btn-app">
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
                    <h2><i class="fa fa-edit"></i> {{__('views.admin.pessoa.create.title')}}</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    {!! Form::open(['method'=>'POST', 'action'=> 'Admin\PessoasController@store', 'data-parsley-validate']) !!}
                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-lg-4">
                            {!! Form::label('nome', __('views.admin.pessoa.nome'), ['class' => 'control-label']) !!}
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
                            {!! Form::label('telefone', __('views.admin.pessoa.telefone'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                {!! Form::text('telefone', null, [
                                    'class' => 'form-control telefone',
                                    'minlength' => 13,
                                    'data-parsley-minlength-message' => 'Digite um telefone válido',
                                    'data-parsley-errors-container' => "#telefone-errors",
                                    'required' => 'required'
                                    ]
                                ) !!}
                                <span class="input-group-addon" aria-hidden="true"><i class="fa fa-phone"></i></span>
                            </div>
                            <div id="telefone-errors"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-12 col-sm-6 col-lg-4">
                            {!! Form::label('email', __('views.admin.pessoa.email'), ['class' => 'control-label']) !!}
                            <div class="input-group">
                                {!! Form::email('email', null, [
                                    'class' => 'form-control',
                                    'data-parsley-trigger' => 'change',
                                    'data-parsley-errors-container' => "#email-errors"
                                    ]
                                ) !!}
                                <span class="input-group-addon" aria-hidden="true"><i class="fa fa-envelope"></i></span>
                            </div>
                            <div id="email-errors"></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-xs-8 col-sm-4 col-lg-2">
                            <div class="form-group">
                                {!! Form::label('tipo_id', __('views.admin.pessoa.tipo'), ['class' => 'control-label']) !!}
                                {!! Form::select('tipo_id',
                                    [
                                        ''  =>  __('views.admin.pessoa.tipo_0'),
                                    ] + $tipos,
                                    null,
                                    [
                                        'class' => 'form-control',
                                        'required' => 'required'
                                    ]
                                ) !!}
                            </div>

                        </div>
                    </div>

                    <hr/>

                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                {!! link_to(route('cadastro.pessoa.index'), __('views.admin.button.cancel'), ['class' => 'btn btn-primary col-xs-5 col-sm-2 col-lg-1']) !!}
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
    @include('admin.modulos.cadastro.pessoa.scripts.create')
@endpush