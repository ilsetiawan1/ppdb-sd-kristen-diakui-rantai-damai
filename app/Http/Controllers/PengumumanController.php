<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\casis;
use App\Models\selekasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengumumanController extends Controller
{
    public function index()
{
    $user = auth()->user(); // Mendapatkan user yang sedang login
    $casis = $user->casis; // Mendapatkan data casis dari user yang sedang login

    if ($casis) {
        $data = selekasi::with('casis')
            ->where('casis_id', $casis->id_casis)
            ->where('status', 'Berhasil') // Hanya mengambil data seleksi dengan status 'Berhasil'
            ->get();
    } else {
        $data = collect(); // Jika tidak ada data casis, kembalikan koleksi kosong
    }

    // Menambahkan variabel untuk mengecek apakah pengumuman sudah tersedia
    $pengumumanTersedia = $data->isNotEmpty();

    return view('pengumuman.index', compact('data', 'pengumumanTersedia'));
}

    // public function unduh($id)
    // {
    //     $data = DB::table('tb_casis')
    //     ->join('tb_seleksi', 'tb_casis.id_casis', '=', 'tb_seleksi.casis_id')
    //     ->where('tb_casis.id_casis', $id)
    //         ->first();

    //     return view('pengumuman.unduh', compact('data'));
    // }

    public function unduh($id)
    {
        // Ambil data casis dan seleksi berdasarkan id
        $data = DB::table('tb_casis')
        ->join('tb_seleksi', 'tb_casis.id_casis', '=', 'tb_seleksi.casis_id')
        ->where('tb_casis.id_casis', $id)
            ->first();

        // Pastikan data ditemukan
        if (!$data) {
            return redirect()->back()->with('error', 'Data tidak ditemukan.');
        }

        // Render view ke dalam PDF
        $pdf = Pdf::loadView('pengumuman.unduh', compact('data'));

        return $pdf->download('pengumuman_casis_' . $id . '.pdf');
    }

}
