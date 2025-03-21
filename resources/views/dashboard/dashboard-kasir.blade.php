@extends('layouts.kasir')

@section('content')
    <h1>Kasir Dashboard</h1>
    <p>Selamat datang, {{ Auth::user()->name }}! Anda login sebagai <strong>Kasir</strong>.</p>

    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection
