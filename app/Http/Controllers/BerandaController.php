<?php

namespace App\Http\Controllers;

use App\Models\DaftarUlang;
use App\Models\selekasi;
use App\Models\tahunajar;
use App\Models\pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BerandaController extends Controller
{
    public function index()
    {
        // Mengambil total pendaftar
        $totalPendaftar = Pendaftaran::count();

        // Mengambil total pendaftar diterima
        $totalDiterima = selekasi::where('hasil_seleksi', 'Lolos')->count();

        // Mengambil total pendaftar ditolak
        $totalDitolak = selekasi::where('hasil_seleksi', 'Tidak Lolos')->count();

        $tahunAjaranBerlangsung = tahunajar::where('status', 'Berlangsung')->first();

        if (!$tahunAjaranBerlangsung) {
            $tahunAjaranBerlangsung = tahunajar::where('status', 'Berakhir')->orderBy('tahun_ajar', 'desc')->first();
        }

        $tahunAjaranString = 'Tidak ada data tahun ajaran';
        $kuotaTotal = 0;
        $kuotaTerisi = 0;
        $kuotaTersisa = 0;

        if ($tahunAjaranBerlangsung) {
            $tahunAjaranString = $tahunAjaranBerlangsung->tahun_ajar;
            $kuotaTotal = $tahunAjaranBerlangsung->kuota;
            $kuotaTerisi = $totalDiterima;
            $kuotaTersisa = $kuotaTotal - $kuotaTerisi;
        }

        return view('beranda', compact('totalPendaftar', 'totalDiterima', 'totalDitolak', 'tahunAjaranString', 'kuotaTotal', 'kuotaTerisi', 'kuotaTersisa'));
    }


    public function berandacasis()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // Mengambil tahun ajaran yang sedang berlangsung atau berakhir terbaru
        $tahunajar = tahunajar::where('status', 'Berlangsung')->first();

        if (!$tahunajar) {
            $tahunajar = tahunajar::where('status', 'Berakhir')->orderBy('tahun_ajar', 'desc')->first();
        }

        // Kirim data ke view
        return view('berandacasis', compact('tahunajar'));
    }

    public function berandapanitia()
    {
        // Mengambil tahun ajaran yang sedang berlangsung atau berakhir terbaru
        $tahunAjaranBerlangsung = tahunajar::where('status', 'Berlangsung')->first();

        if (!$tahunAjaranBerlangsung) {
            $tahunAjaranBerlangsung = tahunajar::where('status', 'Berakhir')->orderBy('tahun_ajar', 'desc')->first();
        }

        // Initialize variables
        $tahunAjaranString = 'Tidak ada data tahun ajaran';
        $kuotaTotal = 0;
        $kuotaTerisi = 0;
        $kuotaTersisa = 0;
        $totalPendaftar = 0;
        $totalDiterima = 0;
        $totalDitolak = 0;

        if ($tahunAjaranBerlangsung) {
            $tahunAjaranString = $tahunAjaranBerlangsung->tahun_ajar;
            $kuotaTotal = $tahunAjaranBerlangsung->kuota;

            // Mengambil total pendaftar
            $totalPendaftar = pendaftaran::where('ajar_id', $tahunAjaranBerlangsung->id_ajar)->count();

            // Mengambil total pendaftar diterima
            $totalDiterima = DaftarUlang::where('tahun_ajaran', $tahunAjaranString)
                ->where('status_bayar', 'Berhasil')
                ->count();

            // Mengambil total pendaftar ditolak
            $totalDitolak = pendaftaran::whereHas('seleksi', function ($query) {
                $query->where('hasil_seleksi', 'Tidak Lolos');
            })->where('ajar_id', $tahunAjaranBerlangsung->id_ajar)->count();

            // Menghitung pendaftar yang belum ada hasil seleksi dan belum daftar ulang
            $belumAdaHasil = pendaftaran::where('ajar_id', $tahunAjaranBerlangsung->id_ajar)
                ->whereDoesntHave('seleksi')
                ->where('status_daftar_ulang', 'Belum')
                ->count();

            // Menambahkan ke total ditolak
            $totalDitolak += $belumAdaHasil;

            // Menghitung kuota terisi
            $kuotaTerisi = $totalDiterima;

            // Menghitung kuota tersisa
            $kuotaTersisa = $kuotaTotal - $kuotaTerisi;
        }

        // Mengambil 5 casis dengan nilai tertinggi yang lolos
        $casisTertinggi = selekasi::where('hasil_seleksi', 'Lolos')
            ->orderBy('nilai_akhir', 'desc')
            ->with('casis')
            ->take(5)
            ->get();

        return view('berandapanitia', compact(
            'totalPendaftar',
            'totalDiterima',
            'totalDitolak',
            'casisTertinggi',
            'tahunAjaranString',
            'kuotaTotal',
            'kuotaTerisi',
            'kuotaTersisa'
        ));
    }
}
