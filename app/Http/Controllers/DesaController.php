<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Menampilkan semua data desa
     */
    public function index()
    {
        $desas = Desa::with('kecamatan.kabupaten')->get();

        $desas = Desa::paginate(5);
        return view('desas.index', compact('desas'));
    }

    /**
     * Menampilkan form tambah desa
     */
    public function create()
    {
        $kecamatans = Kecamatan::with('kabupaten')->get();
        return view('desas.create', compact('kecamatans'));
    }

    /**
     * Menyimpan desa baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatans,id',
        ]);

        Desa::create($request->only('nama', 'kecamatan_id'));

        return redirect()->route('admin.desas.index')
                         ->with('success', 'Desa berhasil ditambahkan');
    }

    /**
     * Menampilkan form edit desa
     */
    public function edit(Desa $desa)
    {
        $kecamatans = Kecamatan::with('kabupaten')->get();
        return view('desas.edit', compact('desa', 'kecamatans'));
    }

    /**
     * Mengupdate data desa
     */
    public function update(Request $request, Desa $desa)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kecamatan_id' => 'required|exists:kecamatans,id',
        ]);

        $desa->update($request->only('nama', 'kecamatan_id'));

        return redirect()->route('admin.desas.index')
                         ->with('success', 'Desa berhasil diperbarui');
    }

    /**
     * Menghapus data desa
     */
    // public function destroy(Desa $desa)
    // {
    //     $desa->delete();

    //     return redirect()->route('admin.desas.index')
    //                      ->with('success', 'Desa berhasil dihapus');
    // }
    public function destroy(Desa $desa)
    {
        if ($desa->proposals()->exists()) {
            return redirect()->route('admin.desas.index')
                            ->with('error', 'Tidak bisa menghapus desa karena masih ada proposal terkait.');
        }

        $desa->delete();

        return redirect()->route('admin.desas.index')
                        ->with('success', 'Desa berhasil dihapus');
    }

}
