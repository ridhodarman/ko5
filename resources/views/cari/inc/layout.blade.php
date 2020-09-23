<!DOCTYPE HTML>
<html lang="en">

<!-- Mirrored from bootstrap-ecommerce.com/bootstrap-ecommerce-html/page-listing-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jul 2020 15:11:08 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>@yield('title')</title>

    <link href="{{ URL::asset('aset/images/iconq.webp') }}" rel="shortcut icon" type="image/x-icon">

    <!-- jQuery -->
    <script src="{{ URL::asset('aset/js/jquery-2.0.0.min.js') }}" type="text/javascript"></script>

    <!-- Bootstrap4 files-->
    <script src="{{ URL::asset('aset/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
    <link href="{{ URL::asset('aset/css/bootstrap.css') }}" rel="stylesheet" type="text/css" />

    <!-- Font awesome 5 -->
    <link href="{{ URL::asset('aset/fonts/fontawesome/css/all.min.css') }}" type="text/css" rel="stylesheet">

    <!-- plugin: fancybox  -->
    <script src="{{ URL::asset('aset/http://bootstrap-ecommerce.com/') }}" type="text/javascript"></script>
    <link href="{{ URL::asset('aset/http://bootstrap-ecommerce.com/') }}" type="text/css" rel="stylesheet">

    <!-- custom style -->
    <link href="{{ URL::asset('aset/css/ui.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('aset/css/responsive.css') }}" rel="stylesheet"
        media="only screen and (max-width: 1200px)" />

    <!-- custom javascript -->
    <script src="{{ URL::asset('aset/js/script.js') }}" type="text/javascript"></script>

    <!-- untuk kilau -->
    <style>
        .glow {
        color: #fff;
        text-align: center;
        -webkit-animation: glow 1s ease-in-out infinite alternate;
        -moz-animation: glow 1s ease-in-out infinite alternate;
        animation: glow 1s ease-in-out infinite alternate;
        }

        @-webkit-keyframes glow {
        from {
            text-shadow: 0 0 1px #fff, 0 0 0px #fff, 0 0 5px #e60073, 0 0 10px #e60073, 0 0 15px #e60073, 0 0 20px #e60073, 0 0 20px #e60073;
        }
        to {
            text-shadow: 0 0 1px #fff, 0 0 0px #ff4da6, 0 0 6px #ff4da6, 0 0 11px #ff4da6, 0 0 16px #ff4da6, 0 0 21px #ff4da6, 0 0 21px #ff4da6;
        }
        }
    </style>

    <script type="text/javascript">
        /// some script

        // jquery ready start
        $(document).ready(function () {
            // jQuery code

        });
// jquery end
    </script>

    <script src="{{ URL::asset('aset/lazyload/jquery.lazyload.min.js') }}" type="text/javascript"></script>
    <script type="text/javascript" charset="utf-8">
        $(function() {
            $("img.lazy").lazyload({effect : "fadeIn"});// untuk dipasang di <img src='xxxx'>
            $("div.lazy").lazyload({effect : "fadeIn"});// untuk dipasang sebagai background / div
        });

        $('.modal').on("shown.bs.modal", function () {
            $("img.lazy").lazyload();
        });
    </script>

</head>

<body>

    <header class="section-header">

        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-4">
                        <a href='{{ route("cari") }}' class="brand-wrap">
                            <img class="logo" src="{{ URL::asset('aset/images/logoq2.webp') }}">
                        </a> <!-- brand-wrap.// -->
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <form action='{{ route("cari") }}/nama' class="search" method="POST">
                            @csrf
                            <div class="input-group w-100">
                                <input type="text" class="form-control" placeholder="Cari nama kos / kontrakan.." name="nama_kos" 
                                value="@if(isset($nama_kos)){{ $nama_kos }}@endif">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form> 
                    </div> 
                        <!-- search-wrap .end// --> <!-- col.// -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="widgets-wrap float-md-right">
                            <div class="widget-header  mr-3">
                                <a href="#" class="icon icon-sm rounded-circle border"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <span class="badge badge-pill badge-danger notify">0</span>
                            </div>
                            <div class="widget-header icontext">
                                <a href="{{ route('home') }}" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                                <div class="text">
                                    <div>
                                        @if (Auth::check() && Auth::user()->name)
                                        {{ Auth::user()->name }}
                                        <br/>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();"
                                            class="badge badge-light">
                                            {{ __('Logout') }}
                                        </a>
                                        @else
                                        <a href="{{ route('login') }}">Sign in</a> |
                                        <a href="{{ route('register') }}"> Register</a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div> <!-- widgets-wrap.// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- container.// -->
        </section> <!-- header-main .// -->
    </header> <!-- section-header.// -->


    
    <!-- ========================= SECTION PAGETOP ========================= -->
    <section class="section-pagetop bg">
        <div class="container">
            @yield('judul')
        </div> <!-- container //  -->
    </section>
    <!-- ========================= SECTION INTRO END// ========================= -->

    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
        <div class="container">

            @yield('isi')

        </div> <!-- container .//  -->
    </section>
    <!-- ========================= SECTION CONTENT END// ========================= -->

    <!-- ========================= FOOTER ========================= -->
    <footer class="section-footer border-top padding-y">
        <div class="container">
            <p class="float-md-right">
                &copy Copyright 2020 Some rights reserved
            </p>
            <p>
                <a href="#">Terms and conditions</a>
            </p>
        </div><!-- //container -->
    </footer>
    <!-- ========================= FOOTER END // ========================= -->

    <!-- <script src="{{ URL::asset('aset/lazyload/jquery.min.js') }}" type="text/javascript"></script> -->
    
</body>

<!-- Mirrored from bootstrap-ecommerce.com/bootstrap-ecommerce-html/page-listing-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jul 2020 15:11:23 GMT -->

</html>