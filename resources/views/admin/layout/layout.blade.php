<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="" />
    <meta name="keywords" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="author" content="Phoenixcoded" />
    @yield('header')
    <!-- Favicon icon -->
    <link rel="icon" href="{{ url('admin') }}/{{ url('admin') }}/assets/images/favicon.ico" type="image/x-icon">
    <!-- vendor css -->
    <link rel="stylesheet" href="{{ url('admin') }}/assets/css/style.css?v1.2">

</head>

<body class="">
    <!-- [ Pre-loader ] start -->
    <div class="loader-bg">
        <div class="loader-track">
            <div class="loader-fill"></div>
        </div>
    </div>
    <!-- [ Pre-loader ] End -->
    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar  ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="{{ url('admin') }}/assets/images/user/avatar-2.jpg"
                            alt="User-Profile-Image">
                        <div class="user-details">
                            <span>Admin</span>
                            <div id="more-details">{{ auth()->user()->name }}
                            </div>
                        </div>
                    </div>
                    {{-- <div class="collapse" id="nav-user-link">
                        <ul class="list-unstyled">
                            <li class="list-group-item"><a href="user-profile.html"><i
                                        class="feather icon-user m-r-5"></i>View Profile</a></li>
                            <li class="list-group-item"><a href="#!"><i
                                        class="feather icon-settings m-r-5"></i>Settings</a></li>
                            <li class="list-group-item"><a href="auth-normal-sign-in.html"><i
                                        class="feather icon-log-out m-r-5"></i>Logout</a></li>
                        </ul>
                    </div> --}}
                </div>

                <ul class="nav pcoded-inner-navbar">
                    <li class="nav-item">
                        <a href="/admin/dashboard" class="nav-link "><span class="pcoded-micon"><i
                                    class="feather icon-home"></i></span><span class="pcoded-mtext">Dashboard</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/profile" class="nav-link "><span class="pcoded-micon"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M20 22H4V20C4 17.2386 6.23858 15 9 15H15C17.7614 15 20 17.2386 20 20V22ZM12 13C8.68629 13 6 10.3137 6 7C6 3.68629 8.68629 1 12 1C15.3137 1 18 3.68629 18 7C18 10.3137 15.3137 13 12 13Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">Profile</span></a>
                    </li>
                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M2 22C2 17.5817 5.58172 14 10 14C14.4183 14 18 17.5817 18 22H16C16 18.6863 13.3137 16 10 16C6.68629 16 4 18.6863 4 22H2ZM10 13C6.685 13 4 10.315 4 7C4 3.685 6.685 1 10 1C13.315 1 16 3.685 16 7C16 10.315 13.315 13 10 13ZM10 11C12.21 11 14 9.21 14 7C14 4.79 12.21 3 10 3C7.79 3 6 4.79 6 7C6 9.21 7.79 11 10 11ZM18.2837 14.7028C21.0644 15.9561 23 18.752 23 22H21C21 19.564 19.5483 17.4671 17.4628 16.5271L18.2837 14.7028ZM17.5962 3.41321C19.5944 4.23703 21 6.20361 21 8.5C21 11.3702 18.8042 13.7252 16 13.9776V11.9646C17.6967 11.7222 19 10.264 19 8.5C19 7.11935 18.2016 5.92603 17.041 5.35635L17.5962 3.41321Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">Users
                                Management</span></a>
                        <ul class="pcoded-submenu py-0">
                            <li><a href="/admin/view-users">Users</a></li>
                            <li><a href="/admin/view-providers">Renters</a></li>
                            <li><a href="/admin/view-vendors">Providers</a></li>
                            <li><a href="/admin/auditors">Auditors</a></li>

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/categories" class="nav-link "><span class="pcoded-micon"><svg
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8 4H21V6H8V4ZM4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5C6 5.82843 5.32843 6.5 4.5 6.5ZM4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12C6 12.8284 5.32843 13.5 4.5 13.5ZM4.5 20.4C3.67157 20.4 3 19.7284 3 18.9C3 18.0716 3.67157 17.4 4.5 17.4C5.32843 17.4 6 18.0716 6 18.9C6 19.7284 5.32843 20.4 4.5 20.4ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">Categories</span></a>
                    </li>


                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8 4H21V6H8V4ZM4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5C6 5.82843 5.32843 6.5 4.5 6.5ZM4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12C6 12.8284 5.32843 13.5 4.5 13.5ZM4.5 20.4C3.67157 20.4 3 19.7284 3 18.9C3 18.0716 3.67157 17.4 4.5 17.4C5.32843 17.4 6 18.0716 6 18.9C6 19.7284 5.32843 20.4 4.5 20.4ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">External</span></a>
                        <ul class="pcoded-submenu py-0">
                            <li><a href="/admin/brands">Brands</a></li>
                            <li><a href="/admin/states">States</a></li>
                            <li><a href="/admin/areas">Areas</a></li>
                            <li><a href="/admin/products-elements">Products Elements</a></li>
                        </ul>
                    </li>


                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8 4H21V6H8V4ZM4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5C6 5.82843 5.32843 6.5 4.5 6.5ZM4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12C6 12.8284 5.32843 13.5 4.5 13.5ZM4.5 20.4C3.67157 20.4 3 19.7284 3 18.9C3 18.0716 3.67157 17.4 4.5 17.4C5.32843 17.4 6 18.0716 6 18.9C6 19.7284 5.32843 20.4 4.5 20.4ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">Products</span></a>
                        <ul class="pcoded-submenu py-0">
                            <li><a href="/admin/products?type=panding">Panding Products</a></li>
                            <li><a href="/admin/products?type=verified">Verified Products</a></li>
                        </ul>
                    </li>






                      <li class="nav-item ">
                        <a href="/admin/orders" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8 4H21V6H8V4ZM4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5C6 5.82843 5.32843 6.5 4.5 6.5ZM4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12C6 12.8284 5.32843 13.5 4.5 13.5ZM4.5 20.4C3.67157 20.4 3 19.7284 3 18.9C3 18.0716 3.67157 17.4 4.5 17.4C5.32843 17.4 6 18.0716 6 18.9C6 19.7284 5.32843 20.4 4.5 20.4ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">Orders</span></a>

                    </li>

                      <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8 4H21V6H8V4ZM4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5C6 5.82843 5.32843 6.5 4.5 6.5ZM4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12C6 12.8284 5.32843 13.5 4.5 13.5ZM4.5 20.4C3.67157 20.4 3 19.7284 3 18.9C3 18.0716 3.67157 17.4 4.5 17.4C5.32843 17.4 6 18.0716 6 18.9C6 19.7284 5.32843 20.4 4.5 20.4ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">Pages Setting</span></a>
                        <ul class="pcoded-submenu py-0">
                            <li><a href="/admin/banners">Home Banners</a></li>
                            <li><a href="/admin/testimonials">Testimonials</a></li>
                            <li><a href="/admin/help">Helps Points</a></li>
                            <li><a href="/admin/faq?type=shipping_information">Shipping Information</a></li>
                            <li><a href="/admin/faq?type=order_returns">Order & Returns</a></li>
                            <li><a href="/admin/faq?type=payments">Payments</a></li>
                            <li><a href="/admin/aboutus">About Us</a></li>
                            <li><a href="/admin/teams">Our Team</a></li>
                        </ul>
                    </li>





                    <li class="nav-item">
                        <a href="/admin/enquries" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 7H13V9H11V7ZM11 11H13V17H11V11Z">
                                    </path>
                                </svg>
                            </span><span class="pcoded-mtext">Enquries</span></a>
                    </li>

                    
                    {{-- <li class="nav-item">
                        <a href="/admin/bulk-enquries" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM11 7H13V9H11V7ZM11 11H13V17H11V11Z">
                                    </path>
                                </svg>
                            </span><span class="pcoded-mtext">Bulk Enquires</span></a>
                    </li> --}}

                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M8 4H21V6H8V4ZM4.5 6.5C3.67157 6.5 3 5.82843 3 5C3 4.17157 3.67157 3.5 4.5 3.5C5.32843 3.5 6 4.17157 6 5C6 5.82843 5.32843 6.5 4.5 6.5ZM4.5 13.5C3.67157 13.5 3 12.8284 3 12C3 11.1716 3.67157 10.5 4.5 10.5C5.32843 10.5 6 11.1716 6 12C6 12.8284 5.32843 13.5 4.5 13.5ZM4.5 20.4C3.67157 20.4 3 19.7284 3 18.9C3 18.0716 3.67157 17.4 4.5 17.4C5.32843 17.4 6 18.0716 6 18.9C6 19.7284 5.32843 20.4 4.5 20.4ZM8 11H21V13H8V11ZM8 18H21V20H8V18Z">
                                    </path>
                                </svg></span><span class="pcoded-mtext">Blogs</span></a>
                        <ul class="pcoded-submenu py-0">
                            <li><a href="/admin/blogs">Blogs Lists</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/admin/web-setting" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 1L21.5 6.5V17.5L12 23L2.5 17.5V6.5L12 1ZM12 3.311L4.5 7.65311V16.3469L12 20.689L19.5 16.3469V7.65311L12 3.311ZM12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12C16 14.2091 14.2091 16 12 16ZM12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14Z">
                                    </path>
                                </svg>
                            </span><span class="pcoded-mtext">General Setting</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/advanced-setting" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 1L21.5 6.5V17.5L12 23L2.5 17.5V6.5L12 1ZM12 3.311L4.5 7.65311V16.3469L12 20.689L19.5 16.3469V7.65311L12 3.311ZM12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12C16 14.2091 14.2091 16 12 16ZM12 14C13.1046 14 14 13.1046 14 12C14 10.8954 13.1046 10 12 10C10.8954 10 10 10.8954 10 12C10 13.1046 10.8954 14 12 14Z">
                                    </path>
                                </svg>
                            </span><span class="pcoded-mtext">Advanced Settings</span></a>
                    </li>

                    <li class="nav-item">
                        <a href="/admin/packages" class="nav-link "><span class="pcoded-micon">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M4 3H20C20.5523 3 21 3.44772 21 4V11H3V4C3 3.44772 3.44772 3 4 3ZM3 13H21V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V13ZM7 16V18H10V16H7ZM7 6V8H10V6H7Z">
                                    </path>
                                </svg>
                            </span><span class="pcoded-mtext">Packages</span></a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->
    <!-- [ Header ] start -->
    <header class="navbar pcoded-header navbar-expand-lg navbar-light header-dark">


        <div class="m-header">

            <a href="#!" class="b-brand">
                <!-- ========   change your logo hear   ============ -->
                <img src="{{ url('uploads') }}/<?= site_logo() ?>" alt="" class="logo">
                <img src="{{ url('uploads') }}/<?= site_logo() ?>" alt="" class="logo-thumb">
            </a>
            <a href="#!" class="mob-toggler">
                <i class="feather icon-more-vertical"></i>
            </a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">  <a class="mobile-menu" id="mobile-collapse" href="#!"><span></span></a></li>
                <li class="nav-item">
                    <a href="#!" class="pop-search"><i class="feather icon-search"></i></a>
                    <div class="search-bar">
                        <input type="text" class="form-control border-0 shadow-none" placeholder="Search hear">
                        <button type="button" class="close" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </li>

                <!--<li class="nav-item">-->
                <!--    <div class="dropdown">-->
                <!--        <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">-->
                <!--            Dropdown-->
                <!--        </a>-->
                <!--        <div class="dropdown-menu profile-notification ">-->
                <!--            <ul class="pro-body">-->
                <!--                <li><a href="user-profile.html" class="dropdown-item"><i class="fas fa-circle"></i>-->
                <!--                        Profile</a></li>-->
                <!--                <li><a href="email_inbox.html" class="dropdown-item"><i class="fas fa-circle"></i> My-->
                <!--                        Messages</a></li>-->
                <!--                <li><a href="/log-out" class="dropdown-item"><i class="fas fa-circle"></i> Lock-->
                <!--                        Screen</a></li>-->
                <!--            </ul>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</li>-->
                <!--<li class="nav-item">-->
                <!--    <div class="dropdown mega-menu">-->
                <!--        <a class="dropdown-toggle h-drop" href="#" data-toggle="dropdown">-->
                <!--            Mega-->
                <!--        </a>-->
                <!--        <div class="dropdown-menu profile-notification ">-->
                <!--            <div class="row no-gutters">-->
                <!--                <div class="col">-->
                <!--                    <h6 class="mega-title">UI Element</h6>-->
                <!--                    <ul class="pro-body">-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Alert</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Button</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Badges</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Cards</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Modal</a>-->
                <!--                        </li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="fas fa-circle"></i> Tabs &-->
                <!--                                pills</a></li>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--                <div class="col">-->
                <!--                    <h6 class="mega-title">Forms</h6>-->
                <!--                    <ul class="pro-body">-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i>-->
                <!--                                Elements</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i>-->
                <!--                                Validation</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i>-->
                <!--                                Masking</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i>-->
                <!--                                Wizard</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i>-->
                <!--                                Picker</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-minus"></i>-->
                <!--                                Select</a></li>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--                <div class="col">-->
                <!--                    <h6 class="mega-title">Application</h6>-->
                <!--                    <ul class="pro-body">-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-mail"></i>-->
                <!--                                Email</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-clipboard"></i>-->
                <!--                                Task</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-check-square"></i>-->
                <!--                                To-Do</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-image"></i>-->
                <!--                                Gallery</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-help-circle"></i>-->
                <!--                                Helpdesk</a></li>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--                <div class="col">-->
                <!--                    <h6 class="mega-title">Extension</h6>-->
                <!--                    <ul class="pro-body">-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-file-plus"></i>-->
                <!--                                Editor</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-file-minus"></i>-->
                <!--                                Invoice</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-calendar"></i>-->
                <!--                                Full calendar</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-upload-cloud"></i>-->
                <!--                                File upload</a></li>-->
                <!--                        <li><a href="#!" class="dropdown-item"><i class="feather icon-scissors"></i>-->
                <!--                                Image cropper</a></li>-->
                <!--                    </ul>-->
                <!--                </div>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</li>-->
            </ul>
            <ul class="navbar-nav ml-auto">

                <li>
                    <div class="dropdown drp-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="feather icon-user"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right profile-notification">
                            <div class="pro-head">
                                <img src="{{ url('admin') }}/assets/images/user/avatar-1.jpg" class="img-radius"
                                    alt="User-Profile-Image">
                                <span>John Doe</span>
                                <a onclick="return confirm('logout !')" href="/log-out" class="dud-logout" title="Logout">
                                    <i class="feather icon-log-out"></i>
                                </a>
                            </div>
                            <ul class="pro-body">

                                <li><a onclick="return confirm('logout !')" href="/log-out" class="dropdown-item"><i class="feather icon-lock"></i>
                                        Lock Screen</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            </ul>
        </div>


    </header>
    <!-- [ Header ] end -->


    @yield('content')


    <!-- Required Js -->
    <script src="{{ url('admin') }}/assets/js/jquery.min.js"></script>
    <script src="{{ url('admin') }}/assets/js/vendor-all.min.js"></script>
    <script src="{{ url('admin') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ url('admin') }}/assets/js/pcoded.min.js"></script>
    <!-- Apex Chart -->
    <script src="{{ url('admin') }}/assets/js/apexcharts.min.js"></script>
    <!-- custom-chart js -->
    <script src="{{ url('admin') }}/assets/js/pages/dashboard-main.js"></script>




    @yield('js')


    @yield('scripts')


    @if(Session::has('success'))
    <section id="toast" class="info">
        <div id="icon-wrapper">
            <div id="icon">

            </div>
        </div>
        <div id="toast-message">
            <h4>Success</h4>
            <p>{{ Session::get('success') }}</p>
        </div>
        <button id="toast-close"></button>
        <div id="timer"></div>
    </section>


    <script>
        const toast = document.querySelector("#toast");
const toastTimer = document.querySelector("#timer");
const closeToastBtn = document.querySelector("#toast-close");
let countdown

const closeToast = () => {
toast.style.animation = "close 0.3s cubic-bezier(.87,-1,.57,.97) forwards";
toastTimer.classList.remove("timer-animation");
clearTimeout(countdown)
}

const openToast = (type) => {
toast.classList = [type];
toast.style.animation = "open 0.3s cubic-bezier(.47,.02,.44,2) forwards";
toastTimer.classList.add("timer-animation");
clearTimeout(countdown)
countdown = setTimeout(() => {
closeToast();
}, 5000)
}

closeToastBtn.addEventListener("click", closeToast)

    </script>

    <script>
        openToast('success');
    </script>

    @endif



    @if(Session::has('error'))
    <section id="toast" class="info">
        <div id="icon-wrapper">
            <div id="icon">

            </div>
        </div>
        <div id="toast-message">
            <h4>Error</h4>
            <p>{{ Session::get('error') }}</p>
        </div>
        <button id="toast-close"></button>
        <div id="timer"></div>
    </section>


    <script>
        const toast = document.querySelector("#toast");
const toastTimer = document.querySelector("#timer");
const closeToastBtn = document.querySelector("#toast-close");
let countdown

const closeToast = () => {
toast.style.animation = "close 0.3s cubic-bezier(.87,-1,.57,.97) forwards";
toastTimer.classList.remove("timer-animation");
clearTimeout(countdown)
}

const openToast = (type) => {
toast.classList = [type];
toast.style.animation = "open 0.3s cubic-bezier(.47,.02,.44,2) forwards";
toastTimer.classList.add("timer-animation");
clearTimeout(countdown)
countdown = setTimeout(() => {
closeToast();
}, 5000)
}

closeToastBtn.addEventListener("click", closeToast)

    </script>

    <script>
        openToast('error');
    </script>

    @endif




</body>

</html>
