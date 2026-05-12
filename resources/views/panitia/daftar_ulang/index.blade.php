@extends('layout.tampilanpanitia')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Daftar Pembayaran Daftar Ulang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Ulang</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h3 class="card-title">Data Pembayaran Daftar Ulang</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('panitia.daftar_ulang.index') }}" method="GET" id="filterForm">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="Cari nama siswa..." value="{{ request('search') }}">
                            </div>
                            <div class="col-md-3">
                                <select name="status" id="statusFilter" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="Menunggu Konfirmasi" {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                    <option value="Berhasil" {{ request('status') == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                                    <option value="Gagal" {{ request('status') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary">Filter</button>
                            </div>
                        </div>
                    </form>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Tanggal Daftar Ulang</th>
                                    <th>Metode Pembayaran</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Status Pembayaran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($daftarUlang as $index => $item)
                                <tr>
                                    <td>{{ $daftarUlang->firstItem() + $index }}</td>
                                    <td>{{ $item->pendaftaran->casis->nama }}</td>
                                    <td>{{ date('d/m/Y H:i', strtotime($item->tgl_daftar_ulang)) }}</td>
                                    <td>{{ $item->metode_pembayaran }}</td>
                                    <td>Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td>
                                        <span class="badge
                                            {{ $item->status_bayar == 'Berhasil' ? 'badge-success' :
                                               ($item->status_bayar == 'Menunggu Konfirmasi' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ $item->status_bayar }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('panitia.daftar_ulang.show', $item->id_daftar_ulang) }}" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i> Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada data daftar ulang!</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer clearfix">
                    {{ $daftarUlang->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#statusFilter').on('change', function() {
            $('#filterForm').submit();
        });
    });
</script>
@endpush