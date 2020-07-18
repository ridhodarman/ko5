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



    <!-- ========================= SECTION PAGETOP ========================= -->
    <section class="section-pagetop bg">
        <div class="container">
            <h2 class="title-page">Category products</h2>
            <nav>
                <ol class="breadcrumb text-white">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Best category</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Great articles</li>
                </ol>
            </nav>
        </div> <!-- container //  -->
    </section>
    <!-- ========================= SECTION INTRO END// ========================= -->

    <!-- ========================= SECTION CONTENT ========================= -->
    <section class="section-content padding-y">
        <div class="container">

            <div class="row">
                <aside id="sidebar" class="col-md-3"></aside><!-- col.// -->
                <script>
                    $('#sidebar').load(`{{ route('sidebar') }}/`);
                </script>
                <main class="col-md-9">

                    <header class="border-bottom mb-4 pb-3">
                        <div class="form-inline">
                            <span class="mr-md-auto">
                                {{ count($post) }} <font style="color: darkgray;"> Items found </font>
                                @if (isset($teks))
                                    | <font style="color: darkgray;">menampilkan hasil pencarian dari:</font> {!! $teks !!} 
                                @endif
                            </span>
                        </div>
                    </header><!-- sect-heading -->

                    <div class="row">

                        @foreach ($post as $p)
                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    @php
                                        if($p->cover){
                                            $gambar = 'foto/'.$p->cover;
                                        }
                                        else {
                                            $gambar = "null.png";
                                        }
                                    @endphp
                                    <a href="#"><img src="{{ URL::asset($gambar) }}"></a>
                                    <a class="btn-overlay" href="javascript:;" data-toggle="modal" data-target="#exampleModal{{$p->id}}"><i class="fa fa-search-plus"></i> Quick View</a>
                                    <div class="modal fade" id="exampleModal{{$p->id}}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">{{$p->nama}}</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <img src="{{ URL::asset($gambar) }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Lihat Tempat</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <!-- <div class="fix-height"> -->
                                    <div>
                                        <a href="#" class="title">
                                            <div style="font-weight: bolder;">{{$p->nama}}</div>
                                            <div style="font-size: 85%; color: darkgrey;">
                                                {!! $p->keterangan !!}
                                            </div>
                                        </a>
                                        <div class="price-wrap mt-2">
                                            <span class="price" style="color: green;">Rp. 1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Lihat Tempat</a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->
                        @endforeach
                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    <span class="badge badge-danger"> NEW </span>
                                    <img src="{{ URL::asset('aset/images/items/1.jpg') }}">
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> Quick view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <div class="fix-height">
                                        <a href="#" class="title">Great item name goes here</a>
                                        <div class="price-wrap mt-2">
                                            <span class="price">$1280</span>
                                            <del class="price-old">$1980</del>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Add to cart </a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->

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