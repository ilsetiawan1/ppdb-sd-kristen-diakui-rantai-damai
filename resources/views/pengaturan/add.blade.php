@extends('layout.tampilan')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title"><i class="fas fa-calendar-alt mr-2"></i><b>FORM TAMBAH TAHUN AJARAN</b></h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('tahun.simpan') }}">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tahun_ajar">Tahun Ajaran</label>
                                    <input type="text" class="form-control" id="tahun_ajar" name="tahun_ajar" placeholder="Contoh 2027/2028" required>
                                </div>
                                <div class="form-group">
                                    <label for="mulai_pendaftaran">Tanggal Mulai Pendaftaran</label>
                                    <input type="date" class="form-control" id="mulai_pendaftaran" name="mulai_pendaftaran" required>
                                </div>
                                <div class="form-group">
                                    <label for="batas_pendaftaran">Tanggal Batas Pendaftaran</label>
                                    <input type="date" class="form-control" id="batas_pendaftaran" name="batas_pendaftaran" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="tgl_seleksi">Tanggal Seleksi</label>
                                    <input type="date" class="form-control" id="tgl_seleksi" name="tgl_seleksi" required>
                                </div>
                                <div class="form-group">
                                    <label for="kuota">Kuota</label>
                                    <input type="number" class="form-control" id="kuota" name="kuota" placeholder="masukan kuota maksimal pendaftar" required>
                                </div>
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Berlangsung">Berlangsung</option>
                                        <option value="Berakhir">Berakhir</option>
                                        <option value="Belum Dimulai">Belum Dimulai</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success"><i class="fas fa-save mr-2"></i>Simpan</button>
                            <a href="{{ route('beranda.tahun') }}" class="btn btn-secondary"><i class="fas fa-times mr-2"></i>Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        border-radius: 10px 10px 0 0;
    }

    .form-control,
    .form-select {
        border-radius: 5px;
    }

    .btn {
        border-radius: 5px;
    }
</style>
@endpush
