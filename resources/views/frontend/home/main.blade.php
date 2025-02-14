@extends('frontend.layouts.master')
@push('styles')
    <link rel="stylesheet" href="{{ asset('template/frontend') }}/css/costume.css">
@endpush
@section('content')
    @foreach (['home-slider', 'flash-sale', 'popular-category', 'banner-1', 'new-arrivals', 'banner-2', 'new-product', 'blog', 'feature-brand', 'today-deals', 'feature'] as $section)
        @include("frontend.home.$section")
    @endforeach
@endsection
@push('page-scripts')
    <script>
        $(document).ready(function() {
            // Ambil URL menggunakan Laravel route helper
            let appearance = "{{ route('appearance.getAppearance') }}";

            $.get(appearance, function(colors) {
                // Terapkan warna ke CSS variables
                document.documentElement.style.setProperty('--primary-color', colors.data.color_base);
                document.documentElement.style.setProperty('--secondary-color', colors.data.color_sec);
                document.documentElement.style.setProperty('--hover-primary-color', colors.data
                    .hover_base);
                document.documentElement.style.setProperty('--hover-secondary-color', colors.data
                    .hover_sec);

            });
        });
    </script>
@endpush
