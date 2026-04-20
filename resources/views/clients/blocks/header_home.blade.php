<!DOCTYPE html>
<html lang="zxx">

<!-- Mirrored from webtendtheme.net/html/2024//{{ route('home') }} by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Oct 2024 09:26:27 GMT -->

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title>Goya - {{ $title }}</title>
    <!-- Favicon Icon -->
    <link rel="shortcut icon" href="{{ asset('clients/assets/images/logos/favicon.png') }}" type="image/x-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght700;800&display=swap" rel="stylesheet">
    <!-- Flaticon -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/flaticon.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/fontawesome-5.14.0.min.css') }}">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/bootstrap.min.css') }}">
    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/magnific-popup.min.css') }}">
    <!-- Nice Select -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/nice-select.min.css') }}">
    <!-- Animate -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/aos.css') }}">
    <!-- Slick -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/slick.min.css') }}">
    <!-- Main Style -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/style.css') }}">

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    {{--datetimepicker--}}
    <link rel="stylesheet" href="{{ asset('clients/assets/css_login/jquery.datetimepicker.min.css') }}">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('clients/assets/css/custom.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">


</head>


<div class="page-wrapper">

    <!-- Preloader -->
    {{-- <div class="preloader">
        <div class="custom-loader"></div>
    </div> --}}

    <!-- main header -->
    <header class="main-header header-one white-menu menu-absolute">
        <!--Header-Upper-->
        <div class="header-upper py-30 rpy-0">
            <div class="container-fluid clearfix">

                <div class="header-inner rel d-flex align-items-center">
                    <div class="logo-outer">
                        <div class="logo"><a href="{{ route('home') }}"><img
                                    src="{{ asset('clients/assets/images/logos/logo-5.png') }}" alt="Logo"
                                    title="Logo"></a></div>
                    </div>

                    <div class="nav-outer mx-lg-auto ps-xxl-5 clearfix">
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-lg">
                            <div class="navbar-header">
                                <div class="mobile-logo">
                                    <a href="{{ route('home') }}">
                                        <img src="{{ asset('clients/assets/images/logos/logo-5.png') }}" alt="Logo"
                                            title="Logo">
                                    </a>
                                </div>

                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-bs-toggle="collapse"
                                    data-bs-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>

                            <div class="navbar-collapse collapse clearfix">
                                <ul class="navigation clearfix">
                                    <li class="{{ Request::url() == route('home') ? 'active' : '' }}"><a
                                            href="{{ route('home') }}">Trang Chủ</a></li>
                                    <li class="{{ Request::url() == route('about') ? 'active' : '' }}"><a
                                            href="{{ route('about') }}">Giới Thiệu</a></li>
                                    <li
                                        class="dropdown {{ Request::is('tours') || Request::is('huongdanvien') || Request::is('chitiet_tour/*') ? 'active' : '' }}">
                                        <a href="{{ route('tours') }}">Tours</a>
                                        <ul>
                                            <li><a href="{{ route('tours') }}">Tour</a></li>
                                            <li><a href="{{ route('huongdanvien') }}">Hướng Dẫn Viên</a></li>
                                        </ul>
                                    </li>
                                    <li class="{{ Request::url() == route('noiden') ? 'active' : '' }}"><a
                                            href="{{ route('noiden') }}">Điểm đến</a></li>
                                    <li class="{{ Request::url() == route('contact') ? 'active' : '' }}"><a
                                            href="{{ route('contact') }}">Liên hệ</a></li>
                                    <li class="{{ Request::url() == route('blog') ? 'active' : '' }}"><a
                                            href="{{ route('blog') }}">Blog</a>
                                    </li>
                                </ul>
                            </div>

                        </nav>
                        <!-- Main Menu End-->
                    </div>

                    <!-- Nav Search -->
                    <div class="nav-search">
                        <button type="button" class="far fa-search"></button>

                        <form action="{{ route('search') }}" method="GET" class="hide">
                            <input type="text" name="keyword" placeholder="Tìm tour..." class="searchbox" required>

                            <button type="submit" class="searchbutton far fa-search"></button>
                        </form>
                    </div>

                    <!-- Menu Button -->
                    <div class="menu-btns py-10">
                        <a href="{{ route('tours') }}" class="theme-btn style-two bgc-secondary">
                            <span data-hover="Book Now">Book Now</span>
                            <i class="fal fa-arrow-right"></i>
                        </a>
                        <!-- menu sidbar -->
                        <div class="menu-sidebar">
                            <button class="bg-transparent user-btn" id="userToggle">
                                <i class="bx bx-user" style="font-size:24px; color: white;"></i>
                            </button>

                            <ul class="dropdown-menu-custom" id="userDropdown">
                                @if (session()->has('userID'))
                                    <li><a href="{{ route('home') }}"> Xin chào: {{ session('username') }}</a></li>
                                    <li><a href="{{ route('infor') }}">Thông tin cá nhân</a></li>


                                    <li><a href="{{ route('tour_booked') }}">Lich sử đặt tour</a></li>
                                    <li><a href="{{ route('logout') }}">Đăng xuất</a></li>
                                @else
                                    <li><a href="{{ route('login') }}">Đăng nhập</a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End Header Upper-->
    </header>