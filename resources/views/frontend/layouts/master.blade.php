<!DOCTYPE html>
<html class="no-js" lang="en">


<!-- Mirrored from wp.alithemes.com/html/evara/evara-frontend/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2024 12:57:17 GMT -->

<head>
    <meta charset="utf-8">
    <title>Astiens Store : Toko Online Lengkap &amp; Unik Harga Murah</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta property="og:title" content="">
    <meta property="og:type" content="">
    <meta property="og:url" content="">
    <meta property="og:image" content="">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('template/frontend') }}/imgs/theme/favicon.svg">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('template/frontend') }}/css/maind134.css">
    {{-- style css costume --}}
    @stack('styles')
</head>

<body>
    <!-- Modal -->
    <div class="modal fade custom-modal" id="onloadModal" tabindex="-1" aria-labelledby="onloadModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="deal"
                        style="background-image: url('template/frontend/imgs/banner/menu-banner-7.png')">
                        <div class="deal-top">
                            <h2 class="text-brand">Deal of the Day</h2>
                            <h5>Limited quantities.</h5>
                        </div>
                        <div class="deal-content">
                            <h6 class="product-title"><a href="shop-product-right.html">Summer Collection New Morden
                                    Design</a></h6>
                            <div class="product-price"><span class="new-price">$139.00</span><span
                                    class="old-price">$160.99</span></div>
                        </div>
                        <div class="deal-bottom">
                            <p>Hurry Up! Offer End In:</p>
                            <div class="deals-countdown" data-countdown="2025/03/25 00:00:00"><span
                                    class="countdown-section"><span class="countdown-amount hover-up">03</span><span
                                        class="countdown-period"> days </span></span><span
                                    class="countdown-section"><span class="countdown-amount hover-up">02</span><span
                                        class="countdown-period"> hours </span></span><span
                                    class="countdown-section"><span class="countdown-amount hover-up">43</span><span
                                        class="countdown-period"> mins </span></span><span
                                    class="countdown-section"><span class="countdown-amount hover-up">29</span><span
                                        class="countdown-period"> sec </span></span></div>
                            <a href="shop-grid-right.html" class="btn hover-up">Shop Now <i
                                    class="fi-rs-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('frontend.layouts.header')
    <main class="main">
        <!-- Start Content-->
        @yield('content')
        <!-- container -->
    </main>
    <footer class="main">
        <section class="newsletter p-30 text-white wow fadeIn animated">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7 mb-md-3 mb-lg-0">
                        <div class="row align-items-center">
                            <div class="col flex-horizontal-center">
                                <img class="icon-email"
                                    src="{{ asset('template/frontend') }}/imgs/theme/icons/icon-email.svg"
                                    alt="">
                                <h4 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h4>
                            </div>
                            <div class="col my-4 my-md-0 des">
                                <h5 class="font-size-15 ml-4 mb-0">...and receive <strong>$25 coupon for first
                                        shopping.</strong></h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5">
                        <!-- Subscribe Form -->
                        <form class="form-subcriber d-flex wow fadeIn animated">
                            <input type="email" class="form-control bg-white font-small"
                                placeholder="Enter your email">
                            <button class="btn bg-dark text-white" type="submit">Subscribe</button>
                        </form>
                        <!-- End Subscribe Form -->
                    </div>
                </div>
            </div>
        </section>
        <section class="section-padding footer-mid">
            <div class="container pt-15 pb-20">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="widget-about font-md mb-md-5 mb-lg-0">
                            <div class="logo logo-width-1 wow fadeIn animated">
                                <a href="index-2.html"><img src="{{ asset('template/frontend') }}/imgs/theme/logo.svg"
                                        alt="logo"></a>
                            </div>
                            <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Contact</h5>
                            <p class="wow fadeIn animated">
                                <strong>Address: </strong>562 Wellington Road, Street 32, San Francisco
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Phone: </strong>+01 2222 365 /(+91) 01 2345 6789
                            </p>
                            <p class="wow fadeIn animated">
                                <strong>Hours: </strong>10:00 - 18:00, Mon - Sat
                            </p>
                            <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                            <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                                <a href="#"><img
                                        src="{{ asset('template/frontend') }}/imgs/theme/icons/icon-facebook.svg"
                                        alt=""></a>
                                <a href="#"><img
                                        src="{{ asset('template/frontend') }}/imgs/theme/icons/icon-twitter.svg"
                                        alt=""></a>
                                <a href="#"><img
                                        src="{{ asset('template/frontend') }}/imgs/theme/icons/icon-instagram.svg"
                                        alt=""></a>
                                <a href="#"><img
                                        src="{{ asset('template/frontend') }}/imgs/theme/icons/icon-pinterest.svg"
                                        alt=""></a>
                                <a href="#"><img
                                        src="{{ asset('template/frontend') }}/imgs/theme/icons/icon-youtube.svg"
                                        alt=""></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <h5 class="widget-title wow fadeIn animated">About</h5>
                        <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Delivery Information</a></li>
                            <li><a href="#">Privacy Policy</a></li>
                            <li><a href="#">Terms &amp; Conditions</a></li>
                            <li><a href="#">Contact Us</a></li>
                            <li><a href="#">Support Center</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-2  col-md-3">
                        <h5 class="widget-title wow fadeIn animated">My Account</h5>
                        <ul class="footer-list wow fadeIn animated">
                            <li><a href="#">Sign In</a></li>
                            <li><a href="#">View Cart</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            <li><a href="#">Track My Order</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Order</a></li>
                        </ul>
                    </div>
                    <div class="col-lg-4">
                        <h5 class="widget-title wow fadeIn animated">Install App</h5>
                        <div class="row">
                            <div class="col-md-8 col-lg-12">
                                <p class="wow fadeIn animated">From App Store or Google Play</p>
                                <div class="download-app wow fadeIn animated">
                                    <a href="#" class="hover-up mb-sm-4 mb-lg-0"><img class="active"
                                            src="{{ asset('template/frontend') }}/imgs/theme/app-store.jpg"
                                            alt=""></a>
                                    <a href="#" class="hover-up"><img
                                            src="{{ asset('template/frontend') }}/imgs/theme/google-play.jpg"
                                            alt=""></a>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-12 mt-md-3 mt-lg-0">
                                <p class="mb-20 wow fadeIn animated">Secured Payment Gateways</p>
                                <img class="wow fadeIn animated"
                                    src="{{ asset('template/frontend') }}/imgs/theme/payment-method.png"
                                    alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="container pb-20 wow fadeIn animated">
            <div class="row">
                <div class="col-12 mb-20">
                    <div class="footer-bottom"></div>
                </div>
                <div class="col-lg-6">
                    <p class="float-md-left font-sm text-muted mb-0">&copy; 2022, <strong
                            class="text-brand">Evara</strong> - HTML Ecommerce Template </p>
                </div>
                <div class="col-lg-6">
                    <p class="text-lg-end text-start font-sm text-muted mb-0">
                        Designed by <a href="http://alithemes.com/" target="_blank">Alithemes.com</a>. All rights
                        reserved
                    </p>
                </div>
            </div>
        </div>
    </footer>
    <!-- Preloader Start -->
    <div id="preloader-active">
        <div class="preloader d-flex align-items-center justify-content-center">
            <div class="preloader-inner position-relative">
                <div class="text-center">
                    <h5 class="mb-5">Now Loading</h5>
                    <div class="loader">
                        <div class="bar bar1"></div>
                        <div class="bar bar2"></div>
                        <div class="bar bar3"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor JS-->
    <script src="{{ asset('template/frontend') }}/js/vendor/modernizr-3.6.0.min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/vendor/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/slick.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/jquery.syotimer.min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/wow.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/jquery-ui.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/perfect-scrollbar.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/magnific-popup.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/select2.min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/waypoints.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/counterup.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/jquery.countdown.min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/images-loaded.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/isotope.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/scrollup.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/jquery.vticker-min.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/jquery.theia.sticky.js"></script>
    <script src="{{ asset('template/frontend') }}/js/plugins/jquery.elevatezoom.js"></script>
    <!-- Template  JS -->
    <script src="{{ asset('template/frontend') }}/js/maind134.js?v=3.4"></script>
    <script src="{{ asset('template/frontend') }}/js/shopd134.js?v=3.4"></script>
</body>


<!-- Mirrored from wp.alithemes.com/html/evara/evara-frontend/index-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Nov 2024 12:57:20 GMT -->

</html>
