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
                <form class="forms-sample" action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                            value="{{ old('nama', $p->nama) }}">
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
                            <select name="jenis_posts" class="form-control" style="color: black;">
                                <option></option>
                                @foreach ($jenis as $j)
                                <option value="{{$j->id}}">{{$j->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="alamat" value="{{ old('alamat') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <select name="status_posts" class="form-control" style="color: black;">
                                <option></option>
                                @foreach ($status as $s)
                                <option value="{{$s->id}}">{{$s->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kecamatan</label>
                        <div class="col-sm-10">
                            <select name="kecamatan" class="form-control" style="color: black;" id="kecamatan">
                                <option></option>
                                @foreach ($kecamatan as $k)
                                <option value="{{$k->id}}">{{$k->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Kelurahan</label>
                        <div class="col-sm-10">
                            <select name="kelurahan_id" style="color: black;" id="kelurahan" class="form-control">
                                <option></option>
                            </select>
                        </div>
                    </div>
                    <script>
                        $(function(){
                            $("#kecamatan").change(function(){
                                if($(this).val() != 0){
                                    $.get("/kelurahan/kecamatan/"+$(this).val(),function(kelurahan){
                                        var p_html = "<option></option>";
                                        for(var i=0;i<kelurahan.length;i++){
                                            p_html += "<option value='"+kelurahan[i].id+"'>"+kelurahan[i].nama+"</option>";
                                        }
                                        $("#kelurahan").html(p_html);
                                    },"json");
                                }
                                else{
                                    $("#kelurahan").html("<option></option>");
                                }
                            });
                        });
                    </script>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi"
                                placeholder="* optional, kalau ada penjelasan lain">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
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
                                    center: [-0.92384, 100.45212],
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
                                    name="lat" placeholder="0.xxxx" value="{{ old('lat') }}">
                                @error('lat')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Bujur</label>
                                <input type="text" class="form-control @error('lng') is-invalid @enderror" id="lng"
                                    name="lng" placeholder="100.000" value="{{ old('lng') }}">
                                @error('lng')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Foto</label>
                                <input type="file" name="file" value="{{ old('file') }}"
                                class="form-control @error('file') is-invalid @enderror">
                                @error('file')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <link rel="stylesheet" href="{{ URL::asset('css/jquery.fancybox.min.css') }}">
                    <link rel="stylesheet" href="{{ URL::asset('css/bootstrap-select.min.css') }}">
                    <br />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pemilik</label>
                        <div class="col-sm-10" style="background-color:#fafafa;">
                            <select class="selectpicker" 
                                data-style="btn-white btn-lg" data-width="100%" data-live-search="true" name="pemilik_id">
                                <option></option>
                                @foreach ($pemilik as $m)
                                <option value="{{$m->id}}">{{$m->nama}}</option>
                                @endforeach
                            </select>
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