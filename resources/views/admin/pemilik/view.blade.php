@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0"> </h4>
            </div>
            <div>
                <a href="{{ route('pemilik') }}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke daftar pemilik
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
@foreach ($pemilik as $k)
<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">
                            Informasi Pemilik</p>
                        <table class="table table-hover">
                            @php $n=1 @endphp
                            @foreach ($pemilik as $k)
                            @if ($n==1)
                            <tr>
                                <td>Nama Pemilik</td>
                                <td>:</td>
                                <td>{{$k->nama}}</td>
                            </tr>
                            <tr>
                                <td>Kontak</td>
                                <td>:</td>
                                <td>{{$k->kontak}}</td>
                            </tr>
                            <tr>
                                <td>Deskripsi</td>
                                <td>:</td>
                                <td>{{$k->deskripsi}}</td>
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
                            @endif
                            @php $n=$n+1 @endphp
                            @endforeach
                            <tr>
                                <td>Post</td>
                                <td>:</td>
                                <td>
                                    @foreach ($pemilik as $k)
                                    <a href="{{ route('post') }}/{{$k->post_id}}">{{$k->post}}</a>&emsp;
                                    @endforeach
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('pemilik') }}/{{$k->id}}" method="POST" class="d-inline">
    @method('delete')
    @csrf
    <button type="button" class="btn btn-outline-danger btn-fw" id="tombol-hapus">
        <i class="ti-trash"></i> Hapus
    </button>
</form>

<script>
    let peringatan=true;
    $('#tombol-hapus').on('click', function (e) {
        if(peringatan==true){
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
                        $('#tombol-hapus').trigger( "click" );
                    }
                });
        }
    });
</script>

<a href="{{ route('pemilik') }}/{{$k->id}}/edit">
    <button type="button" class="btn btn-outline-warning btn-fw">
        <i class="ti-edit"></i> Edit
    </button>
</a>
@endforeach
<script type="text/javascript">

    $(document).ready(function () {
        $('#example').DataTable();
        $("#post2").css("color", "black");
        $( "#kelola" ).addClass( "active" );
        $( "#pemilik_post" ).css("color", "black");
    });
</script>
@endsection