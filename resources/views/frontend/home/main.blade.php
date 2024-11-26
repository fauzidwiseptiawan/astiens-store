@extends('frontend.layouts.master')
@push('styles')
    <style>
        /*COMPONENTS -> MISC*/
        /*Countdown*/
        .flash-countdown .countdown-section {
            position: relative;
            font-weight: 400;
            font-size: 12px;
            line-height: 1;
            padding: 20px 5px 15px 5px;
            margin-left: .8rem;
            margin-right: .8rem;
            background-color: #088178;
            border-radius: 4px;
            border: none;
            margin-bottom: 2rem;
        }

        .flash-countdown .countdown-section .countdown-amount {
            display: inline-block;
            color: #fff;
            font-weight: 500;
            font-size: 20px;
            line-height: 1;
            margin-bottom: 35px;
            width: 50px;
            height: 50px;
            line-height: 50px;
            text-align: center;
        }

        .flash-countdown .countdown-section .countdown-period {
            position: absolute;
            left: 0;
            right: 0;
            text-align: center;
            bottom: -20px;
            display: block;
            font-weight: 400;
            color: #90908e;
            text-transform: uppercase;
            width: 100%;
            padding-left: 0;
            padding-right: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .flash-countdown .countdown-section:not(:last-child)::after {
            color: #1a1a1a;
            content: ':';
            display: inline-block;
            font-weight: 400;
            font-size: 20px;
            line-height: 1;
            position: absolute;
            left: 100%;
            margin-left: 12px;
            margin-top: -1px;
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            -ms-transform: translateY(-50%);
        }

        .deal .deal-bottom .flash-countdown {
            margin-left: -12px;
            margin-bottom: 20px;
        }

        .flash-countdown .countdown-section .countdown-amount {
            width: 30px;
            height: 40px;
            line-height: 40px;
        }
    </style>
@endpush
@section('content')
    @include('frontend.home.home-slider')
    @include('frontend.home.deals')
    @include('frontend.home.flash-sale')
    @include('frontend.home.popular-category')
    @include('frontend.home.banner-1')
    @include('frontend.home.new-arrivals')
    @include('frontend.home.banner-2')
    @include('frontend.home.new-product')
    @include('frontend.home.blog')
    @include('frontend.home.feature-brand')
    @include('frontend.home.today-deals')
    @include('frontend.home.feature')
@endsection
