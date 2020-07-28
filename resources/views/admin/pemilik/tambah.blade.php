@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Tambah Pemilik</h4>
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

<div class="row">
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <form class="forms-sample" action="{{ route('pemilik') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Nama Pemilik</label>
                        <div class="col-sm-10">
                            <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                                value="{{ old('nama') }}">
                            @error('nama')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Kontak</label>
                        <div class="col-sm-10">
                            <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
                                value="{{ old('kontak') }}">
                            @error('kontak')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <label class="col-sm-2 col-form-label">Akun User</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                data-live-search="true" name="user_id">
                                <option></option>
                                @foreach ($user as $u)
                                <option value="{{$u->id}}">{{$u->name}} ({{$u->email}})</option>
                                @endforeach
                            </select>
                        </div>
                        <label class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror"
                                >{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
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