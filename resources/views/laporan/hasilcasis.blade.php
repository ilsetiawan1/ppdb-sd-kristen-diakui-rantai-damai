@extends('layout.tampilanpanitia')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row justify-content-between align-items-center">
                        <!-- Kolom Tambah Data -->
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <h5><b>LAPORAN NILAI HASIL SELESKSI CALON SISWA</b></h5>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <div class="row justify-content-between align-items-center">
                        <!-- Kolom Tambah Data -->
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <a href="/unduh/hasil casis" class="btn btn-warning">
                                <i class="fas fa-print"></i> Cetak Laporan
                            </a>
                        </div

                        <!-- Kolom Pencarian -->
                        <div class="col-sm-6">
                            <form action="{{ route('hasilcasis') }}" method="get" class="form-inline d-flex justify-content-end">
                                <div class="input-group input-group-sm mr-2">
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Tanggal Mulai" value="{{ request('start_date') }}">
                                </div>
                                <div class="input-group input-group-sm mr-2">
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="Tanggal Selesai" value="{{ request('end_date') }}">
                                </div>
                                <button type="submit" class="btn btn-info">
                                    <i class="fa fa-search"></i> Cari
                                </button>
                                <a href="/laporan/hasil casis" type="submit" class="btn btn-warning">
                                    <i class="fa fa-reply"></i>
                                </a>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive"> <!-- Add table-responsive class -->
                        <table class="table" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th class=" bg-dark text-white">No</th>
                                    <th class=" bg-dark text-white">Nik</th>
                                    <th class=" bg-dark text-white">Nama</th>
                                    <th class=" bg-dark text-white">Tanggal Seleksi</th>
                                    <th class=" bg-dark text-white">Baca</th>
                                    <th class=" bg-dark text-white">Tulis</th>
                                    <th class=" bg-dark text-white">Hitung</th>
                                    <th class=" bg-dark text-white">Ngaji</th>
                                    <th class=" bg-dark text-white">Wawancara</th>
                                    <th class=" bg-dark text-white">Total Nilai</th>
                                    <th class=" bg-dark text-white">Nilai Akhir</th>
                                    <th class=" bg-dark text-white">Ket</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $value)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $value->casis->nik}}</td>
                                    <td>{{ $value->casis->nama}}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->tgl_seleksi)->format('d-m-Y') }}</td>
                                    <td>{{ $value->nilai_baca ?? '- - -' }}</td>
                                    <td>{{ $value->nilai_tulis ?? '- - -' }}</td>
                                    <td>{{ $value->nilai_hitung ?? '- - -' }}</td>
                                    <td>{{ $value->nilai_ngaji ?? '- - -' }}</td>
                                    <td>{{ $value->nilai_wawancara ?? '- - -' }}</td>
                                    <td>{{ $value->total_nilai ?? '- - -' }}</td>
                                    <td>{{ $value->nilai_akhir ?? '- - -' }}</td>
                                    <td style="color: {{ $value->hasil_seleksi == 'Lolos' ? 'green' : 'red' }}">
                                        <strong>{{ $value->hasil_seleksi == 'Lolos' ? 'LULUS' : 'TIDAK LULUS' }}</strong>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
