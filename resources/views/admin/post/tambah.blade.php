@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Tambah Post</h4>
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

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('post') }}" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}">
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
                            @error('alamat')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
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
                                <option value="{{ old('kelurahan_id') }}"></option>
                            </select>
                        </div>
                    </div>
                    <script>
                        $(function () {
                            $("#kecamatan").change(function () {
                                if ($(this).val() != 0) {
                                    $.get("{{ route('kelurahan') }}/kecamatan/" + $(this).val(), function (kelurahan) {
                                        var p_html = "<option></option>";
                                        for (var i = 0; i < kelurahan.length; i++) {
                                            p_html += "<option value='" + kelurahan[i].id + "'>" + kelurahan[i].nama + "</option>";
                                        }
                                        $("#kelurahan").html(p_html);
                                    }, "json");
                                }
                                else {
                                    $("#kelurahan").html("<option></option>");
                                }
                            });
                        });
                    </script>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Link Kontak</label>
                        <div class="col-sm-10">
                            <input type="text" name="link_kontak"
                                class="form-control @error('link_kontak') is-invalid @enderror"
                                value="{{ old('link_kontak') }}" placeholder="bit.ly/....">
                            @error('link_kontak')
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
                                placeholder="* optional, kalau ada penjelasan lain">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <link rel="stylesheet"
                                href="https://d19vzq90twjlae.cloudfront.net/leaflet/v0.7.7/leaflet.css" />
                            <script src="https://d19vzq90twjlae.cloudfront.net/leaflet/v0.7.7/leaflet.js"></script>
                            <style type="text/css">
                                #map {
                                    height: 50vh;
                                }
                                #locate-position{
                                    position:absolute;
                                    top:140px;
                                    left:25px;
                                    -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                                    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                                    box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                                }
                            </style>
                            <div id="map"></div>
                            <button type="button" id="locate-position" class="btn btn-inverse-warning btn-icon" title="lokasi saya">
                                <i class="ti-location-pin"></i>
                            </button>

                            <script type="text/javascript">

                                var options = {
                                    center: [-0.92384, 100.45212],
                                    zoom: 15
                                }

                                var map = new L.map('map', options);

                                var satellite = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                                    {
                                        attribution: 'OSM',
                                        maxZoom: 19,
                                        id: 'mapbox.streets',
                                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                                    }
                                ).addTo(map);
                                var TonerLabels = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-labels/{z}/{x}/{y}.{ext}', {
                                    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                                    subdomains: 'abcd',
                                    minZoom: 0,
                                    maxZoom: 19,
                                    ext: 'png'
                                }).addTo(map);


                                var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"),
                                arcgis = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                                    {
                                        attribution: 'OSM',
                                        maxZoom: 19,
                                        id: 'mapbox.streets',
                                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                                    }
                                ),
                                group = L.LayerGroup([
                                L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                                    {
                                        attribution: 'OSM',
                                        maxZoom: 19,
                                        id: 'mapbox.streets',
                                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                                    }
                                ), 
                                L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-labels/{z}/{x}/{y}.{ext}', {
                                    attribution: 'Map tiles by <a href="http://stamen.com">Stamen Design</a>, <a href="http://creativecommons.org/licenses/by/3.0">CC BY 3.0</a> &mdash; Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                                    subdomains: 'abcd',
                                    minZoom: 0,
                                    maxZoom: 19,
                                    ext: 'png'
                                })
                                    ]);

                                var baseMaps = {
                                    "ArcGIS": arcgis,
                                    "OpenStreetMap": osm
                                };

                                var overlays =  {//add any overlays here
                                    
                                };

                                L.control.layers(baseMaps,overlays, {position: 'bottomleft'}).addTo(map);

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
                                
                                function gantilokasi(lat, lng){
                                    var newLatLng = new L.LatLng(lat, lng);
                                    myMarker.setLatLng(newLatLng); 
                                    map.panTo(new L.LatLng(lat, lng));
                                }

                                //menampilkan lokasi sekarang
                                $('#locate-position').on('click', function(){
                                    map.locate({setView: true, maxZoom: 15});
                                });
                                function onLocationFound(e) {
                                    // var radius = e.accuracy / 2;
                                    // L.marker(e.latlng).addTo(map)
                                        // .on('click', function(){
                                        // confirm("are you sure?");
                                        // });
                                        //.bindPopup("You are within " + radius + " meters from this point").openPopup();
                                    //L.circle(e.latlng, radius).addTo(map);
                                    myMarker.setLatLng(e.latlng); 
                                    map.panTo(e.latlng);
                                }

                                map.on('locationfound', onLocationFound);

                                function onLocationError(e) {
                                    alert(e.message);
                                }
                                map.on('locationerror', onLocationError);
                            </script>
                        </div>
                        <div class="col-md-4">
                            <div class="btn-group-vertical" role="group" aria-label="Basic example">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-outline-secondary dropdown-toggle"
                                        data-toggle="dropdown">
                                        <i class="ti-map-alt"></i> Zoom to..
                                    </button>
                                    <div class="dropdown-menu">
                                        @foreach ($kampus as $k)
                                            <a href="javascript:void(0);" class="dropdown-item" onclick="gantilokasi('{{$k->lat}}', '{{$k->lng}}')">{{$k->nama}}</a>
                                        @endforeach
                                        <a class="dropdown-item" href="{{ route('kampus') }}" target="blank">+More....</a>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Lintang</label>
                                <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat"
                                    name="lat" placeholder="-0.xxxx" value="{{ old('lat') }}">
                                @error('lat')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Bujur</label>
                                <input type="text" class="form-control @error('lng') is-invalid @enderror" id="lng"
                                    name="lng" placeholder="100.0xx" value="{{ old('lng') }}">
                                @error('lng')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>Foto</label>
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
                    <br />
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Pemilik</label>
                        <div class="col-sm-10" style="background-color:#fafafa;">
                            <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                data-live-search="true" name="pemilik_id">
                                <option></option>
                                @foreach ($pemilik as $p)
                                <option value="{{$p->id}}">{{$p->nama}}</option>
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
        $("#kecamatan").val(null).change();
        $("#post2").css("color", "black");
    </script>
    @endsection