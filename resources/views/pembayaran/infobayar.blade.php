@extends('layout.tampilancasis')

@section('content')
<div class="content-wrapper">
    <div class="container-fluid py-4">
        @include('layout.alert')

        <div class="card shadow">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <h3><b>INFORMASI PEMBAYARAN</b></h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if(!$kuotaTersedia)
                    <div class="alert alert-warning" role="alert">
                        <h4 class="alert-heading"><i class="fas fa-exclamation-triangle mr-2"></i>Pendaftaran Tidak Tersedia!</h4>
                        <p>{{ $pesanKuota }}</p>
                        <hr>
                        <p class="mb-0">Silakan hubungi panitia untuk informasi lebih lanjut.</p>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th class="w-50">NIK</th>
                                        <td>{{ $user->casis->nik ?? 'Belum terdaftar' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>{{ $user->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Kelamin</th>
                                        <td>{{ $user->casis->jenis_kelamin ?? 'Belum terdaftar' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <td>{{ $user->casis->tempat_lahir ?? 'Belum Terdaftar' }}
                                            @if($user->casis && $user->casis->tanggal_lahir)
                                            {{ \Carbon\Carbon::parse($user->casis->tanggal_lahir)->format('d/m/y') }}
                                            @else

                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="w-50">Nama Orang Tua</th>
                                        <td>{{ $user->casis->nama_ortu ?? 'Belum terdaftar' }}</td>
                                    </tr>
                                    <!-- <tr>
                                        <th>Pendidikan Orang Tua</th>
                                        <td>{{ $user->casis->pendidikan_ortu ?? 'Belum terdaftar' }}</td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <table class="table table-hover">
                                <tbody>
                                    <tr>
                                        <th>Bank</th>
                                        <td>BNI - Norek : 1234567890</td>
                                    </tr>
                                    <tr>
                                        <th>Atas Nama</th>
                                        <td>SD Islam Terpadu Hidayah</td>
                                    </tr>
                                    <tr>
                                        <th>Jumlah Pembayaran</th>
                                        <td>Rp. 100.000,00</td>
                                    </tr>
                                    <tr>
                                        <th>Status Pembayaran</th>
                                        <td>
                                            @if($user->casis && $user->casis->pembayaran)
                                            @if($user->casis->pembayaran->status_pembayaran === 'Lunas')
                                            <span class="badge bg-success">Lunas</span>
                                            @else
                                            <span class="badge bg-warning text-dark">Pending</span>
                                            @endif
                                            @else
                                            <span class="badge bg-danger">Belum Lunas</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Bukti Pembayaran</th>
                                        <td>
                                            @if($user->casis && $user->casis->pembayaran && $user->casis->pembayaran->bukti_pembayaran)
                                            @php
                                            $bukti_pembayaran = $user->casis->pembayaran->bukti_pembayaran;
                                            $file_path = asset('storage/pembayaran/' . $bukti_pembayaran);
                                            @endphp
                                            <a href="{{ $file_path }}" target="_blank" class="btn btn-sm btn-info">
                                                Lihat Bukti
                                            </a>
                                            @else
                                            Belum ada bukti pembayaran
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        @if(!$user->casis || !$user->casis->pembayaran || $user->casis->pembayaran->status_pembayaran !== 'Lunas')
                        <a href="/beranda/pembayaran" class="btn btn-primary btn-lg">
                            <i class="fas fa-credit-card me-2"></i> Bayar Sekarang
                        </a>
                        @endif
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <style>
        .content-wrapper {
            background-color: #f4f6f9;
        }

        .card {
            border: none;
            border-radius: 0.5rem;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: middle;
        }

        .table th {
            font-weight: 600;
            color: #495057;
            width: 50%;
        }

        .table td {
            color: #6c757d;
        }

        .btn-primary {
            background-color: #4e73df;
            border-color: #4e73df;
            box-shadow: 0 2px 4px rgba(78, 115, 223, 0.3);
        }

        .btn-primary:hover {
            background-color: #2e59d9;
            border-color: #2653d4;
            transform: translateY(-1px);
        }

        .badge {
            font-size: 0.875rem;
            padding: 0.35em 0.65em;
        }

        @media (max-width: 767.98px) {
            .card-title {
                font-size: 1.25rem;
            }

            .table th,
            .table td {
                font-size: 0.875rem;
            }

            .btn-lg {
                font-size: 1rem;
                padding: 0.5rem 1rem;
            }
        }
    </style>
    @endsection