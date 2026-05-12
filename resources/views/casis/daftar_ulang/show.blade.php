@extends('layout.tampilancasis')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h2><i class="fas fa-user-graduate mr-2"></i><b>DAFTAR ULANG CALON SISWA</b></h2>
                </div>

                <div class="card-body">

                    @include('layout.alert')

                    @if(isset($error))
                    <div class="alert alert-danger" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle mr-2"></i>Perhatian!</h4>
                        <p>{{ $error }}</p>
                        <hr>
                        <p class="mb-0">Jika Anda memiliki pertanyaan, silakan hubungi panitia penerimaan siswa baru.</p>
                    </div>
                    @elseif(!$seleksi || $seleksi->status != 'Berhasil' || $seleksi->hasil_seleksi != 'Lolos')
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle mr-2"></i>Pendaftaran Anda Belum Selesai!</h4>
                        <p>Maaf, Anda belum dapat melakukan daftar ulang. Daftar ulang hanya bisa dilakukan setelah Anda dinyatakan lolos seleksi.</p>
                        <hr>
                        <p class="mb-0">Silakan tunggu hasil seleksi atau hubungi panitia untuk informasi lebih lanjut.</p>
                    </div>
                    @elseif($daftarUlang)
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="mb-3"><i class="fas fa-info-circle mr-2"></i>Informasi Pembayaran Daftar Ulang</h4>
                            <table class="table table-bordered">
                                <tr>
                                    <th>Metode Pembayaran</th>
                                    <td>{{ $daftarUlang->metode_pembayaran }}</td>
                                </tr>
                                <tr>
                                    <th>Jumlah Pembayaran</th>
                                    <td>Rp {{ number_format($daftarUlang->jumlah_bayar, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>Status Pembayaran</th>
                                    <td>
                                        @if($daftarUlang->status_bayar == 'Menunggu Konfirmasi')
                                        <span class="badge badge-warning">Menunggu Konfirmasi</span>
                                        @elseif($daftarUlang->status_bayar == 'Berhasil')
                                        <span class="badge badge-success">Berhasil</span>
                                        @elseif($daftarUlang->status_bayar == 'Gagal')
                                        <span class="badge badge-danger">Gagal</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tanggal Pembayaran</th>
                                    <td>{{ date('d/m/Y H:i', strtotime($daftarUlang->created_at)) }}</td>
                                </tr>
                            </table>
                            <div class="mt-3">
                                @if($daftarUlang->status_bayar == 'Berhasil')
                                <a href="{{ route('calon_siswa.daftar_ulang.print') }}" class="btn btn-primary" target="_blank">
                                    <i class="fas fa-print mr-2"></i>Cetak Bukti Pembayaran
                                </a>
                                @endif
                                <a href="{{ asset('storage/'.$daftarUlang->bukti_pembayaran) }}" class="btn btn-info ml-2" target="_blank">
                                    <i class="fas fa-eye mr-2"></i>Lihat Bukti Pembayaran
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-3"><i class="fas fa-info-circle mr-2"></i>Informasi Biaya Daftar Ulang</h4>
                            <table class="table table-bordered">
                                @foreach($biayaComponents as $component)
                                <tr>
                                    <th><i class="fas fa-hand-holding-usd mr-2"></i>{{ $component->nama_biaya }}</th>
                                    <td>Rp {{ number_format($component->nominal, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr class="table-primary">
                                    <th><i class="fas fa-calculator mr-2"></i>Total Biaya</th>
                                    <td id="totalBiaya">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4 class="mb-3"><i class="fas fa-money-check-alt mr-2"></i>Form Pembayaran Daftar Ulang</h4>
                            <form method="post" action="{{ route('calon_siswa.daftar_ulang.store') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label><i class="fas fa-money-bill-wave mr-2"></i>Pilih Metode Pembayaran</label>
                                    <div class="btn-group btn-group-toggle w-100" data-toggle="buttons">
                                        <label class="btn btn-outline-primary mr-3">
                                            <input type="radio" name="metode_pembayaran" value="DP 50%" required> <i class="fas fa-coins mr-1"></i>DP 50%
                                        </label>
                                        <label class="btn btn-outline-primary">
                                            <input type="radio" name="metode_pembayaran" value="Lunas" required> <i class="fas fa-check-circle mr-1"></i>Lunas
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah_bayar"><i class="fas fa-dollar-sign mr-2"></i>Jumlah Pembayaran</label>
                                    <input type="text" class="form-control @error('jumlah_bayar') is-invalid @enderror" name="jumlah_bayar" id="jumlah_bayar" placeholder="Masukkan jumlah pembayaran" required>
                                    @error('jumlah_bayar')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <div id="paymentError" class="feedback mt-2" style="display:none;"></div>
                                </div>

                                <div class="form-group">
                                    <label for="bukti_pembayaran"><i class="fas fa-file-invoice mr-2"></i>Bukti Pembayaran</label>
                                    <input type="file" class="form-control @error('bukti_pembayaran') is-invalid @enderror" id="bukti_pembayaran" name="bukti_pembayaran" required>
                                    @error('bukti_pembayaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-block"><i class="fas fa-save mr-2"></i>Simpan Pembayaran</button>
                            </form>
                        </div>
                    </div>
                    @endif
                    <hr>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <h5><i class="fas fa-university mr-2"></i>Informasi Rekening</h5>
                            <p>Silakan transfer pembayaran ke rekening berikut:</p>
                            <p><strong>Bank BNI</strong><br>
                                No. Rekening: 1234567890<br>
                                Atas Nama: SD Islam Terpadu Hidayah</p>
                        </div>
                        <div class="col-md-6">
                            <h5><i class="fas fa-info-circle mr-2"></i>Informasi Daftar Ulang</h5>
                            <ul>
                                <li><i class="fas fa-percentage mr-2"></i>Pembayaran DP minimal 50% (metode cicilan).</li>
                                <li><i class="fas fa-calendar-alt mr-2"></i>Metode Cicilan: Pelunasan maksimal 3 bulan.</li>
                                <li><i class="fas fa-file-image mr-2"></i>Unggah bukti pembayaran yang jelas dan valid.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahBayar = document.getElementById('jumlah_bayar');
        const totalBiayaElement = document.getElementById('totalBiaya');
        const totalBiaya = parseInt(totalBiayaElement.textContent.replace(/\D/g, ''));
        const paymentError = document.getElementById('paymentError');

        new Cleave('#jumlah_bayar', {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.'
        });

        $('input[name="metode_pembayaran"]').on('change', function() {
            const method = $(this).val();
            if (method === 'DP 50%') {
                jumlahBayar.value = (totalBiaya * 0.5).toLocaleString('id-ID').replace(/,/g, '.');
            } else if (method === 'Lunas') {
                jumlahBayar.value = totalBiaya.toLocaleString('id-ID').replace(/,/g, '.');
            }
            updateValidation();
        });

        jumlahBayar.addEventListener('input', updateValidation);

        function updateValidation() {
            const method = $('input[name="metode_pembayaran"]:checked').val();
            const amount = parseInt(jumlahBayar.value.replace(/\D/g, ''));

            if (amount < totalBiaya * 0.5) {
                paymentError.textContent = 'Pembayaran minimum adalah 50% dari total biaya';
                paymentError.style.display = 'block';
                paymentError.className = 'feedback mt-0 text-danger';
            } else if (amount > totalBiaya) {
                paymentError.textContent = 'Pembayaran tidak boleh melebihi total biaya';
                paymentError.style.display = 'block';
                paymentError.className = 'feedback mt-0 text-danger';
            } else if (method === 'Lunas' && amount !== totalBiaya) {
                paymentError.textContent = 'Pembayaran lunas harus sama dengan total biaya';
                paymentError.style.display = 'block';
                paymentError.className = 'feedback mt-0 text-danger';
            } else if (amount === totalBiaya) {
                paymentError.textContent = 'Pembayaran lunas';
                paymentError.style.display = 'block';
                paymentError.className = 'feedback mt-0 text-success';
            } else {
                paymentError.textContent = 'Pembayaran telah sesuai';
                paymentError.style.display = 'block';
                paymentError.className = 'feedback mt-0 text-success';
            }
        }
    });
</script>
@endpush

@push('styles')
<style>
    .content-wrapper {
        background-color: #f4f6f9;
    }

    .card {
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    }

    .table-bordered {
        border: 1px solid #dee2e6;
    }

    .table-bordered th,
    .table-bordered td {
        border: 1px solid #dee2e6;
    }

    .btn-group-toggle .btn {
        cursor: pointer;
    }

    .feedback {
        font-size: 0.875em;
    }

    .text-danger {
        color: #dc3545;
    }

    .text-success {
        color: #28a745;
    }
</style>
@endpush
