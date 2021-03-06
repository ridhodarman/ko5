@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Edit Fasilitas:
                    <font color="gray"> {{ $fasilitas_post->nama }} </font>
                </h4>
            </div>
            <div>
                <a href="{{ route('fasilitas') }}/{{ $fasilitas_post->id }}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke detail fasilitas
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
                        <label class="col-sm-2 col-form-label">Nama Fasilitas</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $fasilitas_post->nama) }}">
                            @error('nama')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                            <input type="hidden" value="{{ $fasilitas_post->id }}">
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