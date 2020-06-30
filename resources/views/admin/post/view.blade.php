@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Detail Post</h4>
            </div>
            <div>
                <a href="/post">
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
                                <td>{{$p->pemilik}}</td>
                            </tr>
                            <tr>
                                <td>Foto Depan</td>
                                <td>:</td>
                                <td>
                                    <a target="_blank" href="/foto/{{$p->cover}}">
                                        <img src="/foto/{{$p->cover}}">
                                    </a>
                                </td>
                            </tr>
                        </table>
                        @php
                            echo '
                                <script>
                                    let l ='.$p->lat.';
                                    let b ='.$p->lng.';
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
                        <a href="/post/{{$p->id}}">
                            <button class="btn btn-inverse-info btn-fw">Edit</button>
                        </a>
                        <br/><br/>
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
                        @endif
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<a href="/post">
    <button type="button" class="btn btn-outline-danger btn-fw">
        <i class="ti-trash"></i> Hapus
    </button>
</a>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
        $("#post2").css("color", "black");
    });
</script>
@endsection