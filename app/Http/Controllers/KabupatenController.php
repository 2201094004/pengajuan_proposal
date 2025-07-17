<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
    /**
     * Menampilkan semua data kabupaten
     */
    public function index()
    {
        $kabupatens = Kabupaten::all();
        return view('kabupatens.index', compact('kabupatens'));
    }

    /**
     * Menampilkan form tambah kabupaten
     */
    public function create()
    {
        return view('kabupatens.create');
    }

    /**
     * Menyimpan data kabupaten baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        Kabupaten::create($request->only('nama'));

        return redirect()->route('kabupatens.index')
                         ->with('success', 'Kabupaten berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit kabupaten
     */
    public function edit(Kabupaten $kabupaten)
    {
        return view('kabupatens.edit', compact('kabupaten'));
    }

    /**
     * Mengupdate data kabupaten
     */
    public function update(Request $request, Kabupaten $kabupaten)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
        ]);

        $kabupaten->update($request->only('nama'));

        return redirect()->route('kabupatens.index')
                         ->with('success', 'Kabupaten berhasil diperbarui');
    }

    /**
     * Menghapus data kabupaten
     */
    public function destroy(Kabupaten $kabupaten)
    {
        $kabupaten->delete();

        return redirect()->route('kabupatens.index')
                         ->with('success', 'Kabupaten berhasil dihapus');
    }
}
