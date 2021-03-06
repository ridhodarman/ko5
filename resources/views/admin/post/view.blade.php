@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Detail Post</h4>
            </div>
            <div>
                <a href="{{ route('post') }}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke post
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('status') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

@if (session('status2'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('status2') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                @foreach ($post as $p)
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">
                            {{$p->nama}}</p>
                        <table class="table table-hover">
                            <tr>
                                <td>Jenis</td>
                                <td>:</td>
                                <td>{{$p->jenis}}</td>
                            </tr>
                            <tr>
                                <td>Alamat</td>
                                <td>:</td>
                                <td>{{$p->alamat}}</td>
                            </tr>
                            <tr>
                                <td>Kelurahan</td>
                                <td>:</td>
                                <td>{{$p->kelurahan}}</td>
                            </tr>
                            <tr>
                                <td>Kecamatan</td>
                                <td>:</td>
                                <td>{{$p->kecamatan}}</td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$p->status}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{$p->deskripsi}}</td>
                            </tr>
                            <tr>
                                <td>Pemilik</td>
                                <td>:</td>
                                <td>
                                    <a href="{{ route('pemilik') }}/{{$p->pemilik_id}}" target="_blank">
                                        {{$p->pemilik}}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td>CP</td>
                                <td>:</td>
                                <td><a href="//{{$p->link_kontak}}" target="_blank">{{$p->link_kontak}}</a></td>
                            </tr>
                        </table>
                        <br />
                        <form action="{{ route('post') }}/{{$p->id}}" method="POST" class="d-inline">
                            @method('delete')
                            @csrf
                            <button type="button" class="btn btn-outline-danger btn-fw" id="tombol-hapus">
                                <i class="ti-trash"></i> Hapus Post
                            </button>
                        </form>&emsp;
                        <a href="{{ route('post') }}/{{$p->id}}/edit">
                            <button class="btn btn-inverse-info btn-fw">Edit</button>
                        </a>

                        <script>
                            let peringatan = true;
                            $('#tombol-hapus').on('click', function (e) {
                                if (peringatan == true) {
                                    swal({
                                        title: "Are you sure?",
                                        text: "Once deleted, you will not be able to recover this data!",
                                        icon: "warning",
                                        buttons: true,
                                        dangerMode: true,
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                peringatan = false;
                                                $('#tombol-hapus').removeAttr("type").attr("type", "submit");
                                                $('#tombol-hapus').trigger("click");
                                            }
                                        });
                                }
                            });
                        </script>
                        @php
                        echo '
                        <script>
                            let l = '.$p->lat.';
                            let b = '.$p->lng.';
                        </script>
                        ';
                        @endphp
                    </div>
                    <div class="col-md-6">
                        @if($p->lat!="" && $p->lng!="")
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
                        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
                        <style type="text/css">
                            #peta {
                                height: 60vh;
                            }
                        </style>
                        <br />
                        <div id="peta"></div>

                        <script type="text/javascript">
                            var mapOptions = {
                                center: [l, b],
                                zoom: 18
                            }

                            var peta = new L.map('peta', mapOptions);

                            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                maxZoom: 19,
                                id: 'mapbox.streets',
                                accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                            }).addTo(peta);
                            var Stamen_TonerLabels = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-labels/{z}/{x}/{y}{r}.{ext}', {
                                attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
                                subdomains: 'abcd',
                                minZoom: 0,
                                maxZoom: 19,
                                ext: 'png'
                            }).addTo(peta);

                            var marker = new L.Marker([l, b]);
                            marker.addTo(peta);
                        </script>
                        @else
                        <h4>Lokasi belum ditambahkan</h4>
                        @endif

                        <table class="table" style="text-align: center;">
                            <tr>
                                <td>
                                    <h5>Foto Cover :</h5>
                                    @if ($p->cover)
                                    <a target="_blank" href="{{ URL::asset('foto/'.$p->cover) }}">
                                        <img src="{{ URL::asset('aset/lazyload/images/blank.jpg') }}"
                                            data-original="{{ URL::asset('foto/'.$p->cover) }}" class="lazy img-fluid">
                                    </a>
                                    <form action="{{ route('post') }}/{{$p->id}}/cover" method="POST" class="d-inline">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn badge badge-danger" id="hapus-foto"
                                            style="scale: 90%;">
                                            <i class="fa fa-ban"></i> remove
                                        </button>
                                    </form>
                                    <script>
                                        let peringatan2 = true;
                                        $('#hapus-foto').on('click', function (e) {
                                            if (peringatan2 == true) {
                                                swal({
                                                    title: "Are you sure?",
                                                    text: "Once deleted, you will not be able to recover this imaginary file!",
                                                    icon: "warning",
                                                    buttons: true,
                                                    dangerMode: true,
                                                })
                                                    .then((willDelete) => {
                                                        if (willDelete) {
                                                            peringatan2 = false;
                                                            $('#hapus-foto').removeAttr("type").attr("type", "submit");
                                                            $('#hapus-foto').trigger("click");
                                                        }
                                                    });
                                            }
                                        });
                                    </script>
                                    @else
                                    <font color="gray">tidak ada</font>
                                    @endif
                                    <a href="{{ route('post') }}/{{$p->id}}/cover" class="badge badge-secondary"><i
                                            class="ti-file"></i> upload new photo</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="float: right;">
                    <a href="{{ route('detail_fasilitas_post') }}/tambah/{{$p->id}}">
                        <button class="btn btn-inverse-success btn-fw btn-xs">Tambah</button>
                    </a>
                </div>
                <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">Fasilitas
                </p>
                <table id="example" class="table table-hover display" style="width:100%; text-align: center;">
                    <tbody>
                        @foreach ($fasilitas as $f)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$f->nama}}</td>
                            <td>
                                <form action="{{ route('detail_fasilitas_post') }}/{{$f->id}}" method="POST"
                                    class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn badge badge-danger" id="hapus-fas-{{$f->id}}">
                                        <i class="fa fa-ban"></i> remove
                                    </button>
                                </form>
                                <script>
                                    let peringatanf{{$f->id}}=true;
                                    $("#hapus-fas-{{$f->id}}").on('click', function (e) {
                                        if (peringatanf{{$f->id }}== true){
                                        swal({
                                            text: 'Yakin hapus "{{$f->nama}}" dari daftar fasilitas ?',
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    peringatanf{{$f->id}} = false;
                                                    $("#hapus-fas-{{$f->id}}").removeAttr("type").attr("type", "submit");
                                                    $("#hapus-fas-{{$f->id}}").trigger("click");
                                                }
                                            });
                                    }
                                    });
                                </script>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="float: right;">
                    <a href="{{ route('harga') }}/tambah/{{$p->id}}">
                        <button class="btn btn-inverse-success btn-fw btn-xs">Tambah</button>
                    </a>
                </div>
                <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">Harga</p>
                <table id="example" class="table table-hover display" style="width:100%; text-align: center;">
                    <tbody>
                        @foreach ($harga as $h)
                        <tr>
                            <td>Rp. {{ number_format( $h->harga) }} / {{$h->pembayaran}}</td>
                            <td style="color: gray;">{{$h->keterangan}}</td>
                            <td>
                                <form action="{{ route('harga') }}/{{$h->id}}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn badge badge-danger" id="hapus-h-{{$h->id}}">
                                        <i class="fa fa-ban"></i> remove
                                    </button>
                                </form>
                                <script>
                                    let peringatanh{{$h->id}}=true;
                                    $("#hapus-h-{{$h->id}}").on('click', function (e) {
                                        if (peringatanh{{$h->id}}== true){
                                        swal({
                                            text: 'Yakin hapus "{{ $h->harga }} / {{$h->pembayaran}}" dari daftar harga ?',
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    peringatanh{{$h->id}} = false;
                                                    $("#hapus-h-{{$h->id}}").removeAttr("type").attr("type", "submit");
                                                    $("#hapus-h-{{$h->id}}").trigger("click");
                                                }
                                            });
                                    }
                                    });
                                </script>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="float: right;">
                    <a href="{{ route('foto') }}/tambah/{{$p->id}}">
                        <button class="btn btn-inverse-success btn-fw btn-xs">Tambah</button>
                    </a>
                </div>
                <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">Foto</p>
                <table id="example" class="table table-hover display" style="width:100%; text-align: center;">
                    <tbody>
                        @foreach ($foto as $g)
                        <tr>
                            <td>
                                <a target="_blank" href="{{ URL::asset('foto/'.$g->url) }}"> 
                                    <img src="{{ URL::asset('aset/lazyload/images/blank.jpg') }}"
                                            data-original="{{ URL::asset('foto/'.$g->url) }}" class="lazy img-fluid">
                                </a>
                            </td>
                            <td>
                                <form action="{{ route('foto') }}/{{$g->id}}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn badge badge-danger" id="hapus-p-{{$g->id}}">
                                        <i class="fa fa-ban"></i> remove
                                    </button>
                                </form>
                                <script>
                                    let peringatang{{$g->id}}=true;
                                    $("#hapus-p-{{$g->id}}").on('click', function (e) {
                                        if (peringatang{{$g->id}} == true){
                                        swal({
                                            text: "Yakin hapus foto ini ?",
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    peringatang{{$g->id}} = false;
                                                    $("#hapus-p-{{$g->id}}").removeAttr("type").attr("type", "submit");
                                                    $("#hapus-p-{{$g->id}}").trigger("click");
                                                }
                                            });
                                    }
                                    });
                                </script>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div style="float: right;">
                    <a href="{{ route('kamar') }}/tambah/{{$p->id}}">
                        <button class="btn btn-inverse-success btn-fw btn-xs">Tambah</button>
                    </a>
                </div>
                <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">Kamar</p>
                <table id="example" class="table table-hover display" style="width:100%; text-align: center;">
                    <tbody>
                        @php $total=0; @endphp
                        @foreach ($kamar as $k)
                        <tr>
                            <td> {{$k->panjang}} x {{$k->lebar}} </td>
                            <td style="color: gray;">{{$k->jumlah}}</td>
                            @php $total=$total+$k->jumlah; @endphp
                            <td>
                                <form action="{{ route('kamar') }}/{{$k->id}}" method="POST" class="d-inline">
                                    @method('delete')
                                    @csrf
                                    <button type="button" class="btn badge badge-danger" id="hapus-k-{{$k->id}}">
                                        <i class="fa fa-ban"></i> remove
                                    </button>
                                </form>
                                <script>
                                    let peringatank{{$k->id}}=true;
                                    $("#hapus-k-{{$k->id}}").on('click', function (e) {
                                        if (peringatank{{$k->id}} == true){
                                        swal({
                                            text: "Yakin hapus kamar {{$k->panjang}} x {{$k->lebar}} ?",
                                            icon: "warning",
                                            buttons: true,
                                            dangerMode: true,
                                        })
                                            .then((willDelete) => {
                                                if (willDelete) {
                                                    peringatank{{$k->id}} = false;
                                                    $("#hapus-k-{{$k->id}}").removeAttr("type").attr("type", "submit");
                                                    $("#hapus-k-{{$k->id}}").trigger("click");
                                                }
                                            });
                                    }
                                    });
                                </script>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div style="float: right;"> Total Kamar : {{$total}} </div>
            </div>
        </div>
    </div>
</div>
@endsection