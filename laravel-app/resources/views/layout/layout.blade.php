<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Home-1 | Florix | Flooring & Tiling Services HTML Template</title>

    <!--Favicon-->
    <link rel="icon" href="{{ asset('assets/img/favicon.png') }}" type="image/png">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Line Awesome CSS -->
    <link href="{{ asset('assets/css/line-awesome.min.css') }}" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="{{ asset('assets/css/fontAwesomePro.css') }}" rel="stylesheet">
    <!-- Animate CSS-->
    <link href="{{ asset('assets/css/animate.css') }}" rel="stylesheet">
    <!-- Bar Filler CSS -->
    <link href="{{ asset('assets/css/barfiller.css') }}" rel="stylesheet">
    <!-- Magnific Popup Video -->
    <link href="{{ asset('assets/css/magnific-popup.css') }}" rel="stylesheet">
    <!-- Flaticon CSS -->
    <link href="{{ asset('assets/css/flaticon.css') }}" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link href="{{ asset('assets/css/owl.carousel.css') }}" rel="stylesheet">
    <!-- Slick Slider CSS -->
    <link href="{{ asset('assets/css/slick.css') }}" rel="stylesheet">
    <!-- Nice Select  -->
    <link href="{{ asset('assets/css/nice-select.css') }}" rel="stylesheet">
    <!-- Back to Top -->
    <link href="{{ asset('assets/css/backToTop.css') }}" rel="stylesheet">
    <!-- Metis Menu -->
    <link href="{{ asset('assets/css/metismenu.css') }}" rel="stylesheet">
    <!-- Odometer CSS -->
    <link href="{{ asset('assets/css/odometer.min.css') }}" rel="stylesheet">
    <!-- FancyBox CSS -->
    <link href="{{ asset('assets/css/fancy-box.min.css') }}" rel="stylesheet">
    <!-- Style CSS -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>

<body>

    <!-- Pre-Loader -->
    <div id="loader"></div>

    <!-- Mouse Cursor  -->
    <div class="mouseCursor cursor-outer"></div>
    <div class="mouseCursor cursor-inner"><span>Drag</span></div>

    <!-- Header Area  -->
    <div id="header-1" class="header-area absolute-header">
        <div id="header-sticky">
            <div class="navigation">
                <div class="container-fluid">
                    <div class="header-inner-box">

                        <!-- Main Menu  -->
                        <div class="main-menu d-none d-lg-block">
                            <ul>
                                <li>
                                    <a href="{{ route('index') }}"><i class="fa-light fa-house"></i> Anasayfa</a>
                                </li>
                                @php
                                    // Menü verilerini hiyerarşik yapıya dönüştür
                                    $menuItems = \App\Models\MenuItem::where('menu_id', 1)
                                        ->where('is_active', true)
                                        ->orderBy('order')
                                        ->get();

                                    $parentItems = $menuItems->whereNull('parent_id');
                                    $childItems = $menuItems->whereNotNull('parent_id');
                                @endphp

                                @foreach($parentItems as $parentItem)
                                    @php
                                        $children = $childItems->where('parent_id', $parentItem->id);
                                        $hasChildren = $children->count() > 0;
                                        $url = $parentItem->type === 'page' && $parentItem->page ? '/pages/' . $parentItem->page->slug : $parentItem->url;
                                    @endphp

                                    <li class="{{ $hasChildren ? 'has-dropdown' : '' }}">
                                        <a class="navlink" href="{{ $url }}" target="{{ $parentItem->target }}">
                                            {{ $parentItem->title }}
                                        </a>

                                        @if($hasChildren)
                                            <ul class="sub-menu">
                                                @foreach($children as $childItem)
                                                    @php
                                                        $childUrl = $childItem->type === 'page' && $childItem->page ? '/pages/' . $childItem->page->slug : $childItem->url;
                                                    @endphp
                                                    <li>
                                                        <a href="{{ $childUrl }}" target="{{ $childItem->target }}">
                                                            {{ $childItem->title }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Logo -->
                        <div class="logo">
                            <a class="navbar-brand" href="index.html"><img src="assets/img/logo-white.png" alt=""></a>
                        </div>

                        <div class="header-right">

                            <!-- Search Button  -->
                            <div class="search-trigger">
                                <i class="fal fa-search"></i>
                            </div>
                            <div class="contact-number d-none">
                                <div class="icon"><i class="las la-phone-volume"></i></div>
                                <div class="title"><h4>1 800 458 56 97</h4></div>
                            </div>
                            <!-- Header Button -->
                            <!-- <a href="quote.html" class="theme-btn d-none d-lg-inline-block">Request a Quote</a> -->
                            <div class="header-btn">
                                <div class="menu-trigger">
                                    <span class="lines"></span>
                                    <span class="lines"></span>
                                    <span class="lines"></span>
                                </div>
                            </div>

                        </div>

                        <!-- Mobile Menu -->
                        <div class="mobile-nav-bar d-block col-sm-1 col-6 d-lg-none">
                            <div class="mobile-nav-wrap">
                                <div id="hamburger">
                                    <i class="las la-bars"></i>
                                </div>
                                <!-- mobile menu - responsive menu  -->
                                <div class="mobile-nav">
                                    <button type="button" class="close-nav">
                                        <i class="las la-times-circle"></i>
                                    </button>
                                    <nav class="sidebar-nav">
                                        <ul class="metismenu" id="mobile-menu">
                                            @php
                                                // Mobile menü için aynı verileri kullan
                                                $mobileMenuItems = \App\Models\MenuItem::where('menu_id', 1)
                                                    ->where('is_active', true)
                                                    ->orderBy('order')
                                                    ->get();

                                                $mobileParentItems = $mobileMenuItems->whereNull('parent_id');
                                                $mobileChildItems = $mobileMenuItems->whereNotNull('parent_id');
                                            @endphp

                                            @foreach($mobileParentItems as $parentItem)
                                                @php
                                                    $children = $mobileChildItems->where('parent_id', $parentItem->id);
                                                    $hasChildren = $children->count() > 0;
                                                    $url = $parentItem->type === 'page' && $parentItem->page ? '/pages/' . $parentItem->page->slug : $parentItem->url;
                                                @endphp

                                                <li>
                                                    <a class="{{ $hasChildren ? 'has-arrow' : '' }}" href="{{ $url }}" target="{{ $parentItem->target }}">
                                                        {{ $parentItem->title }}
                                                    </a>

                                                    @if($hasChildren)
                                                        <ul class="sub-menu">
                                                            @foreach($children as $childItem)
                                                                                                                            @php
                                                                $childUrl = $childItem->type === 'page' && $childItem->page ? '/pages/' . $childItem->page->slug : $childItem->url;
                                                            @endphp
                                                                <li>
                                                                    <a href="{{ $childUrl }}" target="{{ $childItem->target }}">
                                                                        {{ $childItem->title }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        </ul>
                                    </nav>
                                    <div class="action-bar">
                                        <a href="mailto:info@roofix.com"><i class="las la-envelope"></i>info@florix.com</a>
                                        <a href="tel:123-456-7890"><i class="fal fa-phone"></i>123-456-7890</a>
                                        <a href="contact.html" class="theme-btn">Contact Us</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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



    @yield('content')

     <div class="footer-section pt-80" data-background="{{ asset('assets/img/footer-bg.jpg') }}">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div class="footer-content-wrap">
                        <div class="section-title">
                            <h2 class="text-white visible-slowly-right">
                            Transform Your Space</h2>
                        </div>
                        <hr>
                        <p class="text-white wow fadeInUp animated" data-wow-delay="400ms">You're invited to explore our innovative flooring solutions, featuring durable, water-resistant vinyl planks and engineered wood, perfect for enhancing the beauty of your space!</p>
                        <a href="contact.html" class="white-btn mt-20 wow fadeInDown animated" data-wow-delay="600ms">Let's Talk <i class="fa-light fa-arrow-right"></i></a>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-1"></div>
                <div class="col-xl-3 col-lg-3 col-md-5">
                    <div class="contact-info-wrap mt-40">
                        <div class="single-contact-info wow fadeInUp animated" data-wow-delay="200ms">
                            <h6 class="text-white">Phone</h6>
                            <p class="p-xl">+34 567 721 12 35</p>
                        </div>
                        <div class="single-contact-info wow fadeInUp animated" data-wow-delay="400ms">
                            <h6 class="text-white">E-mail</h6>
                            <p>info@florix.com</p>
                        </div>
                        <div class="single-contact-info wow fadeInUp animated" data-wow-delay="600ms">
                            <h6 class="text-white">Directions</h6>
                            <p>77 Kennedy Road <br>
                            Soho Manhattan <br>
                            New York - USA</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
     </div>

    <div class="footer-bottom">
        <div class="row align-items-center justify-content-center">
            <div class="site-info text-center">
                <p class="mb-0">Copyright © 2025 Florix, Inc. - All rights reserved.</p>
            </div>
        </div>
    </div>

    <!-- Search Dropdown -->
    <div class="search-popup">
        <span class="search-back-drop"></span>

        <div class="search-inner">
            <div class="container">
                <div class="logo">
                    <a class="navbar-brand" href="index.html"><img src="assets/img/logo-white.png" alt=""></a>
                </div>
                <button class="close-search"><span class="la la-times"></span></button>
                <form method="post" action="index.html">
                    <div class="form-group">
                        <input type="search" name="search-field" value="" placeholder="Type your keyword" required="">
                        <button type="submit"><i class="fal fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!-- Jquery -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <!-- Wow JS -->
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <!-- Way Points JS -->
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <!-- Pure Counter JS -->
    <script src="{{ asset('assets/js/pure-counter.js') }}"></script>
    <!-- Owl Carousel JS -->
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <!-- Slick Slider JS -->
    <script src="{{ asset('assets/js/slick.min.js') }}"></script>
    <!-- Magnific Popup JS -->
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <!-- Isotope JS -->
    <script src="{{ asset('assets/js/isotope-3.0.6-min.js') }}"></script>
    <!-- Nice Select JS -->
    <script src="{{ asset('assets/js/jquery.nice-select.min.js') }}"></script>
    <!-- Back To Top JS -->
    <script src="{{ asset('assets/js/backToTop.js') }}"></script>
    <!-- Metis Menu JS -->
    <script src="{{ asset('assets/js/metismenu.js') }}"></script>
    <!-- Progress Bar JS -->
    <script src="{{ asset('assets/js/jquery.barfiller.js') }}"></script>
    <!-- Appear JS -->
    <script src="{{ asset('assets/js/jquery.appear.min.js') }}"></script>
    <!-- Odometer JS -->
    <script src="{{ asset('assets/js/odometer.min.js') }}"></script>
    <!-- Fancybox Select JS -->
    <script src="{{ asset('assets/js/jquery-fancybox.min.js') }}"></script>
    <!-- GSAP Animation JS -->
    <script src="{{ asset('assets/js/gsap.min.js') }}"></script>
    <script src="{{ asset('assets/js/ScrollTrigger.min.js') }}"></script>
    <script src="{{ asset('assets/js/SplitText.min.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>

</body>

</html>
