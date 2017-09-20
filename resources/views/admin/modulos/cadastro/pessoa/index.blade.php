@extends('admin.layouts.admin')

@section('title', __('views.admin.pessoa.title'))

@section('title-left')
    <i class='fa fa-user fa-fw'></i> {!! __('views.admin.pessoa.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('cadastro.pessoa.create') !!}" class="btn btn-app">
        <span class="badge bg-green">!</span>
        <i class="fa fa-edit"></i> {{__('views.admin.button.create')}}
    </a>
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    @include('admin.messages.form')
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
                                            {!! Form::select('tipo', [''=> __('views.admin.select.default')] + $tipos,
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

                    <div class="table-responsive">

                        {!! $dataTable->table(['class' => 'table table-bordered table-striped nowrap', 'id' => 'table-pessoas', 'width' => '100%']) !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-scripts')
    {!! $dataTable->scripts() !!}
@endpush