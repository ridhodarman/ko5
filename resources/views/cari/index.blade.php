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
                <aside class="col-md-3">

                    <div class="card">
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_1" aria-expanded="true"
                                    class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">Cari</h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_1" style="">
                                <div class="card-body">
                                    <form class="pb-3">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search">
                                            <div class="input-group-append">
                                                <button class="btn btn-light" type="button"><i
                                                        class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>

                                    Popular Keywords:
                                    <ul class="list-menu">
                                        <a href="#" class="badge badge-light">Kos pasar baru </a>
                                        <a href="{{ route('cari') }}/1/2/" class="badge badge-light">Kos cowok unand </a>
                                        <a href="#" class="badge badge-light">Kos cewek unand </a>
                                        <a href="#" class="badge badge-light">Kos cowok unp </a>
                                        <a href="#" class="badge badge-light">Kos cewek unp </a>
                                        <a href="#" class="badge badge-light">Kontrakan unand </a>
                                        <a href="#" class="badge badge-light">Kontrakan unp</a>
                                    </ul>

                                </div> <!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group  .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_2" aria-expanded="true"
                                    class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">Brands </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_2" style="">
                                <div class="card-body">
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Mercedes
                                            <b class="badge badge-pill badge-light float-right">120</b> </div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Toyota
                                            <b class="badge badge-pill badge-light float-right">15</b> </div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Mitsubishi
                                            <b class="badge badge-pill badge-light float-right">35</b> </div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" checked="" class="custom-control-input">
                                        <div class="custom-control-label">Nissan
                                            <b class="badge badge-pill badge-light float-right">89</b> </div>
                                    </label>
                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input">
                                        <div class="custom-control-label">Honda
                                            <b class="badge badge-pill badge-light float-right">30</b> </div>
                                    </label>
                                </div> <!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_3" aria-expanded="true"
                                    class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">Price range </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_3" style="">
                                <div class="card-body">
                                    <input type="range" class="custom-range" min="0" max="100" name="">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Min</label>
                                            <input class="form-control" placeholder="$0" type="number">
                                        </div>
                                        <div class="form-group text-right col-md-6">
                                            <label>Max</label>
                                            <input class="form-control" placeholder="$1,0000" type="number">
                                        </div>
                                    </div> <!-- form-row.// -->
                                    <button class="btn btn-block btn-primary">Apply</button>
                                </div><!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_4" aria-expanded="true"
                                    class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">Sizes </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse show" id="collapse_4" style="">
                                <div class="card-body">
                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> XS </span>
                                    </label>

                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> SM </span>
                                    </label>

                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> LG </span>
                                    </label>

                                    <label class="checkbox-btn">
                                        <input type="checkbox">
                                        <span class="btn btn-light"> XXL </span>
                                    </label>
                                </div><!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                        <article class="filter-group">
                            <header class="card-header">
                                <a href="#" data-toggle="collapse" data-target="#collapse_5" aria-expanded="false"
                                    class="">
                                    <i class="icon-control fa fa-chevron-down"></i>
                                    <h6 class="title">More filter </h6>
                                </a>
                            </header>
                            <div class="filter-content collapse in" id="collapse_5" style="">
                                <div class="card-body">
                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" checked=""
                                            class="custom-control-input">
                                        <div class="custom-control-label">Any condition</div>
                                    </label>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                                        <div class="custom-control-label">Brand new </div>
                                    </label>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                                        <div class="custom-control-label">Used items</div>
                                    </label>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" name="myfilter_radio" class="custom-control-input">
                                        <div class="custom-control-label">Very old</div>
                                    </label>
                                </div><!-- card-body.// -->
                            </div>
                        </article> <!-- filter-group .// -->
                    </div> <!-- card.// -->

                </aside> <!-- col.// -->
                <main class="col-md-9">

                    <header class="border-bottom mb-4 pb-3">
                        <div class="form-inline">
                            <span class="mr-md-auto">{{ count($post) }} Items found </span>
                        </div>
                    </header><!-- sect-heading -->

                    <div class="row">
                        
                        @foreach ($post as $p)
                        <div class="col-md-4">
                            <figure class="card card-product-grid">
                                <div class="img-wrap">
                                    @if ($p->cover)
                                        <a href="#"><img src="{{ URL::asset('foto/'.$p->cover) }}"></a>
                                    @else
                                        <a href="#"><img src="{{ URL::asset('null.png') }}"></a>
                                    @endif
                                    <a class="btn-overlay" href="#"><i class="fa fa-search-plus"></i> view</a>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <!-- <div class="fix-height"> -->
                                    <div>
                                        <a href="#" class="title">
                                            <div style="font-weight: bolder;">{{$p->nama}}</div>
                                            <div style="font-size: 85%; color: darkgrey;">
                                            @if (isset($p->keterangan))
                                                {{ $p->keterangan }}
                                            @endif
                                            </div>
                                        </a>
                                        <div class="price-wrap mt-2">
                                            <span class="price" style="color: green;">Rp. 1280</span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="#" class="btn btn-block btn-primary">Lihat Kos</a>
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