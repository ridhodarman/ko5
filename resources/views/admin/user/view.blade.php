@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0"> </h4>
            </div>
            <div>
                <a href="{{ route('user') }}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke daftar user
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
                <div class="row">
                    <div class="col-md-6">
                        <p class="card-title text-md-center text-xl-left" style="color: black; font-weight: bolder;">
                            Informasi User</p>
                        <table class="table table-hover">
                            <tr>
                                <td>Nama</td>
                                <td>:</td>
                                <td>{{$user->name}}</td>
                            </tr>
                            <tr>
                                <td>No. HP</td>
                                <td>:</td>
                                <td>{{$user->no_hp}}</td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td>:</td>
                                <td>{{$user->email}}</td>
                            </tr>
                            <tr>
                                <td>Email Verified at</td>
                                <td>:</td>
                                <td>{{$user->email_verified_at}}</td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td>:</td>
                                <td>
                                    @if ($user->role == 99)
                                        <span class="badge badge-danger bundar">admin</span>
                                    @elseif ($user->role == 1)
                                        <span class="badge badge-primary bundar">VIP user</span>
                                    @elseif ($user->role == 2)
                                        <span class="badge badge-secondary bundar">pemilik kos/ kontrakan</span>
                                    @else
                                        <span class="badge badge-light bundar">regular user</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>Dibuat Pada</td>
                                <td>:</td>
                                <td>{{$user->created_at}}</td>
                            </tr>
                            <tr>
                                <td>Terakhir diubah</td>
                                <td>:</td>
                                <td>{{$user->updated_at}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="{{ route('user') }}/{{$user->id}}" method="POST" class="d-inline">
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

<a href="{{ route('user') }}/{{$user->id}}/edit">
    <button type="button" class="btn btn-outline-warning btn-fw">
        <i class="ti-edit"></i> Edit Data
    </button>
</a>

<a href="{{ route('user') }}/{{$user->id}}">
    <button type="button" class="btn btn-outline-info btn-fw">
        <i class="ti-edit"></i> Ganti Foto
    </button>
</a>

<a href="{{ route('user') }}/{{$user->id}}">
    <button type="button" class="btn btn-outline-secondary btn-fw">
        <i class="ti-edit"></i> Reset Password
    </button>
</a>

<script type="text/javascript">

    $(document).ready(function () {
        $('#example').DataTable();
        $("#post2").css("color", "black");
        $( "#kelola" ).addClass( "active" );
        $( "#user_post" ).css("color", "black");
    });
</script>
@endsection