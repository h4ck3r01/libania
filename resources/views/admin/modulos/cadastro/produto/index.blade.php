@extends('admin.layouts.admin')

@section('title', __('views.admin.produto.title'))

@section('title-left')
    <i class='fa fa-user fa-fw'></i> {!! __('views.admin.produto.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('cadastro.produto.create') !!}" class="btn btn-app">
        <span class="badge bg-green">!</span>
        <i class="fa fa-edit"></i> {{__('views.admin.produto.button.create')}}
    </a>
@endsection

@section('content')

    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_content">

                    <div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
                        <div class="panel">
                            <div class="panel-heading collapsed" role="tab">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <a href="#filter" data-toggle="collapse">
                                            <p class="panel-title">
                                                <i class="fa fa-filter"></i> {{__('views.admin.filtro')}}
                                            </p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="filter" class="panel-collapse collapse" role="tabpanel"
                                 aria-labelledby="filter">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="form-group col-xs-8 col-sm-4 col-lg-2">
                                            {!! Form::label('tipo', 'Tipo:', ['class' => 'control-label']) !!}
                                            {!! Form::select('tipo', [''=>__('views.admin.produto.tipo_0'),
                                                                      '1'=>__('views.admin.produto.tipo_1'),
                                                                      '2'=>__('views.admin.produto.tipo_2'),
                                                                      '3'=>__('views.admin.produto.tipo_3')
                                                                      ],
                                                      null,
                                                       ['class' => 'form-control input-sm',
                                                       'id' => 'tipo']) !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br/>

                    {!! $dataTable->table(['class' => 'table table-bordered table-striped nowrap', 'id' => 'table-produtos', 'width' => '100%']) !!}
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-scripts')
    {!! $dataTable->scripts() !!}
@endpush