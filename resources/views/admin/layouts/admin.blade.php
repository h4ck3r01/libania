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

            <div class="right_col" role="main">
                <div class="page-title">
                    <div class="title_left">
                        <h1>@yield('title-left')</h1>
                        <hr/>
                    </div>
                    <div class="title_right text-right">
                        @yield('title-right')
                    </div>
                </div>
                @yield('content')
            </div>

            <footer>
                @include('admin.sections.footer')
            </footer>
        </div>
    </div>
@stop

@push('styles')
    {{ Html::style(mix('assets/admin/css/admin.css')) }}
@endpush

@push('scripts')
    {{ Html::script(mix('assets/admin/js/admin.js')) }}
@endpush