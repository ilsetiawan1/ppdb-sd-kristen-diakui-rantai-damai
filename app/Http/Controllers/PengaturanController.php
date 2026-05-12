<?php

namespace App\Http\Controllers;

use App\Models\foto;
use App\Models\User;
use App\Models\tahunajar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\HasilSeleksiNotification;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index()
    {
        $foto = foto::where('status', 'Mulai')->first();
        return view('welcome', compact('foto'));
    }

    public function pengaturan()
    {
        $latestPhoto = foto::where('status', 'Mulai')->latest()->first();
        return view('pengaturan.landingpage', compact('latestPhoto'));
    }

    public function upload(Request $request)
    {
        try {
            // Validasi file
            $request->validate([
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:3048',
            ]);

            $imageName = time() . '.' . $request->photo->extension();

            DB::beginTransaction();

            // Upload file ke storage
            if (!$request->photo->storeAs('foto', $imageName, 'public')) {
                throw new \Exception('Gagal mengunggah file.');
            }

            // Mengubah status semua foto lama menjadi 'Berakhir'
            foto::where('status', 'Mulai')->update(['status' => 'Berakhir']);

            // Simpan data foto baru ke dalam database
            $foto = new foto;
            $foto->foto = $imageName;
            $foto->status = 'Mulai';
            $foto->save();

            DB::commit();

            return redirect()->back()->with('success', 'Foto berhasil diunggah! File disimpan di storage/app/public/foto/' . $imageName);
        } catch (\Exception $e) {
            DB::rollBack();

            // Log error
            \Log::error('Error uploading foto: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat mengunggah foto. Silakan periksa apakah file memenuhi persyaratan dan coba lagi.');
        }
    }

    public function datauser()
    {
        $data = User::all();
        return view('pengaturan.datauser', compact('data'));
    }

    public function tahun()
    {
        $data = tahunajar::all();

        return view('pengaturan.tahun', compact('data'));
    }

    public function add()
    {
        return view('pengaturan.add');
    }

    public function simpan(Request $request)
    {
        $tahunajar = tahunajar::create([
            'tahun_ajar' => $request->tahun_ajar,
            'mulai_pendaftaran' => $request->mulai_pendaftaran,
            'batas_pendaftaran' => $request->batas_pendaftaran,
            'status' => $request->status,
            'tgl_seleksi' => $request->tgl_seleksi,
            'kuota' => $request->kuota,
        ]);

        return redirect()->route('beranda.tahun')->with('success', 'Data Berhasil Disimpan');
    }



    public function edit($id)
    {
        $data = tahunajar::where('id_ajar', $id)->firstOrFail();
        return view('pengaturan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = [
            'tahun_ajar' => $request->input('tahun_ajar'),
            'mulai_pendaftaran' => $request->input('mulai_pendaftaran'),
            'batas_pendaftaran' => $request->input('batas_pendaftaran'),
            'status' => $request->input('status'),
            'tgl_seleksi' => $request->input('tgl_seleksi'),
            'kuota' => $request->input('kuota'),
        ];

        tahunajar::where('id_ajar', $id)->update($data);

        return redirect()->route('beranda.tahun')->with('success', 'Data Berhasil Diperbarui');
    }

    public function delete(Request $request, $id)
    {
        $data = tahunajar::where('id_ajar', $id);
        $data->delete();
        return redirect()->route('beranda.tahun')->with('success', 'Data Berhasil Dihapus');
    }

    public function pengseleksi(Request $request)
    {
        $search = $request->input('search');

        // Cari tahun ajar yang sedang berlangsung
        $tahunAjarBerlangsung = DB::table('tahun_ajar')
            ->where('status', 'Berlangsung')
            ->first();

        // Jika tidak ada yang berlangsung, cari yang berakhir terbaru
        if (!$tahunAjarBerlangsung) {
            $tahunAjarBerakhir = DB::table('tahun_ajar')
                ->where('status', 'Berakhir')
                ->orderBy('updated_at', 'desc')
                ->first();

            $tahunAjarId = $tahunAjarBerakhir ? $tahunAjarBerakhir->id_ajar : null;
        } else {
            $tahunAjarId = $tahunAjarBerlangsung->id_ajar;
        }

        $data = DB::table('tb_casis')
            ->leftJoin('tb_seleksi', 'tb_casis.id_casis', '=', 'tb_seleksi.casis_id')
            ->leftJoin('tb_pembayaran', 'tb_casis.id_casis', '=', 'tb_pembayaran.casis_id')
            ->leftJoin('tb_pendaftaran', 'tb_casis.id_casis', '=', 'tb_pendaftaran.casis_id')
            ->where('tb_pendaftaran.status', '=', 'Berhasil')
            ->where('tb_pendaftaran.ajar_id', '=', $tahunAjarId)
            ->where('tb_casis.nama', 'LIKE', '%' . $search . '%')
            ->select(
                'tb_casis.id_casis',
                'tb_casis.nama',
                'tb_seleksi.id_seleksi',
                'tb_seleksi.nilai_baca',
                'tb_seleksi.nilai_tulis',
                'tb_seleksi.nilai_hitung',
                'tb_seleksi.nilai_ngaji',
                'tb_seleksi.nilai_wawancara',
                'tb_seleksi.total_nilai',
                'tb_seleksi.nilai_akhir',
                'tb_seleksi.hasil_seleksi',
                'tb_seleksi.status as status_seleksi'
            )
            ->get();

        return view('pengaturan.pengumuman', compact('data'));
    }

    public function updateStatusSeleksi(Request $request)
    {
        $seleksiIds = $request->input('seleksi_ids', []);

        if (!empty($seleksiIds)) {
            $casisList = DB::table('tb_seleksi')
                ->join('tb_casis', 'tb_seleksi.casis_id', '=', 'tb_casis.id_casis')
                ->whereIn('tb_seleksi.id_seleksi', $seleksiIds)
                ->select('tb_casis.*', 'tb_seleksi.hasil_seleksi')
                ->get();

            foreach ($casisList as $casis) {
                // Update status seleksi
                DB::table('tb_seleksi')
                    ->where('casis_id', $casis->id_casis)
                    ->update(['status' => 'Berhasil']);
            }

            return redirect()->back()->with('success', 'Status pengumuman berhasil diperbarui');
        } else {
            return redirect()->back()->with('error', 'Tidak ada calon siswa yang dipilih');
        }
    }
}
