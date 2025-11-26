@extends('frontend::layouts.master')

@section('content')
    <x-frontend.learn-about-section />
    <x-frontend.services-section :services="$services" :categories="$categories" />
    <x-frontend.gift-section />
    <x-frontend.premium-packages-section :packages="$packages" />
    <x-frontend.product-section :products="$products" />
    <x-frontend.slider />
    <style>
    .ellipse-1092 {
        height: 789px !important;
        left: 0;
        position: absolute;
        top: -242px !important;
        width: 100%;
    }
    </style>
    <x-frontend.discount />
@endsection
