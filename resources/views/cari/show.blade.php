<!DOCTYPE HTML>
<html lang="en">

<!-- Mirrored from bootstrap-ecommerce.com/bootstrap-ecommerce-html/page-listing-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jul 2020 15:11:08 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="pragma" content="no-cache" />
    <meta http-equiv="cache-control" content="max-age=604800" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Website title - bootstrap html template</title>

    <link href="{{ URL::asset('aset/images/favicon.ico') }}" rel="shortcut icon" type="image/x-icon">

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

    <script type="text/javascript">
        /// some script

        // jquery ready start
        $(document).ready(function () {
            // jQuery code

        });
// jquery end
    </script>

</head>

<body>

    <header class="section-header">

        <section class="header-main border-bottom">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-2 col-4">
                        <a href="{{ URL::asset('aset/http://bootstrap-ecommerce.com/') }}" class="brand-wrap">
                            <img class="logo" src="{{ URL::asset('aset/images/logo.png') }}">
                        </a> <!-- brand-wrap.// -->
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <form action="#" class="search">
                            <div class="input-group w-100">
                                <input type="text" class="form-control" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form> <!-- search-wrap .end// -->
                    </div> <!-- col.// -->
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="widgets-wrap float-md-right">
                            <div class="widget-header  mr-3">
                                <a href="#" class="icon icon-sm rounded-circle border"><i
                                        class="fa fa-shopping-cart"></i></a>
                                <span class="badge badge-pill badge-danger notify">0</span>
                            </div>
                            <div class="widget-header icontext">
                                <a href="#" class="icon icon-sm rounded-circle border"><i class="fa fa-user"></i></a>
                                <div class="text">
                                    <span class="text-muted">Welcome!</span>
                                    <div>
                                        <a href="#">Sign in</a> |
                                        <a href="#"> Register</a>
                                    </div>
                                </div>
                            </div>

                        </div> <!-- widgets-wrap.// -->
                    </div> <!-- col.// -->
                </div> <!-- row.// -->
            </div> <!-- container.// -->
        </section> <!-- header-main .// -->
    </header> <!-- section-header.// -->


    @foreach ($post as $p)
    <!-- ========================= SECTION PAGETOP ========================= -->
    <section class="section-pagetop bg">
        <div class="container">
            <h2 class="title-page">{{ $p->nama }}</h2>
            <nav>
                <ol class="breadcrumb text-white">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href='{{ route("cari") }}'>Cari Kos</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $p->nama }}</li>
                </ol>
            </nav>
        </div> <!-- container //  -->
    </section>
    <!-- ========================= SECTION INTRO END// ========================= -->

    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
        <div class="container">

            <div class="row">
                <main class="col-md-12">

                    <!-- <header class="border-bottom mb-4 pb-3">
                        <div class="form-inline">
                            <span class="mr-md-auto">
                                 
                            </span>
                        </div>
                    </header> -->

                    <div class="row">
                        @php
                        if($p->cover){
                        $gambar = 'foto/'.$p->cover;
                        }
                        else {
                        $gambar = "null.png";
                        }
                        @endphp

                        <div class="col-md-8 card-product-grid crop" style="padding-top: 10px;">
                            <link rel="stylesheet" href="{{ URL::asset('aset/slider/style.css') }}">
                            <div class="slider">
                                <div class="slide_viewer">
                                    <div class="slide_group">
                                        <div class="slide">
                                            <img src="{{ URL::asset($gambar) }}" class="gambar">
                                        </div>
                                        @foreach ($foto as $g)
                                        <div class="slide">
                                            <img src="{{ URL::asset('foto/'.$g->url) }}" class="gambar">
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div><!-- End // .slider -->

                            <div class="slide_buttons">
                            </div>

                            <div class="directional_nav">
                                <div class="previous_btn" title="Previous">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="65px"
                                        height="65px" viewBox="-11 -11.5 65 66">
                                        <g>
                                            <g>
                                                <path fill="#474544"
                                                    d="M-10.5,22.118C-10.5,4.132,4.133-10.5,22.118-10.5S54.736,4.132,54.736,22.118
                                        c0,17.985-14.633,32.618-32.618,32.618S-10.5,40.103-10.5,22.118z M-8.288,22.118c0,16.766,13.639,30.406,30.406,30.406 c16.765,0,30.405-13.641,30.405-30.406c0-16.766-13.641-30.406-30.405-30.406C5.35-8.288-8.288,5.352-8.288,22.118z" />
                                                <path fill="#474544"
                                                    d="M25.43,33.243L14.628,22.429c-0.433-0.432-0.433-1.132,0-1.564L25.43,10.051c0.432-0.432,1.132-0.432,1.563,0	c0.431,0.431,0.431,1.132,0,1.564L16.972,21.647l10.021,10.035c0.432,0.433,0.432,1.134,0,1.564	c-0.215,0.218-0.498,0.323-0.78,0.323C25.929,33.569,25.646,33.464,25.43,33.243z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                                <div class="next_btn" title="Next">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="65px"
                                        height="65px" viewBox="-11 -11.5 65 66">
                                        <g>
                                            <g>
                                                <path fill="#474544"
                                                    d="M22.118,54.736C4.132,54.736-10.5,40.103-10.5,22.118C-10.5,4.132,4.132-10.5,22.118-10.5	c17.985,0,32.618,14.632,32.618,32.618C54.736,40.103,40.103,54.736,22.118,54.736z M22.118-8.288	c-16.765,0-30.406,13.64-30.406,30.406c0,16.766,13.641,30.406,30.406,30.406c16.768,0,30.406-13.641,30.406-30.406 C52.524,5.352,38.885-8.288,22.118-8.288z" />
                                                <path fill="#474544"
                                                    d="M18.022,33.569c 0.282,0-0.566-0.105-0.781-0.323c-0.432-0.431-0.432-1.132,0-1.564l10.022-10.035 			L17.241,11.615c 0.431-0.432-0.431-1.133,0-1.564c0.432-0.432,1.132-0.432,1.564,0l10.803,10.814c0.433,0.432,0.433,1.132,0,1.564 L18.805,33.243C18.59,33.464,18.306,33.569,18.022,33.569z" />
                                            </g>
                                        </g>
                                    </svg>
                                </div>
                            </div><!-- End // .directional_nav -->
                            <!-- partial -->
                            <script src="{{ URL::asset('aset/slider/script.js') }}"></script>s
                        </div> <!-- col.// -->

                        <div class="col-md-4 mb-5 mt-2 card">
                            <!-- <center style="color: rgb(71, 71, 71);"> <b>{{ $p->nama }}</b> </center> -->
                            <table class="table table-hover" style="vertical-align: middle;">
                                <tr>
                                    <td><b> Tipe </b></td>
                                    <td>
                                        {{ $p->jenis }}
                                    </td>
                                </tr>
                                @if (count($kamar)>0)
                                <tr>
                                    <td><b> Kamar </b></td>
                                    <td>
                                        @foreach ($kamar as $k)
                                        <span class="badge badge-secondary">ukuran {{ $k->panjang }} x {{ $k->lebar }} meter</span>
                                            @if($k->jumlah)
                                            <span class="badge badge-light">{{ $k->jumlah }} kamar</span>
                                            @endif
                                        <br/>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif

                                @if (count($harga)>0)
                                <tr>
                                    <td><b> Harga </b></td>
                                    <td>
                                        @foreach ($harga as $h)
                                        <span style="color: green; font-weight: bolder;">
                                            Rp.  {{ str_replace (",", ".", number_format( $h->harga  ) ) }} / {{ $h->pembayaran }} 
                                        </span>
                                            @if($h->keterangan)
                                            <span class="badge badge-light">{{ $h->keterangan }}</span>
                                            @endif
                                        <br/>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif

                                <tr>
                                    <td><b> Status </b></td>
                                    <td>
                                        <b> {{ $p->status }} </b>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b> CP </b></td>
                                    <td>
                                        <a href="//{{$p->link_kontak}}" target="_blank">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                {{$p->link_kontak}}
                                                <span class="badge badge-light"><i class="fas fa-link"></i></span>
                                            </button>
                                        </a>
                                    </td>
                                </tr>

                            </table>
                        </div>

                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <img src="{{ URL::asset('aset/images/items/2.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Product name goes here just for demo item</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->

                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <img src="{{ URL::asset('aset/images/items/3.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Product name goes here just for demo item</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->

                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <img src="{{ URL::asset('aset/images/items/4.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Product name goes here just for demo item</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->

                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <img src="{{ URL::asset('aset/images/items/5.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Product name goes here just for demo item</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->

                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <img src="{{ URL::asset('aset/images/items/6.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Product name goes here just for demo item</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->

                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <img src="{{ URL::asset('aset/images/items/7.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Product name goes here just for demo item</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->

                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <img src="{{ URL::asset('aset/images/items/1.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Product name goes here just for demo item</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->
                    </div> <!-- row end.// -->


                    <nav class="mt-4" aria-label="Page navigation sample">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>

                </main> <!-- col.// -->

            </div>

        </div> <!-- container .//  -->
    </section>
    @endforeach
    <!-- ========================= SECTION CONTENT END// ========================= -->

    <!-- ========================= FOOTER ========================= -->
    <footer class="section-footer border-top padding-y">
        <div class="container">
            <p class="float-md-right">
                &copy Copyright 2019 All rights reserved
            </p>
            <p>
                <a href="#">Terms and conditions</a>
            </p>
        </div><!-- //container -->
    </footer>
    <!-- ========================= FOOTER END // ========================= -->



</body>

<!-- Mirrored from bootstrap-ecommerce.com/bootstrap-ecommerce-html/page-listing-grid.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 15 Jul 2020 15:11:23 GMT -->

</html>