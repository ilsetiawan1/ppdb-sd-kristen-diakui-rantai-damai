<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\casis;
use App\Models\panitia;
use App\Models\selekasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PanitiaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = panitia::with('user');

        if ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nama', 'like', '%' . $search . '%');
            });
        }

        $data = $query->get();

        return view('panitia.index', compact('data', 'search'));
    }

    public function add()
    {
        return view('panitia.add');
    }

    public function proses(Request $request)
    {
        // Proses menyimpan data user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'Panitia',
        ]);

        //menyimpan data calon siswa
        $panitia = panitia::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status' => $request->status,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('datapanitia')->with('success', 'Data Berhasil Disimpan');
    }

    public function edit($id)
    {
        $data = panitia::where('id_panitia', $id)->firstOrFail();
        return view('panitia.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = panitia::with('user')->find($id);
        if (!$data) {
            return redirect()->route('datapanitia')->with('error', 'Data not found.');
        }

        $data->user->name = $request->name;
        $data->user->email = $request->email;
        if ($request->password) {
            $data->user->password = bcrypt($request->password);
        }
        $data->user->save();

        $data->nama = $request->nama;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->status = $request->status;
        $data->save();

        return redirect()->route('datapanitia')->with('success', 'Data Berhasil Diperbarui');
    }

    public function delete(Request $request, $id)
    {
        $data = User::where('id', $id);
        $data->delete();
        return Redirect('/data/panitia')->with('delete', 'Data Berhasil Dihapus');
    }

    public function nilai(Request $request)
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
            ->where('tb_pembayaran.status_pembayaran', '=', 'Lunas') // Hanya muncul jika pembayaran lunas
            ->where('tb_pendaftaran.ajar_id', '=', $tahunAjarId) // Filter berdasarkan tahun ajar
            ->where('tb_casis.nama', 'LIKE', '%' . $search . '%')
            ->select(
                'tb_casis.id_casis',
                'tb_casis.nama',
                'tb_seleksi.nilai_baca',
                'tb_seleksi.nilai_tulis',
                'tb_seleksi.nilai_hitung',
                'tb_seleksi.nilai_wawancara',
                'tb_seleksi.total_nilai',
                'tb_seleksi.nilai_akhir',
                'tb_seleksi.hasil_seleksi'
            )
            ->get();

        return view('panitia.datanilai', compact('data'));
    }

    public function input(Request $request, $id)
    {
        $data = casis::with(['seleksi'])->where('id_casis', $id)->first();
        $seleksi = $data->seleksi->first();
        return view('panitia.inputnilai', compact('data', 'seleksi'));
    }

    public function simpan(Request $request, $id)
    {
        // Validasi data dari request
        $validatedData = $request->validate([
            'nilai_baca' => 'required|numeric',
            'nilai_tulis' => 'required|numeric',
            'nilai_hitung' => 'required|numeric',
            'nilai_wawancara' => 'required|numeric',
            'tgl_seleksi' => 'required|date',
        ]);

        // Temukan data casis berdasarkan id_casis
        $casis = Casis::with(['pendaftaran', 'seleksi'])->where('id_casis', $id)->first();

        // Hitung total_nilai
        $total_nilai = $validatedData['nilai_baca'] + $validatedData['nilai_tulis'] + $validatedData['nilai_hitung'] + $validatedData['nilai_wawancara'];

        // Hitung nilai_akhir
        $nilai_akhir = $total_nilai / 4;

        // Tentukan hasil_seleksi
        $hasil_seleksi = $nilai_akhir > 74 ? 'Lolos' : 'Tidak Lolos';

        // Dapatkan pendaftaran_id dari tabel pendaftaran
        $pendaftaran_id = $casis->pendaftaran->id_pendaftaran;

        // Periksa apakah data seleksi sudah ada
        $seleksi = $casis->seleksi->first();

        if ($seleksi) {
        $seleksi->update([
            'nilai_baca' => $validatedData['nilai_baca'],
            'nilai_tulis' => $validatedData['nilai_tulis'],
            'nilai_hitung' => $validatedData['nilai_hitung'],
            'nilai_wawancara' => $validatedData['nilai_wawancara'],
            'tgl_seleksi' => $validatedData['tgl_seleksi'],
            'total_nilai' => $total_nilai,
            'nilai_akhir' => $nilai_akhir,
            'hasil_seleksi' => $hasil_seleksi,
            'pendaftaran_id' => $pendaftaran_id,
            'status' => 'Pending',
        ]);
        } else {
            // Buat data seleksi baru
            $casis->seleksi()->create([
                'casis_id' => $casis->id_casis,
                'pendaftaran_id' => $pendaftaran_id,
                'nilai_baca' => $validatedData['nilai_baca'],
                'nilai_tulis' => $validatedData['nilai_tulis'],
                'nilai_hitung' => $validatedData['nilai_hitung'],
                'nilai_wawancara' => $validatedData['nilai_wawancara'],
                'tgl_seleksi' => $validatedData['tgl_seleksi'],
                'total_nilai' => $total_nilai,
                'nilai_akhir' => $nilai_akhir,
                'hasil_seleksi' => $hasil_seleksi,
                'status' => 'Pending', // Menambahkan status Pending
            ]);
        }

        // Redirect ke route 'nilai'
        return redirect()->route('nilai')->with('success', 'Data Berhasil diInput!');
    }

    public function hapus($id)
    {
        // Temukan data seleksi berdasarkan id_casis
        $seleksi = selekasi::where('casis_id', $id)->firstOrFail();

        // Update nilai-nilai yang ingin dihapus
        $seleksi->update([
            'nilai_baca' => null,
            'nilai_tulis' => null,
            'nilai_hitung' => null,
            'nilai_wawancara' => null,
            'total_nilai' => null,
            'nilai_akhir' => null,
            'hasil_seleksi' => 'Tidak Lolos',
        ]);

        // Redirect ke halaman yang sesuai, misalnya ke halaman sebelumnya
        return redirect()->back();
    }
}
