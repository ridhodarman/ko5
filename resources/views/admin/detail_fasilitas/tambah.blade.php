@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Tambah Fasilitas Post: {{ $post->nama }}</h4>
            </div>
            <div>
                <a href="{{ route('post') }}/{{ $post->id }}">
                    <button type="button" class="btn btn-outline-info btn-fw">
                        <i class=" ti-angle-double-left "></i> Kembali ke detail post
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
                <form class="forms-sample" action="{{ route('detail_fasilitas_post') }}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Fasilitas</label>
                        <div class="col-sm-10">
                            <select class="selectpicker" data-style="btn-white btn-lg" data-width="100%"
                                data-live-search="true" name="fasilitas_posts">
                                <option></option>
                                @foreach ($fasilitas as $f)
                                <option value="{{$f->id}}">{{$f->nama}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <input type="hidden" name="post_id" class="form-control @error('post_id') is-invalid @enderror"
                        value="{{ $post->id }}">
                    @error('post_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <div style="float: right;">
                        <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection