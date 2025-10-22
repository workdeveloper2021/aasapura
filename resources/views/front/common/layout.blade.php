<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>@yield('title')</title>
    <meta name="keywords" content=<?php echo '"' ; ?>@yield('metatags')
    <?php echo '"'; ?> />
    <meta name="description" content=<?php echo '"' ; ?>@yield('desc') <?php echo '"'; ?> />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->

    <link rel="shortcut icon" href="{{ url('uploads') }}/<?= site_favicon() ?>" />

    <meta name="theme-color" content="#ffffff" />
    <link rel="stylesheet"
        href="{{ url('website') }}/assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css" />
    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/plugins/owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/plugins/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/plugins/jquery.countdown.css" />
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/style.css" />
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/custom.css" />
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/skins/skin-demo-2.css" />
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/demos/demo-2.css" />
    <link rel="stylesheet" href="{{ url('website') }}/assets/css/plugins/nouislider/nouislider.css" />
    <script src="{{ url('') }}/alerts/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="{{ url('') }}/alerts/sweetalert2.min.css">


    
  <!-- Select2 CSS -->
  <link href="{{ url('select') }}/select2.min.css" rel="stylesheet" />

  <!-- Optional: Select2 Bootstrap 4 Theme -->
  <link href="{{ url('select') }}/select2-bootstrap4.min.css" rel="stylesheet" />


    @yield('header')
    
    <style>
        .page-header h1{
                color: #fff;
        }
    </style>
    
</head>

<body>
    <div class="page-wrapper">
        <header class="header header-2 header-intro-clearance">
            <div class="header-middle">
                <div class="container">
                    <div class="header-left">
                        <button class="mobile-menu-toggler">
                            <span class="sr-only">Toggle mobile menu</span>
                            <i class="icon-bars"></i>
                        </button>

                        <a href="/" class="logo">
                            <img src="{{ url('uploads') }}/<?= site_logo() ?>" loading="lazy" alt=" Logo" width="105"
                                height="25" />
                        </a>
                    </div>
                    <!-- End .header-left -->

                    <div class="header-center">
                        <div
                            class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                            <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                            <form action="/search-cycles" method="post">
                                @csrf
                                <div class="header-search-wrapper search-wrapper-wide">
                                    <div class="input-group">
                                        <label for="location-search" class="form-label" onclick="show_locations()">Location</label>
                                        <select class="form-control" name="location">
                                            <?php foreach(get_areas() as $key => $value){ ?>
                                            <option value="<?= $value->id ?>"><?= $value->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="divider"></div>
                                    <!-- Divider -->
                                    <div class="input-group">
                                        <label for="checkin-date" class="form-label">Check In</label>
                                        <input type="date" class="form-control" name="checkin" id="checkin-date"
                                            placeholder="Check In ..."/>
                                    </div>

                                    <div class="divider"></div>
                                    <!-- Divider -->

                                    <div class="input-group">
                                        <label for="checkout-date" class="form-label">Check Out</label>
                                        <input type="date" class="form-control" name="checkout" id="checkout-date"
                                            placeholder="Check Out ..."/>
                                    </div>

                                    <div class="divider"></div>
                                    <!-- Divider -->
                                    <!-- Dropdown Menu -->
                                    <div class="input-group">
                                        <label for="guests" class="form-label">Category</label>
                                        <select class="form-control" name="category" id="guests" >
                                            <option value="" disabled selected>
                                                Select Category
                                            </option>
                                            <?php foreach(getcategories() as $val){ ?>
                                            <option value="<?= $val->id ?>"><?= $val->name ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>

                                    <button class="btn btn-primary" type="submit">
                                        <i class="icon-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- End .header-search -->
                    </div>

                    <div class="header-right">

                       

                        <?php if(Auth::check()){ ?>

                             <div class="BulkSearch">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#BulkSearchModel">Bulk Search</button>
                        </div>
                        
                        <div class="dropdown cart-dropdown">
                            <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false" data-display="static">
                                <div class="icon">
                                    <i class="icon-user"></i>
                                </div>
                                <p>Account</p>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <div class="dropdown-cart-products">
                                    <div class="product align-items-center">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-setting">{{ Auth::user()->name }}</a>
                                            </h4>

                                            <span class="cart-product-info">{{ Auth::user()->email }}</span>
                                        </div>
                                        <!-- End .product-cart-details -->

                                        <figure class="product-image-container">
                                            <?php if(Auth::user()->image){ ?>
                                            <img src="{{ url('') }}/uploads/{{Auth::user()->image}}"
                                                loading="lazy" style="border-radius: 50%;width: 50px;height: 50px;"/>
                                            <?php }else{ ?>
                                               <img src="{{ url('') }}/defaultimages/userprofile.png"
                                                loading="lazy" style="border-radius: 50%;width: 50px;height: 50px;"/>
                                            <?php } ?>
                                        </figure>
                                    </div>
                                    <!-- End .product -->
                                    <?php if (Auth::check() && Auth::user()->role == "vendor" || Auth::user()->role == "provider") {

                                    ?>
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/new-post">New Post</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    <!--<?php if (Auth::check()){ ?>-->
                                    <!--<div class="product">-->
                                    <!--    <div class="product-cart-details">-->
                                    <!--        <h4 class="product-title">-->
                                    <!--            <a href="/wishlist">Wishlist</a>-->
                                    <!--        </h4>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <?php if(Auth::user()->role == "auditor"){ ?>
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/auditor/dashboard">Go to Dashboard</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <?php } ?>

                                    {{-- <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/cart">Cart</a>
                                            </h4>
                                        </div>
                                    </div> --}}

                                    <?php if(Auth::user()->role == "user"){ ?>
                                       <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-wallet">My Wallet</a>
                                            </h4>
                                        </div>
                                    </div>

                                     <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-bookings">My Bookings</a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/bulk-enquiry">Bulk Enquiry</a>
                                            </h4>
                                        </div>
                                    </div>


                                    <?php } ?>
                                    <?php } ?>

                                    <?php if (Auth::check() && Auth::user()->role == "vendor" || Auth::user()->role == "provider") {

                                        ?>

                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-products">Products List</a>
                                            </h4>
                                        </div>
                                    </div>

                                       <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-bookings">My Bookings</a>
                                            </h4>
                                        </div>
                                    </div>
                                    
                                    @if (Auth::check() && Auth::user()->role == "vendor")
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-enquires">Enquires</a>
                                            </h4>
                                        </div>
                                    </div>
                                    @endif

                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-orders">My Orders</a>
                                            </h4>
                                        </div>
                                    </div>

                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/packages">Buy Business Packages</a>
                                            </h4>
                                        </div>
                                    </div>

                                    <?php } ?>
                                    <!-- End .product -->
                                    

                                    <!-- End .product -->
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/help">Help</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <!-- End .product -->
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="/my-setting">Settings</a>
                                            </h4>
                                        </div>
                                    </div>
                                    <!-- End .product -->
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="#">Install Aashapura App</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                <!-- End .cart-product -->

                                <div class="dropdown-cart-action">
                                    <a href="{{ route('userlogout') }}" onclick="return confirm('Are you sure')"
                                        class="btn btn-outline-primary-2 w-100"><span>Logout</span><i
                                            class="icon-long-arrow-right"></i></a>
                                </div>
                                <!-- End .dropdown-cart-total -->
                            </div>
                            <!-- End .dropdown-menu -->
                        </div>
                        <?php } ?>
                        <!-- End .cart-dropdown -->

                        <?php if(Auth::check()){}else{ ?>
                        <div class="dropdown mx-5 mt-1 ">
                            <a href="#signin-modal" data-toggle="modal" class="btn btn-outline-primary-2"><span>Sign in
                                    / Sign up</span><i class="icon-long-arrow-right"></i></a>
                        </div>
                        <?php } ?>
                    </div>
                    <!-- End .header-right -->
                </div>
                <!-- End .container -->
            </div>



            <!-- End .header-middle -->

            <div class="header-bottom sticky-header">
                <div class="container">
                    <div class="header-center">
                        <nav class="main-nav">
                            <ul class="menu sf-arrows">
                                <li>
                                    <a href="/rental-products" class="sf-with-ul">Categories:</a>

                                    <div class="megamenu megamenu-md">
                                        <div class="row no-gutters">
                                            <div class="col-md-8">
                                                <div class="menu-col">
                                                    <ul class="d-flex flex-wrap">
                                                        <?php if( getcategories()->count() > 0 ){

                                                        foreach(getcategories() as $cavel){ ?>
                                                       <li class"w-50" style="width: 50%;"><a href="/rental-products?category=<?= $cavel->id ?>"><?= $cavel->name ?></a></li>

                                                       <?php
                                                       }
                                                        }  ?>
                                                        <!-- End .col-md-6 -->
                                                    </ul>
                                                    <!-- End .row -->
                                                </div>
                                                <!-- End .menu-col -->
                                            </div>
                                            <!-- End .col-md-8 -->

                                            <div class="col-md-4">
                                                <div class="banner banner-overlay">
                                                    <a href="/rental-products" class="banner banner-menu">
                                                        <img src="https://www.logoinfotech.com/wp-content/uploads/2023/01/Screenshot_12.jpg"
                                                            alt="Banner" />

                                                        <div class="banner-content banner-content-top">
                                                            <!-- <div class="banner-title text-white">
                                  Last <br />Chance<br /><span
                                    ><strong>Sale</strong></span
                                  >
                                </div> -->
                                                            <!-- End .banner-title -->
                                                        </div>
                                                        <!-- End .banner-content -->
                                                    </a>
                                                </div>
                                                <!-- End .banner banner-overlay -->
                                            </div>
                                            <!-- End .col-md-4 -->
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                    <!-- End .megamenu megamenu-md -->
                                </li>
                            </ul>
                            <!-- End .menu -->
                        </nav>



                        <!-- End .main-nav -->
                    </div>
                    <!-- End .header-center -->
                    <div class="text-primary">
                        <img src="{{ url('uploads') }}/<?= site_logo() ?>" loading="lazy" alt="logo" width="100" height="25" />
                    </div>
                    <div class="header-right">
                        <i class="la la-lightbulb-o"></i>
                        <p>Clearance<span class="highlight">&nbsp;Up to 30% Off</span></p>
                    </div>
                </div>
                <!-- End .container -->
            </div>
            <!-- End .header-bottom -->
        </header>
        <!-- End .header -->


        @yield('content')



        <footer class="footer footer-2">
            <div class="icon-boxes-container">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">All Locations Available</h3>

                                    <p>All Area Available</p>
                                </div>
                            </div>
                        </div>
                        <!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-4">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">Get 20% Off 1 Item</h3>
                                    <!-- End .icon-box-title -->
                                    <p>When you sign up</p>
                                </div>
                                <!-- End .icon-box-content -->
                            </div>
                            <!-- End .icon-box -->
                        </div>
                        <!-- End .col-sm-6 col-lg-3 -->

                        <div class="col-sm-6 col-lg-4">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                                <div class="icon-box-content">
                                    <h3 class="icon-box-title">We Support</h3>
                                    <!-- End .icon-box-title -->
                                    <p>24/7 amazing services</p>
                                </div>
                                <!-- End .icon-box-content -->
                            </div>
                            <!-- End .icon-box -->
                        </div>
                        <!-- End .col-sm-6 col-lg-3 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .icon-boxes-container -->

            <div class="footer-newsletter bg-image"
                style="background-image: url({{ url('website') }}/assets/images/footer-banner.jpg)">
                <div class="container">
                    <div class="heading text-center">
                        <h2 class="title" style="color: #000">Try the Aashapura app</h2>
                        <!-- End .title -->
                        <p class="title-desc" style="color: #000">
                            Buy, sell and find just about anything using the app on your
                            mobile.
                        </p>
                    </div>

                    <div class="row">
                        <div class="col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                            <h6 class="text-center" style="
                    color: #000;
                    border-bottom: 1px dashed #000;
                    padding: 10px;
                  ">
                                Get your app today
                            </h6>
                            <div class="d-flex justify-content-center align-center" style="gap: 10px">
                                <a href=""><img src="{{ url('website') }}/assets/images/apple.png" alt=""
                                        style="width: 100%; height: 50px" /></a>
                                <a href=""><img src="{{ url('website') }}/assets/images/google.png" alt="google"
                                        style="width: 100%; height: 50px" /></a>
                            </div>
                        </div>
                        <!-- End .col-sm-10 offset-sm-1 col-lg-6 offset-lg-3 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-newsletter bg-image -->

            <div class="footer-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-lg-6">
                            <div class="widget widget-about">
                                <img src="{{ url('uploads') }}/<?= site_logo() ?>" loading="lazy" class="footer-logo"
                                    alt="Footer Logo" width="105" height="25" />
                                <p>
                                    Lorem ipsum dolor, sit amet consectetur adipisicing elit.
                                    Modi praesentium assumenda in reiciendis ipsa quasi
                                    explicabo! Voluptas eum omnis tempora!
                                </p>

                                <div class="widget-about-info">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4">
                                            <span class="widget-about-title">Got Question? Call us 24/7</span>
                                            <a href="tel:<?= site_phone() ?>"><?= site_phone() ?></a>
                                        </div>
                                        <!-- End .col-sm-6 -->
                                    </div>
                                    <!-- End .row -->
                                </div>
                            </div>
                        </div>
                        <!-- End .col-sm-12 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title">Information</h4>
                                <!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="/about">About Us</a></li>
                                    <li><a href="/help">How to Rent Cycle</a></li>
                                    <li><a href="/faq">FAQ</a></li>
                                    <li><a href="/contact">Contact us</a></li>
                                </ul>
                                <!-- End .widget-list -->
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-sm-4 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title">Customer Service</h4>
                                <!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="/">Payment Methods</a></li>
                                    <li><a href="/">Money-back guarantee!</a></li>
                                    <li><a href="/">Returns</a></li>
                                </ul>
                                <!-- End .widget-list -->
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-sm-4 col-lg-3 -->

                        <div class="col-sm-4 col-lg-2">
                            <div class="widget">
                                <h4 class="widget-title">My Account</h4>
                                <!-- End .widget-title -->

                                <ul class="widget-list">
                                    <li><a href="/help">Help</a></li>
                                </ul>
                                <!-- End .widget-list -->
                            </div>
                            <!-- End .widget -->
                        </div>
                        <!-- End .col-sm-64 col-lg-3 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-middle -->
            

            <div class="footer-bottom">
                <div class="container">
                    <p class="footer-copyright">
                        Copyright © 2024 Aashapura Store. All Rights Reserved.
                    </p>
                    <!-- End .footer-copyright -->
                    <ul class="footer-menu">
                        <li><a href="/terms-condition">Terms Of Condition</a></li>
                        <li><a href="/privacy-policy">Privacy Policy</a></li>
                    </ul>
                    <!-- End .footer-menu -->

                    <div class="social-icons social-icons-color">
                        <span class="social-label">Social Media</span>
                        <a href="#" class="social-icon social-facebook" title="Facebook" target="_blank"><i
                                class="icon-facebook-f"></i></a>
                        <a href="#" class="social-icon social-twitter" title="Twitter" target="_blank"><i
                                class="icon-twitter"></i></a>
                        <a href="#" class="social-icon social-instagram" title="Instagram" target="_blank"><i
                                class="icon-instagram"></i></a>
                        <a href="#" class="social-icon social-youtube" title="Youtube" target="_blank"><i
                                class="icon-youtube"></i></a>
                        <a href="#" class="social-icon social-pinterest" title="Pinterest" target="_blank"><i
                                class="icon-pinterest"></i></a>
                    </div>
                    <!-- End .soial-icons -->
                </div>
                <!-- End .container -->
            </div>
            <!-- End .footer-bottom -->
        </footer>
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->
    <button id="scroll-top" title="Back to Top">
        <i class="icon-arrow-up"></i>
    </button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>

            <form action="#" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="mobile-search" id="mobile-search"
                    placeholder="Search product ..." required />
                <button class="btn btn-primary" type="submit">
                    <i class="icon-search"></i>
                </button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab"
                        role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab"
                        aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel"
                    aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            <li class="active">
                                <a href="/">Home</a>
                            </li>
                            <li>
                                <a href="#">For Rent: Categories</a>
                                <ul>
                                <?php if( getcategories()->count() > 0 ){
                                    foreach(getcategories() as $cavel){ ?>
                                    <li><a href="/rental-products?category=<?= $cavel->id ?>"><?= $cavel->name ?></a></li>
                                    <?php } }  ?>
                                </ul>
                            </li>
                            <li class="active">
                                <a href="/about">About Us</a>
                            </li>
                            <li class="active">
                                <a href="/contact">Contact Us</a>
                            </li>
                            <li class="active">
                                <a href="/faq">Faq's</a>
                            </li>
                            <li class="active">
                                <a href="/blog">Blog</a>
                            </li>
                        </ul>
                    </nav>
                    <!-- End .mobile-nav -->
                </div>
                <!-- .End .tab-pane -->
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                                <?php if( getcategories()->count() > 0 ){
                                    foreach(getcategories() as $cavel){ ?>
                                    <li><a href="/rental-products?category=<?= $cavel->id ?>"><?= $cavel->name ?></a></li>
                                    <?php } }  ?>

                        </ul>
                        <!-- End .mobile-cats-menu -->
                    </nav>
                    <!-- End .mobile-cats-nav -->
                </div>
                <!-- .End .tab-pane -->
            </div>
            <!-- End .tab-content -->

            <!--<div class="social-icons">-->
            <!--    <a href="#" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>-->
            <!--    <a href="#" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>-->
            <!--    <a href="#" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>-->
            <!--    <a href="#" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>-->
            <!--</div>-->
            <!-- End .social-icons -->
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <?php if(!Auth::check()){ ?>
    <!-- Sign in / Register Modal -->
    <div class="modal fade" id="signin-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="icon-close"></i></span>
                    </button>

                    <div class="form-box">
                        <div class="form-tab">
                            <ul class="nav nav-pills nav-fill" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="signin-tab" data-toggle="tab" href="#signin"
                                        role="tab" aria-controls="signin" aria-selected="true">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="register-tab" data-toggle="tab" href="#register" role="tab"
                                        aria-controls="register" aria-selected="false">Register</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="tab-content-5">
                                <div class="tab-pane fade show active" id="signin" role="tabpanel"
                                    aria-labelledby="signin-tab">
                                    <!-- End .form-group -->
                                    <form method="post" id="signin-form">
                                        @csrf
                                        <div class="form-group">
                                            <label for="signin-email">Username or email address *</label>
                                            <input type="text" class="form-control" id="signin-email" name="email" />
                                        </div>

                                        <div class="form-group">
                                            <label for="signin-password">Password *</label>
                                            <input type="password" class="form-control" id="signin-password"
                                                name="password" />
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-footer">
                                            <button type="submit" id="loginsubmit" class="btn btn-outline-primary-2">
                                                <span>LOG IN</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            {{-- <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input"
                                                    id="signin-remember" />
                                                <label class="custom-control-label" for="signin-remember">Remember
                                                    Me</label>
                                            </div> --}}
                                            <!-- End .custom-checkbox -->

                                            <a class="forgot-link" href="/forgot-password">Forgot Your
                                                Password?</a>
                                        </div>
                                        <!-- End .form-footer -->
                                    </form>
                                    {{-- <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div>
                                            <!-- End .col-6 -->
                                        </div>
                                        <!-- End .row -->
                                    </div> --}}
                                    <!-- End .form-choice -->
                                </div>
                                <!-- .End .tab-pane -->

                                <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                    <form id="register-form" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="register-name">Your Name *</label>
                                            <input type="text" class="form-control" id="register-name" name="name" />
                                        </div>


                                        <div class="form-group">
                                            <label for="register-email">Your email address *</label>
                                            <input type="email" class="form-control" id="register-email" name="email" />
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-password">Password *</label>
                                            <input type="password" class="form-control" id="register-password"
                                                name="password" />
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="form-group">
                                            <label for="register-cPassword">Confirm Password *</label>
                                            <input type="password" class="form-control" id="register-cPassword"
                                                name="password_confirmation" />
                                        </div>
                                        <!-- End .form-group -->

                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                name="provider_accountconfirm" id="providerpolicy" />
                                            <label class="custom-control-label" for="providerpolicy">Create Renter
                                                Account</label>
                                        </div>


                                        <div class="form-footer">
                                            <button type="submit" id="registersubmit" class="btn btn-outline-primary-2">
                                                <span>SIGN UP</span>
                                                <i class="icon-long-arrow-right"></i>
                                            </button>

                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="register-policy"
                                                    required />
                                                <label class="custom-control-label" for="register-policy">I agree to the
                                                    <a href="privacy-policy.html">privacy policy</a>
                                                    *</label>
                                            </div>
                                            <!-- End .custom-checkbox -->
                                        </div>
                                        <!-- End .form-footer -->
                                    </form>
                                    <div class="form-choice">
                                        <p class="text-center">or sign in with</p>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <a href="#" class="btn btn-login btn-g">
                                                    <i class="icon-google"></i>
                                                    Login With Google
                                                </a>
                                            </div>
                                            <!-- End .col-6 -->
                                        </div>
                                        <!-- End .row -->
                                    </div>
                                    <!-- End .form-choice -->
                                </div>
                                <!-- .End .tab-pane -->
                            </div>
                            <!-- End .tab-content -->
                        </div>
                        <!-- End .form-tab -->
                    </div>
                    <!-- End .form-box -->
                </div>
                <!-- End .modal-body -->
            </div>
            <!-- End .modal-content -->
        </div>
        <!-- End .modal-dialog -->
    </div>

    <?php } ?>

    <div class="modal fade" id="BulkSearchModel" tabindex="-1" role="dialog" aria-labelledby="BulkSearchModelTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
    
      <div class="modal-header">
        <h5 class="modal-title" id="BulkSearchModelTitle">Search Cycle</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true"></span>
        </button>
      </div>
      
                <div class="modal-body">
                  <form id="searchCycleForm" class="p-4">
                 <div class="form-group">
              <label for="Location">Location</label>
              <input type="text" class="form-control" id="Location" name="location" required>
            </div>

            <div class="form-group">
              <label for="quantity">Quantity</label>
              <input type="number" class="form-control" id="quantityBulkSearch" name="quantity" min="1" value="1" required>
            </div>
        
            <div class="form-group">
              <label for="category">Search by Category</label>
              <select class="form-control" id="categoryBulkSearch" name="category" required>
                <option value="">-- Select Category --</option>
                @foreach(App\Models\Category::where('status', 'Y')->where('parent_category', 0)->get() as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
          <div class="form-group">
            <label for="checkinDate">Check-In Date</label>
            <input type="date" class="form-control" id="checkinDate" name="checkin" required>
          </div>
          <div class="form-group">
            <label for="checkoutDate">Check-Out Date</label>
            <input type="date" class="form-control" id="checkoutDate" name="checkout" required>
          </div>
          <div id="dateValidationMessage" class="text-danger d-none">
            Check-out date must be after Check-in date.
          </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="validateAndSearch()">Search</button>
      </div>
      
    </div>
  </div>
</div>




    <script src="{{ url('website') }}/assets/js/jquery.min.js"></script>
    <script src="{{ url('website') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('website') }}/assets/js/jquery.hoverIntent.min.js"></script>
    <script src="{{ url('website') }}/assets/js/jquery.waypoints.min.js"></script>
    <script src="{{ url('website') }}/assets/js/superfish.min.js"></script>
    <script src="{{ url('website') }}/assets/js/owl.carousel.min.js"></script>

    <script src="{{ url('website') }}/assets/js/jquery.plugin.min.js"></script>
    <script src="{{ url('website') }}/assets/js/jquery.magnific-popup.min.js"></script>
    <script src="{{ url('website') }}/assets/js/jquery.countdown.min.js"></script>
    <!-- Main JS File -->
    <script src="{{ url('website') }}/assets/js/main.js"></script>
    <script src="{{ url('website') }}/assets/js/demos/demo-2.js"></script>

    <script src="{{ url('select') }}/select2.min.js"></script>
    <script>
    $(document).ready(function() {
      $('#locationsearchselect').select2({
        theme: 'bootstrap4',
        placeholder: "Select Location"
      });
    });
  </script>

    <script>
    // Date validation script
    document.addEventListener('DOMContentLoaded', function() {
        const checkinInput = document.getElementById('checkin-date');
        const checkoutInput = document.getElementById('checkout-date');
        
        // Set min date to today for both inputs initially
        const today = new Date().toISOString().split('T')[0];
        checkinInput.min = today;
        checkoutInput.min = today;
        
        // Update checkout min date when checkin changes
        checkinInput.addEventListener('change', function() {
            checkoutInput.min = this.value;
            
            // If checkout date is now before checkin date, reset it
            if (checkoutInput.value && checkoutInput.value < this.value) {
                checkoutInput.value = this.value;
            }
        });
    });
</script>



    <?php if(!Auth::check()){ ?>
    <script>
        $(document).ready(function() {
            $('#register-form').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $('#registersubmit').html('Trying to Sign Up......');
                $.ajax({
                    type: 'POST',
                    url: '/registeruser',
                    data: formData,
                    success: function(response) {
                        console.log(response);
                        if (response.status == "success") {
                            Swal.fire({
                                title: "Success",
                                text: 'Account Created Successfully , Please login your account.',
                                icon: "success"
                            });
                            $('#registersubmit').html('Sign Up');
                            $('#register-form')[0].reset();
                            document.getElementById('signin').classList.toggle('show');
                            document.getElementById('signin').classList.toggle('active');
                            document.getElementById('register').classList.toggle('show');
                            document.getElementById('register').classList.toggle('active');
                            document.getElementById('register-tab').classList.toggle('active');
                            document.getElementById('signin-tab').classList.toggle('active');
                        }else{
                            Swal.fire({
                                title: "Error",
                                text: 'Something Went Wrong',
                                icon: "error"
                            });
                            $('#registersubmit').html('Sign Up');
                            $('#registerform')[0].reset();
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        $.each(error.responseJSON, function(key, value) {

                            if (value.name) {
                                Swal.fire({
                                    title: "Validation Error",
                                    text: '' + value.name + '',
                                    icon: "error"
                                });
                                $('#registersubmit').html('Sign Up');
                            }else if (value.email) {
                                Swal.fire({
                                    title: "Validation Error",
                                    text: '' + value.email + '',
                                    icon: "error"
                                });
                                $('#registersubmit').html('Sign Up');
                            }
                            else if (value.password) {

                                Swal.fire({
                                    title: "Validation Error",
                                    text: '' + value.password + '',
                                    icon: "error"
                                });
                                $('#registersubmit').html('Sign Up');
                            }

                            else if (value.email && value.password) {
                                Swal.fire({
                                    title: "Validation Error",
                                    text: 'Email & Password can not be empty',
                                    icon: "error"
                                });

                                $('#registersubmit').html('Sign Up');
                            }

                            else if(value.password_confirmation){
                                Swal.fire({
                                    title: "Validation Error",
                                    text: '' + value.password_confirmation + '',
                                    icon: "error"
                                });
                                $('#registersubmit').html('Sign Up');
                            }

                        });

                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
    $('#signin-form').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $('#loginsubmit').html('Trying to Login......');
        $.ajax({
            type: 'POST',
            url: '/loginuser',
            data: formData,
            success: function(response) {
                console.log(response);
                if (response.status == "success") {
                    Swal.fire({
                        title: "Success",
                        text: 'Successfully Logged in',
                        icon: "success"
                    });
                    $('#loginsubmit').html('Sign In');
                    $('#signin-form')[0].reset();
                    window.location.href = "/";

                }  else if (response.status == "notactive") {
                    Swal.fire({
                        title: "Inactive Account",
                        text: 'Your account is not active',
                        icon: "error"
                    });
                    $('#loginsubmit').html('Sign In');
                    $('#signin-form')[0].reset();

                }else{
                    Swal.fire({
                        title: "Error",
                        text: 'Something Went Wrong',
                        icon: "error"
                    });
                    $('#loginsubmit').html('Sign In');
                    $('#signin-form')[0].reset();
                }
            },
            error: function(error) {
                console.log(error);
                $.each(error.responseJSON, function(key, value) {

                    if (value.email) {
                        Swal.fire({
                            title: "Validation Error",
                            text: '' + value.email + '',
                            icon: "error"
                        });
                        $('#loginsubmit').html('Sign In');
                    }
                    else if (value.password) {

                        Swal.fire({
                            title: "Validation Error",
                            text: '' + value.password + '',
                            icon: "error"
                        });
                        $('#loginsubmit').html('Sign In');
                    }

                    else if (value.email && value.password) {
                        Swal.fire({
                            title: "Validation Error",
                            text: 'Email & Password can not be empty',
                            icon: "error"
                        });

                        $('#loginsubmit').html('Sign In');
                    }


                });

            }
        });
    });
});
    </script>
    <?php } ?>

    @yield('footer')

    @if(session()->has('success'))
    <script>
        Swal.fire({
             title: "Success ",
             text: "{{session('success')}}",
             icon: "success"
        });
    </script>
    @endif


    @if(session()->has('error'))
    <script>
        Swal.fire({
             title: "Error",
             text: "{{session('error')}}",
             icon: "error"
        });
    </script>
    @endif



   <script>
function validateAndSearch() {
  const checkinInput = document.getElementById('checkinDate');
  const checkoutInput = document.getElementById('checkoutDate');
  const LocationInput = document.getElementById('Location');
  const quantityBulkSearch = document.getElementById('quantityBulkSearch');
  const categoryBulkSearch = document.getElementById('categoryBulkSearch');
  const checkin = new Date(checkinInput.value);
  const checkout = new Date(checkoutInput.value);
  const validationMessage = document.getElementById('dateValidationMessage');

  if (!checkinInput.value || !checkoutInput.value) {
    Swal.fire({
      icon: 'warning',
      title: 'Missing Input',
      text: 'Please select both Check-in and Check-out dates.'
    });
    return;
  }

  if (checkout <= checkin) {
    validationMessage.classList.remove('d-none');
  } else {
    validationMessage.classList.add('d-none');

    // Redirect with query parameters after confirmation

      // Redirect to search results with GET parameters
      const formattedCheckin = checkinInput.value;
      const formattedCheckout = checkoutInput.value;
      const redirectUrl = `/search-available-products?check_in=${formattedCheckin}&check_out=${formattedCheckout}&quantity=${quantityBulkSearch.value}&category=${categoryBulkSearch.value}&location=${LocationInput.value}`;
      window.location.href = redirectUrl;
    $('#BulkSearchModel').modal('hide');

  }
}
</script>
</body>
</html>
