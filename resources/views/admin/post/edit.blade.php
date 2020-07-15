@extends('admin.inc.layout')
@section('isi')
@foreach ($post as $p)
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Edit Post: <font color="gray">{{$p->nama}}</font> </h4>
            </div>
            <div>
                <a href="{{ route('post') }}/{{$p->id}}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke detail post
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="post" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('lat', $p->nama) }}">
                            @error('nama')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Jenis</label>
                        <div class="col-sm-10">
                            <select name="jenis" class="form-control @error('jenis') is-invalid @enderror"
                                style="color: black;">
                                <option></option>
                                <option value="Kos">Kos</option>
                                <option value="Kontrakan">Kontrakan</option>
                                <option value="Kos/Kontrakan">Kos/Kontrakan</option>
                            </select>
                            @error('jenis')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" value="{{ old('lat', $p->alamat) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-1">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radio"
                                        onclick='$("#status").hide();document.getElementById("status").value=" "'>
                                    -
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radio"
                                        onclick='$("#status").hide();document.getElementById("status").value="Masih tersedia"'>
                                    Masih tersedia
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radio"
                                        onclick='$("#status").hide();document.getElementById("status").value="Sold Out"'>
                                    Sold Out
                                </label>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="radio"
                                        id="membershipRadios1" onclick='$("#status").show();'>
                                    Other
                                </label>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="text" name="status" class="form-control @error('status') is-invalid @enderror"
                                value="{{old('title', $p->alamat)}}" id="status">
                            @error('status')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <select name="kecamatan" class="form-control" style="color: black;" id="kecamatan">
                                <option></option>
                                <option value="1">1</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <select name="kelurahan_id" style="color: black;"
                                class="form-control @error('kelurahan_id') is-invalid @enderror">
                                <option></option>
                                <option value="1">1</option>
                            </select>
                            @error('kelurahan_id')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                placeholder="* optional, kalau ada penjelasan lain">{{ old('deskripsi', $p->deskripsi) }}</textarea>
                            @error('deskripsi')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    @php
                        echo "
                            <script>
                                let l = ".old('lat', $p->lat) .";
                                let b = ". old('lat', $p->lng) .";
                            </script>
                        ";
                    @endphp
                    <div class="row">
                        <div class="col-md-6">
                            <link rel="stylesheet"
                                href="https://d19vzq90twjlae.cloudfront.net/leaflet/v0.7.7/leaflet.css" />
                            <script src="https://d19vzq90twjlae.cloudfront.net/leaflet/v0.7.7/leaflet.js"></script>
                            <style type="text/css">
                                #map {
                                    height: 50vh;
                                }
                            </style>
                            <div id="map"></div>

                            <script type="text/javascript">

                                var options = {
                                    center: [l , b],
                                    zoom: 15
                                }

                                var map = new L.map('map', options);

                                L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', 
                                    { 
                                        attribution: 'OSM', 
                                        maxZoom: 19,
                                        id: 'mapbox.streets',
                                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                                    }
                                ).addTo(map);
                                var Stamen_TonerLabels = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-labels/{z}/{x}/{y}.{ext}', {
                                    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                                    subdomains: 'abcd',
                                    minZoom: 0,
                                    maxZoom: 19,
                                    ext: 'png'
                                }).addTo(map);

                                // map.on('click', 
                                // 	function(e){
                                // 		//var coord = e.latlng.toString().split(',');
                                // 		//var lat = coord[0].split('(');
                                // 		//var lng = coord[1].split(')');
                                // 		//alert("You clicked the map at LAT: " + lat[1] + " and LONG: " + lng[0]);
                                // 		L.marker(e.latlng).addTo(map);
                                // 	});

                                var myMarker = L.marker([-0.92384, 100.45212], { title: "MyPoint", alt: "The Big I", draggable: true })
                                    .addTo(map)
                                    .on('dragend', function () {
                                        var coord = String(myMarker.getLatLng()).split(',');
                                        console.log(coord);
                                        var lat = coord[0].split('(');
                                        console.log(lat);
                                        var lng = coord[1].split(')');
                                        console.log(lng);
                                        myMarker.bindPopup("Moved to: " + lat[1] + ", " + lng[0] + ".");
                                        document.getElementById("lat").value = lat[1];
                                        document.getElementById("lng").value = lng[0];
                                    });

                            </script>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Lintang</label>
                                <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat"
                                    name="lat" placeholder="0.xxxx" value="{{ old('lat', $p->lat) }}">
                                @error('lat')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Bujur</label>
                                <input type="text" class="form-control @error('lng') is-invalid @enderror" id="lng"
                                    name="lng" placeholder="100.000" value="{{ old('lat', $p->lng) }}">
                                @error('lng')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Foto</label>
                                <input type="file" name="file" value="{{ old('file') }}" id="file"
                                class="form-control @error('file') is-invalid @enderror">
                                @error('file')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror

                                @if(old('file')==null)
                                    <br/>
                                    <a target="_blank" href="/foto/{{$p->cover}}" id="gambar">
                                        <img src="/foto/{{$p->cover}}" width="60px">
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <link rel="stylesheet" href="{{ URL::asset('css/jquery.fancybox.min.css') }}">
                    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.min.css') }}">
                    <br />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pemilik</label>
                        <div class="col-sm-10" style="background-color:#fafafa;">
                            <select class="selectpicker @error('user_id') is-invalid @enderror" 
                                data-style="btn-white btn-lg" data-width="100%" data-live-search="true" name="user_id">
                                <option></option>
                                <option value="1">1</option>
                            </select>
                            @error('user_id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div style="float: right;">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#example').DataTable();
            $("#post2").css("color", "black");
            $("#status").hide();
            $("[name='radio']").prop("checked", false);
        });

        $("#file").change(function(){
            $("#gambar").hide();
        }); 
    </script>
    @endforeach
    @endsection