@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Tambah Kamar: {{ $post->nama }}</h4>
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
                <form class="forms-sample" action="{{ route('kamar') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('panjang') is-invalid @enderror" 
                                    placeholder="panjang (misal: 4.5)" aria-label="Username" name="panjang">
                                    <div class="input-group-append">
                                        <span class="input-group-text">X</span>
                                    </div>
                                    <input type="text" class="form-control @error('lebar') is-invalid @enderror" 
                                    placeholder="lebar (misal: 5)" aria-label="Username" name="lebar">
                                    <div class="input-group-append">
                                        <span class="input-group-text">meter</span>
                                    </div>
                                </div>
                            </div>
                            @error('panjang')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                            @error('lebar')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-2">
                            <input type="text" class="form-control @error('jumlah') is-invalid @enderror" 
                            placeholder="jumlah kamar" name="jumlah" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                            @error('jumlah')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <input type="hidden" name="post_id" class="form-control @error('post_id') is-invalid @enderror"
                        value="{{ $post->id }}">
                    @error('post_id')
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                    @enderror
                    <br />
                    <div style="float: right;">
                        <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection