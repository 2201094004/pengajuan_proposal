<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class KecamatanController extends Controller
{
    /**
     * Menampilkan daftar kecamatan
     */
    public function index()
    {
        $kecamatans = Kecamatan::with('kabupaten')->get();
        $kecamatans = Kecamatan::paginate(5);
        $kabupatens = Kabupaten::all();
        return view('kecamatans.index', compact('kecamatans', 'kabupatens'));
    }

    /**
     * Menampilkan form tambah kecamatan
     */
    public function create()
    {
        $kabupatens = Kabupaten::all();
        return view('kecamatans.create', compact('kabupatens'));
    }

    /**
     * Menyimpan kecamatan baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupatens,id',
        ]);

        Kecamatan::create($request->only('nama', 'kabupaten_id'));

        return redirect()->route('admin.kecamatans.index')
                         ->with('success', 'Kecamatan berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit kecamatan
     */
    public function edit(Kecamatan $kecamatan)
    {
        $kabupatens = Kabupaten::all();
        return view('kecamatans.edit', compact('kecamatan', 'kabupatens'));
    }

    /**
     * Menyimpan perubahan pada kecamatan
     */
    public function update(Request $request, Kecamatan $kecamatan)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kabupaten_id' => 'required|exists:kabupatens,id',
        ]);

        $kecamatan->update($request->only('nama', 'kabupaten_id'));

        return redirect()->route('admin.kecamatans.index')
                         ->with('success', 'Kecamatan berhasil diperbarui');
    }

    /**
     * Menghapus kecamatan
     */
    public function destroy(Kecamatan $kecamatan)
    {
        $kecamatan->delete();

        return redirect()->route('admin.kecamatans.index')
                         ->with('success', 'Kecamatan berhasil dihapus');
    }
}
