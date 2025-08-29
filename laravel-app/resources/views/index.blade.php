@extends('layout.layout')

@section('content')



    <!-- Hero Area -->
    <div id="home-1" class="homepage-slides owl-carousel">
        @php
            $sliders = \App\Models\Slider::active()->ordered()->get();
        @endphp

        @foreach($sliders as $slider)
            <div class="single-slide-item d-flex align-items-center" data-background="{{ asset($slider->background_image) }}">
                @if($slider->overlay_type !== 'none')
                    <div class="{{ $slider->overlay_type }}"></div>
                @endif
                <div class="hero-area-content">
                    <div class="container">
                        <div class="row align-items-center">
                            <div class="col-xl-12 col-lg-12 col-md-10 wow fadeInUp animated" data-wow-delay=".2s">
                                <div class="section-title">
                                    @if($slider->subtitle)
                                        <h6 class="text-white">{{ $slider->subtitle }}</h6>
                                    @endif
                                    <h1 class="text-white">{!! $slider->title !!}</h1>
                                </div>
                                @if($slider->description)
                                    <p class="text-white">{!! $slider->description !!}</p>
                                @endif
                                @if($slider->button_text && $slider->button_url)
                                    <a href="{{ $slider->button_url }}" class="white-btn mt-40" target="{{ $slider->button_target }}">
                                        {{ $slider->button_text }} <i class="fa-light fa-arrow-right"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Off-canvas Area-->
    <div class="extra-info">
        <div class="close-icon menu-close">
            <button>
                <i class="las la-times"></i>
            </button>
        </div>
        <div class="logo-side">
            <div class="logo">
                <a href="index.html"><img src="assets/img/logo-white.png" alt=""></a>
            </div>
        </div>
        <div class="side-info">
            <div class="contact-list mb-40">
                <p>Welcome to Florix, A Full Service of Flooring and Tilling Works. </p>
                <img src="assets/img/off-canvas.jpg" alt="">

                <div class="mt-30 mb-30">
                    <a href="contact.html" class="white-btn">Get In Touch</a>
                </div>
            </div>
            <div class="social-area-wrap">
                <a href="#"><i class="lab la-facebook-f"></i></a>
                <a href="#"><i class="lab la-instagram"></i></a>
                <a href="#"><i class="lab la-linkedin-in"></i></a>
                <a href="#"><i class="lab la-skype"></i></a>
            </div>
        </div>
    </div>

    <div class="offcanvas-overlay"></div>





<div id="service-1" class="service-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6 col-md-7">
                    <div class="section-title">
                        <h2 class="visible-slowly-right">Flooring Installation for <br> Homes and Businesses</h2>
                        <p class="pt-20 wow fadeInUp animated" data-wow-delay=".4s">We provide professional flooring installation, repair, refinishing, maintenance, and custom design services for homes and businesses.</p>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-5 text-md-end">
                    <a href="services.html" class="bordered-btn">View All Services <i class="fa-light fa-arrow-right"></i></a>
                </div>
            </div>
            <div class="row service-wrapper">

                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInLeft animated" data-wow-delay="200ms">
                    <div class="single-service-item">
                        <img src="assets/img/service/1.jpg" alt="">
                        <div class="service-info-wrap">
                            <div class="service-info-inner">
                                <span>Premium Flooring</span>
                                <h5>Flooring <br> Installation</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-3 col-md-6 mt-50 wow fadeInLeft animated" data-wow-delay="400ms">
                    <div class="single-service-item">
                        <img src="assets/img/service/2.jpg" alt="">
                        <div class="service-info-wrap">
                            <div class="service-info-inner">
                                <span>Stylish Surface</span>
                                <h5>Tiling <br> Installation</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInLeft animated" data-wow-delay="600ms">
                    <div class="single-service-item">
                        <img src="assets/img/service/3.jpg" alt="">
                        <div class="service-info-wrap">
                            <div class="service-info-inner">
                                <span>Durable Design</span>
                                <h5>Floor <br> Repair</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 mt-50 wow fadeInLeft animated" data-wow-delay="800ms">
                    <div class="single-service-item">
                        <img src="assets/img/service/4.jpg" alt="">
                        <div class="service-info-wrap">
                            <div class="service-info-inner">
                                <span>Interior Design</span>
                                <h5>Floor <br> Refinishing</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
     </div>

             <!-- Process Section -->
        <div id="process-1" class="process-section section-padding pt-0 pb-0">

            <div class="row mt-30 process-bg-wrap align-items-center justify-content-center" data-background="assets/img/process-bg.jpg">
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInLeft animated" data-wow-delay="200ms">
                    <div class="single-process-item">
                        <div class="process-icon">
                            <img src="assets/img/process/1.png" alt="">
                            <span class="step-count">1.</span>
                            <div class="process-line d-none d-md-inline-block"></div>
                        </div>
                        <div class="process-title">
                            <h5>Consultation & meeting</h5>
                        </div>
                        <div class="process-content">
                            <p>The architecture company meets with the client to discuss their needs, budget, and timeline.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInLeft animated" data-wow-delay="400ms">
                    <div class="single-process-item">
                        <div class="process-icon">
                            <img src="assets/img/process/2.png" alt="">
                            <span class="step-count">2.</span>
                            <div class="process-line d-none d-lg-inline-block"></div>
                        </div>
                        <div class="process-title">
                            <h5>Concept design</h5>
                        </div>
                        <div class="process-content">
                            <p>Based on the client's requirements, the architecture company creates a concept design.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInLeft animated" data-wow-delay="600ms">
                    <div class="single-process-item">
                        <div class="process-icon">
                            <img src="assets/img/process/3.png" alt="">
                            <span class="step-count">3.</span>
                            <div class="process-line d-none d-md-inline-block"></div>
                        </div>
                        <div class="process-title">
                            <h5>Design development</h5>
                        </div>
                        <div class="process-content">
                            <p>The architecture company meets with the client to discuss their needs, budget, and timeline.</p>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInLeft animated" data-wow-delay="800ms">
                    <div class="single-process-item">
                        <div class="process-icon">
                            <img src="assets/img/process/4.png" alt="">
                            <span class="step-count">4.</span>
                        </div>
                        <div class="process-title">
                            <h5>Permitting & approvals</h5>
                        </div>
                        <div class="process-content">
                            <p>The architecture company meets with the client to discuss their needs, budget, and timeline.</p>
                        </div>
                    </div>
                </div>
            </div>
     </div>

    <!-- Gallery Section -->
     <div class="gallery-section gray-bg section-padding">
        <div class="container">
            <div class="row gy-4">
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft animated" data-wow-delay="200ms">
                    <a href="assets/img/gallery/1.jpg" data-fancybox="gallery">
                        <img src="assets/img/gallery/1.jpg" alt="">
                    </a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft animated" data-wow-delay="400ms">
                    <a href="assets/img/gallery/2.jpg" data-fancybox="gallery">
                        <img src="assets/img/gallery/2.jpg" alt="">
                    </a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft animated" data-wow-delay="600ms">
                    <a href="assets/img/gallery/3.jpg" data-fancybox="gallery">
                        <img src="assets/img/gallery/3.jpg" alt="">
                    </a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft animated" data-wow-delay="200ms">
                    <a href="assets/img/gallery/4.jpg" data-fancybox="gallery">
                        <img src="assets/img/gallery/4.jpg" alt="">
                    </a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft animated" data-wow-delay="400ms">
                    <a href="assets/img/gallery/5.jpg" data-fancybox="gallery">
                        <img src="assets/img/gallery/5.jpg" alt="">
                    </a>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-6 wow fadeInLeft animated" data-wow-delay="600ms">
                    <a href="assets/img/gallery/6.jpg" data-fancybox="gallery">
                        <img src="assets/img/gallery/6.jpg" alt="">
                    </a>
                </div>
            </div>
        </div>
     </div>




    <!-- Footer Section -->


    @endsection
