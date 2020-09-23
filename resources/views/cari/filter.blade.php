@extends('cari.inc.layout')

@section('title', 'Cari Kos')

@section('judul')
<nav>
    <ol class="breadcrumb text-white">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href='{{ route("cari") }}'>Cari Kos</a></li>
    </ol>
</nav>
@endsection

@section('isi')

            <div class="row">
                <aside id="sidebar" class="col-md-3"></aside><!-- col.// -->
                <script>
                    $('#sidebar').load(`{{ route('sidebar') }}`);
                </script>
                <main class="col-md-9">

                    <header class="border-bottom mb-4 pb-3">
                        <div class="form-inline">
                            <span class="mr-md-auto">
                                <span id="jumlah"> {{ count($post) }} </span>
                                <span style="color: darkgray;"> Items found </span>
                                @if(isset($filter))
                                |Filter: 
                                {!! $filter !!}
                                <a href="{{ route('cari') }}">
                                    <span class="badge badge-danger glow">
                                        <i class="fas fa-times-circle"></i> Clear all filters
                                    </span>
                                </a>
                                @endif
                            </span>
                        </div>
                    </header><!-- sect-heading -->

                    <div class="row">

                        @foreach ($post as $p)
                        
                        <div class="col-md-4">
                            <figure class="card card-product-grid" style="height: 95%;">
                                <div class="img-wrap">
                                    @php
                                        if($p->cover){
                                            $gambar = 'foto/'.$p->cover;
                                        }
                                        else {
                                            $gambar = "null.png";
                                        }
                                    @endphp
                                    <a href="{{ route('info') }}/{{$p->id}}" target="_blank">
                                        <img src="{{ URL::asset('aset/lazyload/images/blank.jpg') }}"
                                            data-original="{{ URL::asset($gambar) }}" class="lazy img-fluid">
                                    </a>
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
                                                    <a href="{{ route('info') }}/{{$p->id}}" target="_blank">
                                                        <img src="{{ URL::asset('aset/lazyload/images/blank.jpg') }}"
                                                            data-original="{{ URL::asset($gambar) }}" class="lazy img-fluid">
                                                        <!-- <img src="{{ URL::asset($gambar) }}"> -->
                                                    </a>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <a href="{{ route('info') }}/{{$p->id}}" target="_blank">
                                                        <button type="button" class="btn btn-primary">Lihat Tempat</button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- img-wrap.// -->
                                <figcaption class="info-wrap">
                                    <!-- <div class="fix-height"> -->
                                    <div>
                                        <a href="{{ route('info') }}/{{$p->id}}" class="title">
                                            <div style="font-weight: bolder;">{{$p->nama}}</div>
                                            <div style="font-size: 85%; color: rgb(46, 46, 46);">
                                                <span class='badge badge-pill badge-light'>{{ $p->jenis  }}</span>
                                                @if(isset($p->jarak))
                                                Sekitar {{ str_replace (".", ",", round($p->jarak, 2) ) }} Kilometer dari pusat {{ $lokasi }}
                                                @endif
                                            </div>
                                        </a>
                                        <div class="price-wrap mt-1 mb-1">
                                            <span class="price" style="color: green;">
                                                Rp. {{ str_replace (",", ".", number_format($p->harga) ) }} / {{ $p->pembayaran }}
                                            </span>
                                        </div> <!-- price-wrap.// -->
                                    </div>
                                    <a href="{{ route('info') }}/{{$p->id}}" target="_blank" class="btn btn-block btn-primary">Lihat Tempat</a>
                                </figcaption>
                            </figure>
                        </div> <!-- col.// -->
                        
                        @endforeach
                    </div> <!-- row end.// -->


                    <nav class="mt-4" aria-label="Page navigation sample">
                        <ul class="pagination">
                            {{ $post->links()  }}
                        </ul>
                    </nav>

                    <!-- <nav class="mt-4" aria-label="Page navigation sample">
                        <ul class="pagination">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav> -->

                </main> <!-- col.// -->

            </div>
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
@endsection