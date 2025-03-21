@extends('layouts.pelanggan')

@section('content')
    <h1>Pelanggan Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <strong>Pelanggan</strong>.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
