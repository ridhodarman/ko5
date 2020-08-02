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

                    Welcome <b>@php echo Auth::user()->name @endphp</b> !
                    <br/>
                    
                    <img src="{{ route('foto') }}/dll/profile.png" width="100px">
                    <a href="#">
                        <button type="button" class="btn btn-outline-secondary btn-sm">Edit Profil</button>
                    </a>
                    <br/>
                    @if (Auth::check() &&Auth::user()->role == 99 ) 
                    <a href="{{ route('post') }}">
                        <button class="btn btn-success mt-2 mb-2"><i class="fa fa-search"></i> Pergi ke halaman admin</button>
                    </a>
                    <br/>
                    @endif
                    <a href="{{ route('cari') }}">
                        <button class="btn btn-primary mt-2"><i class="fa fa-search"></i> Cari Kos / kontrakan</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
