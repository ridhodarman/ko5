@foreach ($post as $p)

@extends('cari.inc.layout')

@section('title') {{ $p->nama }} @endsection

@section('judul')
<nav>
    <ol class="breadcrumb text-white">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href='{{ route("cari") }}'>Cari Kos</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{ $p->nama }}</li>
    </ol>
</nav>
<h2 class="title-page">{{ $p->nama }}</h2>
@endsection

@section('isi')

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
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" width="65px" height="65px" viewBox="-11 -11.5 65 66">
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
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            x="0px" y="0px" width="65px" height="65px" viewBox="-11 -11.5 65 66">
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

            <div class="col-md-4 mb-5 mt-2 card" style="display: table; vertical-align: middle;">
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
                            <span class="badge badge-secondary">ukuran {{ $k->panjang }} x {{ $k->lebar }}
                                meter</span>
                            @if($k->jumlah)
                            <span class="badge badge-light">{{ $k->jumlah }} kamar</span>
                            @endif
                            <br />
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
                                Rp. {{ str_replace (",", ".", number_format( $h->harga  ) ) }} /
                                {{ $h->pembayaran }}
                            </span>
                            @if($h->keterangan)
                            <span class="badge badge-light">{{ $h->keterangan }}</span>
                            @endif
                            <br />
                            @endforeach
                        </td>
                    </tr>
                    @endif

                    @if ($p->status)
                    <tr>
                        <td><b> Status </b></td>
                        <td>
                            <b> {{ $p->status }} </b>
                        </td>
                    </tr>
                    @endif

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

            @php
            echo '
            <script>
                let l = '.$p->lat.';
                let b = '.$p->lng.';
            </script>
            ';
            @endphp

            <div class="col-md-5 mt-2" style="align-items: center;">
                @if ($p->lat != null && $p->lng != null)
                <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
                <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
                <style type="text/css">
                    #peta {
                        height: 60vh;
                    }
                </style>
                <div id="peta"></div>

                <script type="text/javascript">
                    var mapOptions = {
                        center: [l, b],
                        zoom: 16
                    }

                    var peta = new L.map('peta', mapOptions);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?access_token={accessToken}', {
                        attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>',
                        maxZoom: 20,
                        id: 'mapbox.streets',
                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                    }).addTo(peta);

                    // var marker = new L.Marker([l,b]);
                    // marker.addTo(peta);

                    var circle = L.circle([l, b], 85, {
                        color: 'blue',
                        fillColor: 'blue',
                        fillOpacity: 0.3
                    }).addTo(peta);

                </script>
                @endif
            </div> <!-- col.// -->

            <div class="col-md-7 card mt-2" style="display: table; vertical-align: middle;">
                <table class="table table-hover" style="vertical-align: middle;">
                    @if (count($fasilitas)>0)
                    <tr>
                        <td>
                            <b>Fasilitas</b>
                            <p>
                                @foreach ($fasilitas as $f)
                                <span class="badge badge-light">{{ $f->nama }}</span>
                                @endforeach
                            </p>
                        </td>
                    </tr>
                    @endif

                    @if ($p->deskripsi)
                    <tr>
                        <td>
                            <b>Deskripsi</b>
                            <p> {{ $p->deskripsi }} </p>
                        </td>
                    </tr>
                    @endif

                    @if ($p->alamat)
                    <tr>
                        <td>
                            <b>Alamat</b>
                            <p> {{ $p->alamat }} </p>
                        </td>
                    </tr>
                    @endif

                    @if ($p->kelurahan)
                    <tr>
                        <td>
                            <b>Kelurahan</b>
                            <p> {{ $p->kelurahan }} </p>
                        </td>
                    </tr>
                    @endif

                    @if ($p->kecamatan)
                    <tr>
                        <td>
                            <b>Kecamatan</b>
                            <p> {{ $p->kecamatan }} </p>
                        </td>
                    </tr>
                    @endif
                </table>
            </div> <!-- col.// -->
        </div> <!-- row end.// -->


    </main> <!-- col.// -->

</div>

@endsection
@endforeach