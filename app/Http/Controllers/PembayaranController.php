<?php

namespace App\Http\Controllers;

use Log;
use App\Models\casis;
use App\Models\tahunajar;
use App\Models\pembayaran;
use App\Models\pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PembayaranController extends Controller
{
    public function index()
    {
        $data = pembayaran::with('casis')->get();
        return view('pembayaran.index', compact('data'));
    }

    public function infobayar()
    {
        $user = Auth::user();
        $user->load(['casis', 'casis.pembayaran']);

        $tahunAjarBerlangsung = tahunajar::where('status', 'Berlangsung')->first();
        $kuotaTersedia = false;
        $pesanKuota = '';

        if ($tahunAjarBerlangsung) {
            $jumlahPendaftar = pendaftaran::where('ajar_id', $tahunAjarBerlangsung->id_ajar)->count();

            if ($jumlahPendaftar < $tahunAjarBerlangsung->kuota) {
                $kuotaTersedia = true;
                $sisaKuota = $tahunAjarBerlangsung->kuota - $jumlahPendaftar;
                $pesanKuota = "Kuota tersisa: {$sisaKuota} dari {$tahunAjarBerlangsung->kuota}";
            } else {
                $pesanKuota = "Mohon maaf, kuota pendaftaran untuk tahun ajaran {$tahunAjarBerlangsung->tahun_ajar} sudah penuh.";
            }
        } else {
            $pesanKuota = "Tidak ada tahun ajaran yang sedang berlangsung saat ini.";
        }

        return view('pembayaran.infobayar', compact('user', 'kuotaTersedia', 'pesanKuota'));
    }

    public function tagihan(Request $request, $id)
    {
        $data = pembayaran::with(['casis'])->where('id_pembayaran', $id)->first();
        return view('pembayaran.tagihan', compact('data'));
    }

    public function proses(Request $request, $id)
    {
        $data = pembayaran::where('id_pembayaran', $id)->first();
        if ($data) {
            $data->status_pembayaran = $request->status_pembayaran;
            $data->save();
        }

        return redirect('/admin/pembayaran')->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function pembayaran()
    {
        // Dapatkan user yang saat ini sedang login
        $user = Auth::user();

        // Muat data casis yang terkait dengan user
        $casis = Casis::where('user_id', $user->id)->first();

        // Inisialisasi status pembayaran dengan "Belum Lunas"
        $status_pembayaran = 'Belum Lunas';
        $bukti_pembayaran = null;

        // Jika casis dengan user terkait ditemukan
        if ($casis) {
            // Dapatkan data pembayaran terkait dengan casis
            $pembayaran = Pembayaran::where('casis_id', $casis->id_casis)->first();

            // Jika pembayaran ditemukan
            if ($pembayaran) {
                $status_pembayaran = $pembayaran->status_pembayaran;
                $bukti_pembayaran = $pembayaran->bukti_pembayaran;
            }
        }

        return view('pembayaran.bayar', compact('user', 'status_pembayaran', 'bukti_pembayaran'));
    }

    public function pelunasan(Request $request)
    {
        // Validasi request
        $request->validate([
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'bukti_pembayaran.required' => 'Bukti pembayaran harus diunggah.',
            'bukti_pembayaran.image' => 'File harus berupa gambar.',
            'bukti_pembayaran.mimes' => 'Format file harus jpeg, png, jpg, atau gif.',
            'bukti_pembayaran.max' => 'Ukuran file tidak boleh lebih dari 2MB.',
        ]);

        // Dapatkan user yang saat ini sedang login
        $user = Auth::user();

        // Dapatkan casis terkait dengan user
        $casis = $user->casis;

        if (!$casis) {
            return redirect()->back()->with('error', 'Casis tidak ditemukan. Silahkan melakukan pendaftaran terlebih dahulu.');
        }

        try {
            // Simpan bukti pembayaran
            $bukti_pembayaran = $request->file('bukti_pembayaran');
            $nama_bukti_pembayaran = time() . '_' . $bukti_pembayaran->getClientOriginalName();

            // Simpan file ke storage
            $bukti_pembayaran->storeAs('public/pembayaran', $nama_bukti_pembayaran);

            // Simpan data pembayaran
            $pembayaran = Pembayaran::create([
                'casis_id' => $casis->id_casis,
                'tgl_pembayaran' => now(),
                'jumlah_pembayaran' => 100000,
                'status_pembayaran' => 'Belum Lunas',
                'bukti_pembayaran' => $nama_bukti_pembayaran,
            ]);

            // Redirect dengan pesan sukses
            return redirect()->route('pembayaran')->with('success', 'Bukti pembayaran berhasil diunggah. Mohon tunggu konfirmasi dari admin.');
        } catch (\Exception $e) {
            // Tangani error jika terjadi
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan pembayaran. Silakan coba lagi.');
        }
    }


    public function delete($id)
    {
        try {
            $pembayaran = Pembayaran::findOrFail($id);

            // Check if there's a bukti_pembayaran file and delete it
            if ($pembayaran->bukti_pembayaran) {
                // Hapus file dari storage
                if (Storage::disk('public')->exists($pembayaran->bukti_pembayaran)) {
                    Storage::disk('public')->delete($pembayaran->bukti_pembayaran);
                }
            }

            // Delete the pembayaran record
            $pembayaran->delete();

            return redirect()->route('index')->with('success', 'Data pembayaran berhasil dihapus.');
        } catch (\Exception $e) {
            // Log the error
            \Log::error('Error deleting pembayaran: ' . $e->getMessage());

            return redirect()->route('index')->with('error', 'Terjadi kesalahan saat menghapus data pembayaran. Silakan coba lagi.');
        }
    }
}
