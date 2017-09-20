@extends('admin.layouts.admin')

@section('title', __('views.admin.movimento.title'))

@section('title-left')
    <i class='fa fa-exchange fa-fw'></i> {!! __('views.admin.movimento.title') !!}
@endsection

@section('title-right')
    <a href="{!! route('operacional.movimento.create') !!}" class="btn btn-app">
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

                    <div class="table-responsive">

                        {!! $dataTable->table(['class' => 'table table-bordered table-striped nowrap', 'id' => 'table-movimentos', 'width' => '100%']) !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-scripts')
    {!! $dataTable->scripts() !!}
@endpush