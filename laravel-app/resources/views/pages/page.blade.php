@extends('layout.layout')

@section('content')


    <!-- Breadcrumb Area  -->
    <div class="breadcrumb-area about">
        <div class="overlay-5"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 text-center">
                    <div class="breadcrumb-title">
                        <h1>About Us</h1>
                    </div>
                    <div class="breadcrumb-icon">
                        <i class="las la-angle-down"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="about-page" class="about-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-7 col-lg-7 order-2 order-md-1">
                    <div class="about-content-wrap">
                        {!! $pages->content !!}
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 order-1 order-md-2">
                    <div class="about-img-wrap">
                        <img src="{{ asset($pages->featured_image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
