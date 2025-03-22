@extends('layouts.kasir')

@section('content')
<div class="container mt-5">
    <div class="text-center">
        <h1 class="fw-bold text-primary">Kasir Dashboard</h1>
        <p class="lead">Selamat datang, <strong>{{ Auth::user()->name }}</strong>!</p>
    </div>

    <!-- Card Dashboard -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">👨‍💼 Anda login sebagai</h5>
                    <span class="badge bg-primary fs-5">Kasir</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Tombol Logout -->
    <div class="text-center mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger shadow-sm">Logout</button>
        </form>
    </div>
</div>
@endsection
