@extends('layouts.app')

@section('page')

    {{--Region Content--}}
    @yield('content')

@endsection

@push('styles')
    {{ Html::style(mix('assets/auth/css/auth.css')) }}
@endpush