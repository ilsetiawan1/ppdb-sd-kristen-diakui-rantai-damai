<?php

namespace App\Http\Controllers;

use App\Models\DaftarUlang;
use App\Models\Pendaftaran;
use App\Models\BiayaDaftarUlang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CalonSiswaDaftarUlangController extends Controller
{
    public function show()
    {
        $user = auth()->user();
        $casis = $user->casis;

        if (!$casis) {
            return view('casis.daftar_ulang.show', [
                'error' => 'Anda belum melakukan pendaftaran. Silakan lengkapi pendaftaran terlebih dahulu.'
            ]);
        }

        $seleksi = \App\Models\selekasi::where('casis_id', $casis->id_casis)->first();

        if (!$seleksi) {
            return view('casis.daftar_ulang.show', [
                'error' => 'Data seleksi Anda belum tersedia. Silakan hubungi panitia untuk informasi lebih lanjut.'
            ]);
        }

        $pendaftaran = $casis->pendaftaran;

        if (!$pendaftaran) {
            return view('casis.daftar_ulang.show', [
                'error' => 'Data pendaftaran Anda tidak ditemukan. Silakan hubungi panitia untuk bantuan.'
            ]);
        }

        $daftarUlang = DaftarUlang::where('pendaftaran_id', $pendaftaran->id_pendaftaran)->first();

        $tahunAjaran = $pendaftaran->tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1);

        $biayaComponents = BiayaDaftarUlang::where('tahun_ajaran', $tahunAjaran)
            ->where(function ($query) use ($casis) {
                $query->where('jenis_kelamin', $casis->jenis_kelamin)
                    ->orWhere('jenis_kelamin', 'Semua');
            })
            ->where('is_active', 1)
            ->get();

        $totalBiaya = $biayaComponents->sum('nominal');

        return view('casis.daftar_ulang.show', compact('seleksi', 'daftarUlang', 'biayaComponents', 'totalBiaya'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            $casis = auth()->user()->casis;
            if (!$casis) {
                throw new \Exception('Data calon siswa tidak ditemukan.');
            }

            $pendaftaran = Pendaftaran::where('casis_id', $casis->id_casis)
                ->where('status', 'Berhasil')
                ->first();

            if (!$pendaftaran) {
                throw new \Exception('Data pendaftaran tidak ditemukan atau belum berstatus Berhasil.');
            }

            if ($pendaftaran->status_daftar_ulang === 'Sudah') {
                throw new \Exception('Anda sudah melakukan daftar ulang sebelumnya.');
            }

            $tahunAjaran = $pendaftaran->tahun_ajaran ?? date('Y') . '/' . (date('Y') + 1);

            $totalBiaya = BiayaDaftarUlang::where('tahun_ajaran', $tahunAjaran)
                ->where(function ($query) use ($casis) {
                    $query->where('jenis_kelamin', $casis->jenis_kelamin)
                        ->orWhere('jenis_kelamin', 'Semua');
                })
                ->where('is_active', 1)
                ->sum('nominal');

            // Hapus titik dari jumlah_bayar
            $jumlahBayar = (int) str_replace('.', '', $request->jumlah_bayar);

            $validated = $request->validate([
                'metode_pembayaran' => 'required|in:DP 50%,Lunas',
                'jumlah_bayar' => [
                    'required',
                    function ($attribute, $value, $fail) use ($totalBiaya, $jumlahBayar) {
                        if ($jumlahBayar < $totalBiaya * 0.5) {
                            $fail('Pembayaran minimum adalah 50% dari total biaya.');
                        } elseif ($jumlahBayar > $totalBiaya) {
                            $fail('Pembayaran tidak boleh melebihi total biaya.');
                        }
                    },
                ],
                'bukti_pembayaran' => 'required|image|max:2048',
            ]);

            $daftarUlang = new DaftarUlang();
            $daftarUlang->pendaftaran_id = $pendaftaran->id_pendaftaran;
            $daftarUlang->tahun_ajaran = $tahunAjaran;
            $daftarUlang->tgl_daftar_ulang = now();
            $daftarUlang->total_biaya = $totalBiaya;
            $daftarUlang->metode_pembayaran = $validated['metode_pembayaran'] === 'DP 50%' ? 'Cicilan' : 'Lunas';
            $daftarUlang->jumlah_bayar = $jumlahBayar;
            $daftarUlang->status_bayar = 'Menunggu Konfirmasi';

            if ($request->hasFile('bukti_pembayaran')) {
                $file = $request->file('bukti_pembayaran');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('bukti_pembayaran', $fileName, 'public');
                $daftarUlang->bukti_pembayaran = $filePath;
            }

            $daftarUlang->save();

            DB::commit();

            return redirect()->route('calon_siswa.daftar_ulang.show')->with('success', 'Daftar ulang berhasil disubmit. Silakan tunggu konfirmasi dari panitia.');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error saat daftar ulang: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data: ' . $e->getMessage());
        }
    }

    public function print()
    {
        $casis = auth()->user()->casis;
        $daftarUlang = DaftarUlang::where('pendaftaran_id', $casis->pendaftaran->id_pendaftaran)->first();

        if (!$daftarUlang) {
            return redirect()->back()->with('error', 'Data daftar ulang tidak ditemukan.');
        }

        return view('casis.daftar_ulang.print', compact('daftarUlang', 'casis'));
    }
}
