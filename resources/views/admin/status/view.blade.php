@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Detail Post</h4>
            </div>
            <div>
                <a href="/status">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke status post
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
                @foreach ($status as $s)
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">
                            Detail</p>
                        <table class="table table-hover">
                            <tr>
                                <td>Status</td>
                                <td>:</td>
                                <td>{{$s->nama}}</td>
                            </tr>
                            <tr>
                                <td>Dibuat Pada</td>
                                <td>:</td>
                                <td>{{$s->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Terakhir diubah</td>
                                <td>:</td>
                                <td>{{$s->updated_at}}</td>
                            </tr>
                            <tr>
                                <td>Jumlah Post</td>
                                <td>:</td>
                                <td>{{$s->jumlah}}</td>
                            </tr>
                        </table>
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
<a href="/post">
    <button type="button" class="btn btn-outline-warning btn-fw">
        <i class="ti-edit"></i> Edit
    </button>
</a>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
        $("#post2").css("color", "black");
    });
</script>
@endsection