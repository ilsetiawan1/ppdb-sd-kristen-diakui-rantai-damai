<?php

namespace App\Http\Controllers;

use App\Models\BiayaDaftarUlang;
use App\Models\tahunajar;
use Illuminate\Http\Request;

class BiayaDaftarUlangController extends Controller
{
    public function index()
    {
        $tahunAjarAktif = tahunajar::where('status', 'Berlangsung')->first();

        if (!$tahunAjarAktif) {
            return redirect()->back()->with('error', 'Tidak ada tahun ajaran yang sedang berlangsung.');
        }

        $biayaDaftarUlang = BiayaDaftarUlang::where('tahun_ajaran', $tahunAjarAktif->tahun_ajar)->get();

        return view('admin.biaya-daftar-ulang.index', compact('biayaDaftarUlang', 'tahunAjarAktif'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'tahun_ajaran' => 'required|string|max:9',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,Semua',
        ]);

        BiayaDaftarUlang::create($validated);

        return redirect()->route('biaya-daftar-ulang.index')->with('success', 'Biaya berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $biaya = BiayaDaftarUlang::findOrFail($id);

        $validated = $request->validate([
            'nama_biaya' => 'required|string|max:255',
            'nominal' => 'required|numeric',
            'tahun_ajaran' => 'required|string|max:9',
            'jenis_kelamin' => 'required|in:Laki-Laki,Perempuan,Semua',
        ]);

        $biaya->update($validated);

        return redirect()->route('biaya-daftar-ulang.index')->with('success', 'Biaya berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $biaya = BiayaDaftarUlang::findOrFail($id);
        $biaya->delete();

        return redirect()->route('biaya-daftar-ulang.index')->with('success', 'Biaya berhasil dihapus.');
    }
}
