@extends('admin.inc.layout') @section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Daftar User</h4>
            </div>
            <div>
                <a href="{{ route('user') }}/tambah">
                    <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                        <i class="ti-clipboard btn-icon-prepend"></i>Tambah
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

@if (session('status'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('status') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif (session('status-hapus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('status-hapus') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <style>
                        .bundar{
                            border-radius: 25px;
                        }
                    </style>
                    <table id="example" class="table table-striped table-bordered table-hover display"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>-</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{$u->name}}</td>
                                <td>{{$u->email}}</td>
                                <td>
                                    @if ($u->role == 99)
                                        <span class="badge badge-danger bundar">admin</span>
                                    @elseif ($u->role == 1)
                                        <span class="badge badge-primary bundar">VIP user</span>
                                    @elseif ($u->role == 2)
                                        <span class="badge badge-secondary bundar">pemilik kos/ kontrakan</span>
                                    @else
                                        <span class="badge badge-light bundar">regular user</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('user') }}/{{$u->id}}">
                                        <button class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit"></i>
                                            <b>D E T A I L</b>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection