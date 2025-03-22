<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggan = Pelanggan::all();
        return view('admin.pelanggan.index', compact('pelanggan'));
    }

    public function create()
    {
        return view('admin.pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|unique:pelanggan,email',
        ]);

        Pelanggan::create([
            'kode_pelanggan' => 'PLG-' . Str::upper(Str::random(6)),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
        ]);

        return redirect('/pelanggan')->with('success', 'Pelanggan berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        return view('admin.pelanggan.edit', compact('pelanggan'));
    }

    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_telp' => 'required|string|max:15',
            'email' => 'required|email|unique:pelanggan,email,' . $pelanggan->id,
        ]);

        $pelanggan->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
            'email' => $request->email,
        ]);

        return redirect('/pelanggan')->with('success', 'Pelanggan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pelanggan = Pelanggan::findOrFail($id);
        $pelanggan->delete();
        return redirect('/pelanggan')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
