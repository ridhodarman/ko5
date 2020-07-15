@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0"> </h4>
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
@foreach ($kampus as $k)
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">
                            Informasi Kampus</p>
                        <table class="table table-hover">
                            <tr>
                                <td>Nama Kampus</td>
                                <td>:</td>
                                <td>{{$k->nama}}</td>
                            </tr>
                            <tr>
                                <td>Dibuat Pada</td>
                                <td>:</td>
                                <td>{{$k->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Terakhir diubah</td>
                                <td>:</td>
                                <td>{{$k->updated_at}}</td>
                            </tr>
                            @php
                            echo '
                            <script>
                                let l = '.$k->lat.';
                                let b = '.$k->lng.';
                            </script>
                            ';
                            @endphp
                        </table>
                    </div>
                    <div class="col-md-6">
                        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css" />
                        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"></script>
                        <style type="text/css">
                            #peta {
                                height: 45vh;
                            }
                        </style>
                        <br /><br />
                        <div id="peta"></div>

                        <script type="text/javascript">
                            var mapOptions = {
                                center: [l, b],
                                zoom: 15
                            }

                            var peta = new L.map('peta', mapOptions);

                            L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                                maxZoom: 19,
                                id: 'mapbox.streets',
                                accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
                            }).addTo(peta);
                            var Stamen_TonerLabels = L.tileLayer('https://stamen-tiles-{s}.a.ssl.fastly.net/toner-labels/{z}/{x}/{y}{r}.{ext}', {
                                attribution: '<a href="http://stamen.com">Stamen Design</a>',
                                subdomains: 'abcd',
                                minZoom: 0,
                                maxZoom: 19,
                                ext: 'png'
                            }).addTo(peta);

                            var marker = new L.Marker([l, b]);
                            marker.addTo(peta);
                        </script>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('kampus') }}/{{$k->id}}" method="POST" class="d-inline">
    @method('delete')
    @csrf
    <button type="button" class="btn btn-outline-danger btn-fw" id="tombol-hapus">
        <i class="ti-trash"></i> Hapus
    </button>
</form>

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

<a href="{{ route('kampus') }}/{{$k->id}}/edit">
    <button type="button" class="btn btn-outline-warning btn-fw">
        <i class="ti-edit"></i> Edit
    </button>
</a>
@endforeach
@endsection