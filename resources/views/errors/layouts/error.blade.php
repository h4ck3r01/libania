@extends('layouts.app')

@section('body_class','nav-md')

@section('page')
    <div class="container body">
        <div class="main_container">
            <!-- page content -->
            <div class="col-md-12">
                <div class="col-middle">
                    <div class="text-center text-center">
                        @yield('content')
                    </div>
                </div>
            </div>
            <!-- /page content -->
        </div>
    </div>
@endsection

@push('styles')
    {{ Html::style(mix('assets/admin/css/admin.css')) }}
@endpush

@push('scripts')
    {{ Html::script(mix('assets/admin/js/admin.js')) }}
@endpush