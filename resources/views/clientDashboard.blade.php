<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Hosting | Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.ico">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/themify-icons/0.1.2/css/themify-icons.css">

    <!-- CSS here -->
    <link rel="stylesheet" href="css/clp_bootstrap.min.css">
    <link rel="stylesheet" href="css/clp_owl.carousel.min.css">
    <link rel="stylesheet" href="css/clp_slicknav.css">
    <link rel="stylesheet" href="css/clp_flaticon.css">
    <link rel="stylesheet" href="css/clp_progressbar_barfiller.css">
    <link rel="stylesheet" href="css/clp_gijgo.css">
    <link rel="stylesheet" href="css/clp_animate.min.css">
    <link rel="stylesheet" href="css/clp_animated-headline.css">
    <link rel="stylesheet" href="css/clp_magnific-popup.css">
    <link rel="stylesheet" href="css/clp_fontawesome-all.min.css">
    <link rel="stylesheet" href="{{ asset('css/clp_themify-icons.css') }}">
    <link rel="stylesheet" href="css/clp_slick.css">
    <link rel="stylesheet" href="css/clp_style.css">
</head>
<body>
    <!-- Preloader Start -->
    <header>
        <!-- Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header ">
                <div class="header-bottom  header-sticky">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <!-- Logo -->
                            <div class="col-xl-2 col-lg-2">
                                <div class="logo">
                                    <a href="{{ route('client') }}"><img src="{{ asset('img/logo/logo.png') }}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xl-10 col-lg-10">
                                <div class="menu-wrapper d-flex align-items-center justify-content-end">
                                    <!-- Main-menu -->
                                    <div class="main-menu d-none d-lg-block">
                                        <nav>
                                            <ul id="navigation">                                                                                          
                                                <li><a href="{{ route('client') }}">Home</a></li>
                                                <li><a href="{{ route('client.portalIndex') }}">my Dashboard</a></li>
                                                <li><a href="help.html">Help</a></li>
                                                <li><a href="contact.html">Contact</a></li>
                                                <!-- Button -->
                                                <li class="button-header margin-left">
                                                    <form method="POST" action="{{ route('logout') }}">
                                                        @csrf
                                                        <button type="submit" class="btn">Log Out</button>
                                                    </form>
                                                </li>
                                                <x-logoutModule />
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div> 
                            <!-- Mobile Menu -->
                            <div class="col-12">
                                <div class="mobile_menu d-block d-lg-none"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    <main>
       <!-- Slider Area Start-->
        <div class="slider-area slider-bg ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider d-flex align-items-center slider-height ">
                    <div class="container">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-xl-5 col-lg-5 col-md-9 ">
                                <div class="hero__caption">
                                    <span data-animation="fadeInLeft" data-delay=".3s">Seamless Project & Service Management</span>
                                    <h1 data-animation="fadeInLeft" data-delay=".6s ">Effortless Client Portal</h1>
                                    <p data-animation="fadeInLeft" data-delay=".8s">Stay on top of your projects, manage your services, and submit support tickets with ease. Our portal is designed to keep you informed and in control, all from one intuitive platform.</p>
                                    <!-- Slider btn -->
                                    <div class="slider-btns">
                                        <!-- Hero-btn -->
                                        <a data-animation="fadeInLeft" data-delay="1s" href="{{ route('client.portalIndex') }}" class="btn radius-btn">Access Dashboard</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6">
                                <div class="hero__img d-none d-lg-block f-right">
                                    <img src="{{ asset('img/hero/hero_right.png') }}" alt="Hero Image" data-animation="fadeInRight" data-delay="1s">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>      
            </div>
            <!-- Slider Shape -->
            <div class="slider-shape d-none d-lg-block">
                <img class="slider-shape1" src="{{ asset('img/hero/top-left-shape.png') }}" alt="">
            </div>
        </div>
        <!-- Slider Area End -->


        <!--services -->
        <section class="team-area section-padding40 section-bg1">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-12">
                        <div class="section-tittle text-center mb-105">
                            <h2>Most amazing features</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6"">
                        <div class="single-cat">
                            <div class="cat-icon">
                                <img src="{{ asset('img/icon/services1.svg') }}" alt="">
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#">Employee Owned</a></h5>
                                <p>Supercharge your WordPress hosting with detailed website analytics, marketing tools.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat">
                            <div class="cat-icon">
                                <img src="{{ asset('img/icon/services2.svg') }}" alt="">
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#">Commitment to Security</a></h5>
                                <p>Supercharge your WordPress hosting with detailed website analytics, marketing tools.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat">
                            <div class="cat-icon">
                                <img src="{{ asset('img/icon/services3.svg') }}" alt="">
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#">Passion for Privacy</a></h5>
                                <p>Supercharge your WordPress hosting with detailed website analytics, marketing tools.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat">
                            <div class="cat-icon">
                                <img src="{{ asset('img/icon/services4.svg') }}" alt="">
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#">Employee Owned</a></h5>
                                <p>Supercharge your WordPress hosting with detailed website analytics, marketing tools.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat">
                            <div class="cat-icon">
                                <img src="{{ asset('img/icon/services5.svg') }}" alt="">
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#">24/7 Support</a></h5>
                                <p>Supercharge your WordPress hosting with detailed website analytics, marketing tools.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="single-cat">
                            <div class="cat-icon">
                                <img src="{{ asset('img/icon/services6.svg') }}" alt="">
                            </div>
                            <div class="cat-cap">
                                <h5><a href="#">100% Uptime Guaranteed</a></h5>
                                <p>Supercharge your WordPress hosting with detailed website analytics, marketing tools.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Services End -->

        <!--? About-2 Area Start -->
        <div class="about-area1 pb-bottom">
            <div class="container">
                <div class="row align-items-center justify-content-between">
                    <div class="col-xl-7 col-lg-7 col-md-12">
                        <div class="about-caption about-caption3 mb-50">
                            <!-- Section Tittle -->
                            <div class="section-tittle section-tittle2 mb-30">
                                <h2>Dedicated support</h2>
                            </div>
                            <p class="mb-40">Supercharge your WordPress hosting with detailed website analytics, marketing tools. Our experts are just part of the reason Bluehost is the ideal home for your WordPress website. We're here to help you succeed!</p>
                            <ul class="mb-30">
                                <li>
                                    <img src="{{ asset('img/icon/right.svg') }}" alt="">
                                    <p>WordPress hosting with detailed website</p>
                                </li>
                                <li>
                                    <img src="{{ asset('img/icon/right.svg') }}" alt="">
                                    <p>Our experts are just part of the reason</p>
                                </li>
                            </ul>
                            <a href="#" class="btn"><i class="fas fa-phone-alt"></i>(10) 892-293 2678</a>
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5 col-md-8 col-sm-10">
                        <!-- about-img -->
                        <div class="about-img ">
                            <img src="{{ asset('img/gallery/about2.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- About-2 Area End -->
        <!-- ask questions -->
        <section class="ask-questions section-bg1 section-padding30 fix">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-lg-9 col-md-10 ">
                        <!-- Section Tittle -->
                        <div class="section-tittle text-center mb-90">
                            <h2>Frequently ask questions</h2>
                            <p>Supercharge your WordPress hosting with detailed website analytics, marketing tools. Our experts are just part of the reason Bluehost is the ideal home for your WordPress website. We're here to help you succeed!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single-question d-flex mb-50">
                            <span> Q.</span>
                            <div class="pera">
                                <h2>Why can't people connect to the web server on my PC?</h2>
                                <p>We operate one of the most advanced 100 Gbit networks in the world, complete with Anycast support and extensive DDoS protection.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-question d-flex mb-50">
                            <span> Q.</span>
                            <div class="pera">
                                <h2>What domain name should I choose for my site?</h2>
                                <p>We operate one of the most advanced 100 Gbit networks in the world, complete with Anycast support and extensive DDoS protection.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-question d-flex mb-50">
                            <span> Q.</span>
                            <div class="pera">
                                <h2>How can I make my website work without www. in front?</h2>
                                <p>We operate one of the most advanced 100 Gbit networks in the world, complete with Anycast support and extensive DDoS protection.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single-question d-flex mb-50">
                            <span> Q.</span>
                            <div class="pera">
                                <h2>Why does Internet Information Server want a password?</h2>
                                <p>We operate one of the most advanced 100 Gbit networks in the world, complete with Anycast support and extensive DDoS protection.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-12 ">
                        <div class="more-btn text-center mt-20">
                            <a href="#" class="btn">Go to Support</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      <!-- End ask questions -->
    </main>

    <!-- JS here -->

    <script src="./assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="./assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="./assets/js/popper.min.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="./assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="./assets/js/owl.carousel.min.js"></script>
    <script src="./assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="./assets/js/wow.min.js"></script>
    <script src="./assets/js/animated.headline.js"></script>
    <script src="./assets/js/jquery.magnific-popup.js"></script>

    <!-- contact js -->
    <script src="./assets/js/contact.js"></script>
    <script src="./assets/js/jquery.form.js"></script>
    <script src="./assets/js/jquery.validate.min.js"></script>
    <script src="./assets/js/mail-script.js"></script>
    <script src="./assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->	
    <script src="./assets/js/plugins.js"></script>
    <script src="./assets/js/main.js"></script>

</body>
</html>