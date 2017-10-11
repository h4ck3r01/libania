@extends('admin.layouts.admin')

@section('title', __('views.admin.fiado.title'))

@section('title-left')
    <i class='fa fa-ticket fa-fw'></i> {!! __('views.admin.fiado.title') !!}
@endsection

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="x_panel">
                <div class="x_content">
                    @include('admin.messages.form')

                    <div class="table-responsive">

                        {!! $dataTable->table(['class' => 'table table-bordered table-striped nowrap', 'id' => 'table-fiado', 'width' => '100%']) !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('page-scripts')
    {!! $dataTable->scripts() !!}
@endpush