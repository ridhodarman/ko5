@extends('admin.inc.layout') @section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Daftar Fasilitas</h4>
            </div>
            <div>
                <a href="{{ route('fasilitas') }}/tambah">
                    <button type="button" class="btn btn-primary btn-icon-text btn-rounded">
                        <i class="ti-clipboard btn-icon-prepend"></i>Tambah
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>

@if (session('fasilitas'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {!! session('fasilitas') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@elseif (session('fasilitas-hapus'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {!! session('fasilitas-hapus') !!}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <table id="example" class="table table-striped table-bordered table-hover display" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Fasilitas</th>
                            <th>-</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fasilitas as $s)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$s->nama}}</td>
                            <td>
                                <a href="fasilitas/{{$s->id}}">
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
<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>
@endsection