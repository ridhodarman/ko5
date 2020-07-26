@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body" style="text-align: center;">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br/>
                    <a href="#">
                        <button class="btn btn-block btn-primary mt-5"><i class="fa fa-search"></i> Ubah profil</button>
                    </a>

                    @if (Auth::check() &&Auth::user()->role == 99 ) 
                    <a href="{{ route('post') }}">
                        <button class="btn btn-block btn-primary mt-5"><i class="fa fa-search"></i> Pergi ke halaman admin</button>
                    </a>
                    @endif
                    <a href="{{ route('cari') }}">
                        <button class="btn btn-block btn-primary mt-5"><i class="fa fa-search"></i> Pergi ke halaman user</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
