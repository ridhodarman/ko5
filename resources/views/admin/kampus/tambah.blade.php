@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Tambah Kampus</h4>
            </div>
            <div>
                <a href="{{ route('kampus') }}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke daftar kampus
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
                <form class="forms-sample" action="{{ route('kampus') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Kampus</label>
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
                        <label class="col-sm-2 col-form-label">Lokasi Kampus</label>
                        <div class="col-md-7">
                            <link rel="stylesheet"
                                href="https://d19vzq90twjlae.cloudfront.net/leaflet/v0.7.7/leaflet.css" />
                            <script src="https://d19vzq90twjlae.cloudfront.net/leaflet/v0.7.7/leaflet.js"></script>
                            <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet/0.0.1-beta.5/esri-leaflet.js"></script>
                            <script src="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.js"></script>
                            <link rel="stylesheet" type="text/css" href="https://cdn-geoweb.s3.amazonaws.com/esri-leaflet-geocoder/0.0.1-beta.5/esri-leaflet-geocoder.css">
                            <style type="text/css">
                                #map {
                                    height: 50vh;
                                }
                                #mapSearchContainer{
                                    position:fixed;
                                    top:20px;
                                    right: 40px;
                                    height:30px;
                                    width:180px;
                                    z-index:110;
                                    font-size:10pt;
                                    color:#5d5d5d;
                                    border:solid 1px #bbb;
                                    background-color:#f8f8f8;
                                }
                                #locate-position{
                                    position:absolute;
                                    top:140px;
                                    left:25px;
                                    -webkit-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                                    -moz-box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                                    box-shadow: 0px 0px 5px 0px rgba(0,0,0,0.75);
                                    width: 30px;
                                    height: 30px;
                                    color: black;
                                }
                                #pencarian{
                                    position:absolute;
                                    top:86px;
                                    left:60px;
                                    z-index:99999;
                                }
                            </style>
                            <div id="map"></div>
                            <div id="pencarian"></div>
                            <button type="button" id="locate-position" class="btn btn-inverse-light btn-icon" title="lokasi saya">
                                <i class="ti-location-pin"></i>
                            </button>

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

                                var osm = L.tileLayer("http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png"),
                                arcgis = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
                                    {
                                        attribution: 'OSM',
                                        id: 'mapbox.streets',
                                        accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                                    }
                                );

                                var baseMaps = {
                                    "ArcGIS": arcgis,
                                    "OpenStreetMap": osm
                                };

                                var overlays =  {//add any overlays here
                                    
                                };

                                L.control.layers(baseMaps,overlays, {position: 'bottomleft'}).addTo(map);

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

                                //menampilkan lokasi sekarang
                                $('#locate-position').on('click', function(){
                                    map.locate({setView: true, maxZoom: 15});
                                });
                                function onLocationFound(e) {
                                    myMarker.setLatLng(e.latlng); 
                                    map.panTo(e.latlng);
                                }

                                map.on('locationfound', onLocationFound);

                                function onLocationError(e) {
                                    alert(e.message);
                                }
                                map.on('locationerror', onLocationError);

                                // untuk pencarian lokasi
                                var searchControl = new L.esri.Controls.Geosearch().addTo(map);

                                var results = new L.LayerGroup().addTo(map);

                                searchControl.on('results', function(data){
                                    results.clearLayers();
                                    for (var i = data.results.length - 1; i >= 0; i--) {
                                        //results.addLayer(L.marker(data.results[i].latlng));
                                        let koordinat = data.results[i].latlng;
                                        let str = `${koordinat}`;
                                        let str2 = str.replace("LatLng(", "");
                                        let str3 = str2.replace(")", "");
                                        let hasil = str3.split(",");
                                        //alert(hasil)
                                        var carilokasi = new L.LatLng(hasil[0], hasil[1]);
                                        myMarker.setLatLng(carilokasi); 
                                        map.panTo(carilokasi);
                                    }
                                });

                                setTimeout(function(){$('.pointer').fadeOut('slow');},3400);

                                // untuk memindahkan marker dengan klik peta
                                function onMapClick(e) {
                                    myMarker.setLatLng(e.latlng);
                                    map.panTo(e.latlng);
                                    let koordinat = e.latlng;
                                    let str = `${koordinat}`;
                                    let str2 = str.replace("LatLng(", "");
                                    let str3 = str2.replace(")", "");
                                    let hasil = str3.split(",");
                                    document.getElementById("lat").value = hasil[0];
                                    document.getElementById("lng").value = hasil[1];
                                }
                                map.on('click', onMapClick);

                            </script>
                        </div>
                        <div class="col-md-3">
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
                        </div>
                    </div>
                    <div style="float: right;">
                        <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection