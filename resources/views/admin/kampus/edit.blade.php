@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Edit Kampus:
                    <font color="gray"> {{ $kampus_sekolah->nama }} </font>
                </h4>
            </div>
            <div>
                <a href="{{ route('kampus') }}/{{ $kampus_sekolah->id }}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke detail kampus
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
                <form class="forms-sample" action="" method="post">
                    @method('patch')
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Kampus</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $kampus_sekolah->nama) }}">
                            @error('nama')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                            <input type="hidden" value="{{ $kampus_sekolah->id }}">
                        </div>
                    </div>
                    @php
                        echo "
                            <script>
                                let l = ".old('lat', $kampus_sekolah->lat) .";
                                let b = ". old('lng', $kampus_sekolah->lng) .";
                            </script>
                        ";
                    @endphp
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Lokasi Kampus</label>
                        <div class="col-md-7">
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
                                    center: [l, b],
                                    zoom: 16
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

                                var myMarker = L.marker([l, b], { title: "MyPoint", alt: "The Big I", draggable: true })
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
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="exampleInputPassword1">Lintang</label>
                                <input type="text" class="form-control @error('lat') is-invalid @enderror" id="lat"
                                    name="lat" placeholder="0.xxxx" value="{{ old('lat', $kampus_sekolah->lat) }}">
                                @error('lat')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputConfirmPassword1">Bujur</label>
                                <input type="text" class="form-control @error('lng') is-invalid @enderror" id="lng"
                                    name="lng" placeholder="100.000" value="{{ old('lng', $kampus_sekolah->lng) }}">
                                @error('lng')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div style="float: right;">
                        <button type="submit" class="btn btn-outline-primary btn-fw">
                            <i class="ti-save"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection