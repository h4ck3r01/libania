@extends('layouts.app')

@section('body_class','nav-md')

@section('page')
    <div class="container body">
        <div class="main_container">
            @section('header')
                @include('admin.sections.navigation')
                @include('admin.sections.header')
            @show

            @yield('left-sidebar')

            <div class="content">
                <div class="right_col" role="main">
                    <div class="page-title">
                        <div class="title_left">
                            <h3>@yield('title-left')</h3>
                        </div>
                        <div class="title_right text-right">
                            @yield('title-right')
                        </div>
                    </div>
                    @yield('content')
                </div>
            </div>

            <footer>
                @include('admin.sections.footer')
            </footer>
        </div>
    </div>
@stop

@push('styles')
    {{ Html::style(mix('assets/admin/css/admin.css')) }}

    @stack('page-styles')
@endpush

@push('scripts')
    {{ Html::script(mix('assets/admin/js/admin.js')) }}

    @stack('page-scripts')
@endpush