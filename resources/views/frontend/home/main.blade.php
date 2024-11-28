@extends('frontend.layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('template/frontend') }}/css/costume.css">
@endpush
@section('content')
    @foreach (['home-slider', 'flash-sale', 'popular-category', 'banner-1', 'new-arrivals', 'banner-2', 'new-product', 'blog', 'feature-brand', 'today-deals', 'feature'] as $section)
        @include("frontend.home.$section")
    @endforeach
@endsection
