@extends('admin.inc.layout')
@section('isi')
<div class="row">
    <div class="col-md-12 grid-margin">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="font-weight-bold mb-0">Tambah Harga: {{ $post->nama }}</h4>
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
                <form class="forms-sample" action="{{ route('harga') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Rp</span>
                                    </div>
                                    <input type="text" class="form-control @error('harga') is-invalid @enderror" placeholder="harga" aria-label="Username" 
                                        name="harga" id="harga" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')">
                                    <div class="input-group-append">
                                        <span class="input-group-text">,00</span>
                                    </div>
                                </div>
                            </div>
                            @error('harga')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <div class="col-sm-10">
                                <select class="form-control" style="color: black;">
                                    <option value="tahun" onclick="pembayarannya('tahun')">per tahun</option>
                                    <option value="6 bulan" onclick="pembayarannya('6 bulan')">per 6 bulan</option>
                                    <option value="bulan" onclick="pembayarannya('bulan')">per bulan</option>
                                    <option value="minggu" onclick="pembayarannya('minggu')">per minggu</option>
                                    <option value="hari" onclick="pembayarannya('hari')">per hari</option>
                                    <option onclick="pembayarannya('null')">dan lain-lain</option>
                                </select>
                                <input type="text" class="form-control @error('pembayaran') is-invalid @enderror" 
                                    name="pembayaran" placeholder="misal: 3 bulan" id="pembayaran">
                                <script>
                                    $( "#pembayaran" ).hide();
                                    function pembayarannya(value) {
                                        if (value == 'null'){
                                            document.getElementById("pembayaran").value="";
                                            $( "#pembayaran" ).show();
                                        }
                                        else {
                                            document.getElementById("pembayaran").value=value;
                                            $( "#pembayaran" ).hide();
                                        }
                                    }
                                </script>
                            </div>
                            @error('pembayaran')
                            <div class="alert alert-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="col-sm-4">
                            <input type="text" class="form-control @error('keterangan') is-invalid @enderror" placeholder="keterangan *opsional (misal: bisa nego)" name="keterangan">
                            @error('keterangan')
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