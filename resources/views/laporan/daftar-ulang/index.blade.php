@extends('layout.tampilanpanitia')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5><b>LAPORAN DAFTAR ULANG CALON SISWA</b></h5>
                </div>

                <div class="card-body">
                    <form action="{{ route('laporan.daftar-ulang.index') }}" method="get" class="mb-4">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start_date">Tanggal Mulai:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" value="{{ request('start_date') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end_date">Tanggal Selesai:</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ request('end_date') }}">
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <a href="{{ route('laporan.daftar-ulang.cetak', request()->query()) }}" class="btn btn-success mb-3" target="_blank">
                        <i class="fas fa-print"></i> Cetak Laporan
                    </a>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Daftar Ulang</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Status Pembayaran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarUlang as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->pendaftaran->casis->nama }}</td>
                                    <td>{{ date('d/m/Y', strtotime($item->tgl_daftar_ulang)) }}</td>
                                    <td>{{ $item->metode_pembayaran }}</td>
                                    <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge {{ $item->status_bayar == 'Berhasil' ? 'badge-success' : ($item->status_bayar == 'Menunggu Konfirmasi' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ $item->status_bayar }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada data daftar ulang</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection