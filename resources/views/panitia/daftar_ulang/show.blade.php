@extends('layout.tampilanpanitia')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Detail Pembayaran Daftar Ulang</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('panitia.daftar_ulang.index') }}">Daftar Ulang</a></li>
                        <li class="breadcrumb-item active">Detail</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Siswa</h3>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th style="width:40%">Nama</th>
                                    <td>{{ $daftarUlang->pendaftaran->casis->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Tanggal Daftar Ulang</th>
                                    <td>{{ date('d/m/Y H:i', strtotime($daftarUlang->tgl_daftar_ulang)) }}</td>
                                </tr>
                                <tr>
                                    <th>Metode Pembayaran</th>
                                    <td>{{ $daftarUlang->metode_pembayaran }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Bayar</th>
                                    <td>Rp {{ number_format($daftarUlang->jumlah_bayar, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>
                                        <span class="badge
                                            {{ $daftarUlang->status_bayar == 'Berhasil' ? 'badge-success' :
                                               ($daftarUlang->status_bayar == 'Menunggu Konfirmasi' ? 'badge-warning' : 'badge-danger') }}">
                                            {{ $daftarUlang->status_bayar }}
                                        </span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Bukti Pembayaran</h3>
                        </div>
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $daftarUlang->bukti_pembayaran) }}" alt="Bukti Pembayaran" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Update Status Pembayaran</h3>
                        </div>
                        <form action="{{ route('panitia.daftar_ulang.update', $daftarUlang->id_daftar_ulang) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="status_bayar">Status Pembayaran</label>
                                    <select name="status_bayar" id="status_bayar" class="form-control">
                                        <option value="Menunggu Konfirmasi" {{ $daftarUlang->status_bayar == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                        <option value="Berhasil" {{ $daftarUlang->status_bayar == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                                        <option value="Gagal" {{ $daftarUlang->status_bayar == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea name="keterangan" id="keterangan" rows="3" class="form-control">{{ $daftarUlang->keterangan }}</textarea>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Update Status</button>
                                <a href="{{ route('panitia.daftar_ulang.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#status_bayar').on('change', function() {
            var status = $(this).val();
            var badgeClass = 'badge ';
            switch (status) {
                case 'Berhasil':
                    badgeClass += 'badge-success';
                    break;
                case 'Menunggu Konfirmasi':
                    badgeClass += 'badge-warning';
                    break;
                default:
                    badgeClass += 'badge-danger';
            }
            $('table td span.badge').attr('class', badgeClass).text(status);
        });
    });
</script>
@endpush