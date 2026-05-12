<?php

namespace App\Http\Controllers;

use App\Models\DaftarUlang;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PanitiaDaftarUlangController extends Controller
{
    public function index(Request $request)
    {
        $query = DaftarUlang::with('pendaftaran.casis');

        if ($request->has('search')) {
            $search = $request->search;
            $query->whereHas('pendaftaran.casis', function ($q) use ($search) {
                $q->where('nama', 'like', "%$search%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $query->where('status_bayar', $request->status);
        }

        $daftarUlang = $query->latest('tgl_daftar_ulang')->paginate(10);

        return view('panitia.daftar_ulang.index', compact('daftarUlang'));
    }

    public function show($id)
    {
        $daftarUlang = DaftarUlang::with('pendaftaran.casis')->findOrFail($id);
        return view('panitia.daftar_ulang.show', compact('daftarUlang'));
    }

    public function update(Request $request, $id)
    {
        $daftarUlang = DaftarUlang::findOrFail($id);

        $validated = $request->validate([
            'status_bayar' => 'required|in:Berhasil,Menunggu Konfirmasi,Gagal',
            'keterangan' => 'nullable|string',
        ]);

        $daftarUlang->update($validated);

        if ($validated['status_bayar'] === 'Berhasil') {
            $daftarUlang->pendaftaran->status_daftar_ulang = 'Sudah';
            $daftarUlang->pendaftaran->save();
        } else {
            $daftarUlang->pendaftaran->status_daftar_ulang = 'Belum';
            $daftarUlang->pendaftaran->save();
        }


        return redirect()->route('panitia.daftar_ulang.index')->with('success', 'Status daftar ulang berhasil diupdate.');
    }


    public function laporanDaftarUlang(Request $request)
    {
        $query = DaftarUlang::with('pendaftaran.casis');

        if ($request->has('start_date') && $request->has('end_date')) {
            $query->whereBetween('tgl_daftar_ulang', [$request->start_date, $request->end_date]);
        }

        $daftarUlang = $query->latest('tgl_daftar_ulang')->get();

        return view('laporan.daftar-ulang.index', compact('daftarUlang'));
    }

    public function cetak(Request $request)
    {
        $query = DaftarUlang::with('pendaftaran.casis');

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        if ($startDate && $endDate) {
            $query->whereBetween('tgl_daftar_ulang', [$startDate, $endDate]);
            $periodText = "Periode: " . date('d/m/Y', strtotime($startDate)) . " sampai " . date('d/m/Y', strtotime($endDate));
        } else {
            $periodText = "Periode: Seluruh Data";
        }

        $daftarUlang = $query->latest('tgl_daftar_ulang')->get();

        return view('laporan.daftar-ulang.cetak', compact('daftarUlang', 'periodText'));
    }
}
