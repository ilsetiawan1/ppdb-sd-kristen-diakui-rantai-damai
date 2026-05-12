<?php

namespace App\Http\Controllers;

use App\Models\selekasi;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\pembayaran;
use App\Models\pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
{
    public function pendaftaran(Request $request)
    {
        $query = pendaftaran::with('casis');

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $query->whereBetween('tgl_pendaftaran', [$start_date, $end_date]);
        }

        if ($request->has('filter_program') && $request->filter_program != '') {
            $status = $request->filter_program;
            $query->where('status', $status);
        }

        $data = $query->get();

        // Simpan data di session
        Session::put('pendaftaran_data', $data);

        return view('laporan.pendaftaran', compact('data'));
    }

    public function unduhpendaftaran()
    {
        // Ambil data dari session
        $data = Session::get('pendaftaran_data');

        // Check if the data is empty
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'No data available to generate PDF.');
        }

        $pdf = Pdf::loadView('laporan.unduhpendaftaran', compact('data'));

        return $pdf->download('laporan_pendaftaran.pdf');
    }

    public function pembayaran(Request $request)
    {
        $query = pembayaran::with('casis');

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $query->whereBetween('tgl_pembayaran', [$start_date, $end_date]);
        }

        if ($request->has('filter_program') && $request->filter_program != '') {
            $status_pembayaran = $request->filter_program;
            $query->where('status_pembayaran', $status_pembayaran);
        }

        $data = $query->get();

        // Simpan data di session
        Session::put('pembayaran_data', $data);

        return view('laporan.pembayaran', compact('data'));
    }


    public function unduhpembayaran()
    {
        // Ambil data dari session
        $data = Session::get('pembayaran_data');

        // Check if the data is empty
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'No data available to generate PDF.');
        }

        $pdf = Pdf::loadView('laporan.unduhpembayaran', compact('data'));

        return $pdf->download('laporan_pembayaran.pdf');

        $data = pembayaran::with('casis')->get();
        return view('laporan.unduhpembayaran', compact('data'));
    }

    public function datacasis()
    {
        return view('laporan.datacasis');
    }

    public function hasilcasis(Request $request)
    {
        $query = selekasi::with('casis');

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $query->whereBetween('tgl_seleksi', [$start_date, $end_date]);
        }

        $data = $query->get();

        // Simpan data di session
        Session::put('seleksi_data', $data);

        return view('laporan.hasilcasis', compact('data'));
    }

    public function unduhhasil()
    {
        // Ambil data dari session
        $data = Session::get('seleksi_data');

        // Check if the data is empty
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'No data available to generate PDF.');
        }

        $pdf = Pdf::loadView('laporan.unduhseleksi', compact('data'));

        return $pdf->download('laporan_seleksi.pdf');

        $data = selekasi::with('casis')->get();
        return view('laporan.unduhseleksi', compact('data'));
    }

    public function diterimacasis(Request $request)
    {
        $query = selekasi::with('casis')->where('hasil_seleksi', 'Lolos');

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $query->whereBetween('tgl_seleksi', [$start_date, $end_date]);
        }

        $data = $query->get();

        // Simpan data di session
        Session::put('seleksi_diterima', $data);
        return view('laporan.diterima', compact('data'));
    }

    public function unduhditerima()
    {
        // Ambil data dari session
        $data = Session::get('seleksi_diterima');

        // Check if the data is empty
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'No data available to generate PDF.');
        }

        $pdf = Pdf::loadView('laporan.unduhditerima', compact('data'));

        return $pdf->download('laporan_seleksi.pdf');

        $data = selekasi::with('casis')->get();
        return view('laporan.unduhditerima', compact('data'));
    }

    public function gagalcasis(Request $request)
    {
        $query = selekasi::with('casis')->where('hasil_seleksi', 'Tidak Lolos');

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $query->whereBetween('tgl_seleksi', [$start_date, $end_date]);
        }

        $data = $query->get();

        // Simpan data di session
        Session::put('seleksi_gagal', $data);
        return view('laporan.gagal',  compact('data'));
    }

    public function unduhgagal()
    {
        // Ambil data dari session
        $data = Session::get('seleksi_gagal');

        // Check if the data is empty
        if ($data->isEmpty()) {
            return redirect()->back()->with('error', 'No data available to generate PDF.');
        }

        $pdf = Pdf::loadView('laporan.unduhgagal', compact('data'));

        return $pdf->download('laporan_seleksi.pdf');

        $data = selekasi::with('casis')->get();
        return view('laporan.unduhgagal', compact('data'));
    }
}
