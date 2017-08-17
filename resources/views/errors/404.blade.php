@extends('errors.layouts.error')

@section('content')
    <h1 class="error-number">404</h1>
    <h2>{{ __('views.errors.404.title') }}</h2>
    <p>{{ __('views.errors.404.body') }}</p>
@stop