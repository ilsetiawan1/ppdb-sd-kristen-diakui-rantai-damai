@extends('layout.tampilan')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            @include('layout.alert')
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <h1><b>DATA PENDAFTARAN CALON SISWA</b></h1>
                        </div>
                        <div class="col-sm-6 mb-2 mb-sm-0 text-right">
                            <a href="/admin/pendaftaran/form" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                </div>

                <div class="card-header">
                    <form action="/admin/pendaftaran" method="get" class="form-inline">
                        <div class="input-group input-group-sm w-100">
                            <input type="text" name="search" class="form-control" placeholder="Cari Data ....">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Lengkap</th>
                                    <th>Tempat, Tgl Lahir</th>
                                    <th>Nama Orang Tua</th>
                                    <th>Alamat</th>
                                    <th>Tgl Pendaftaran</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $value)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $value->casis->nama }}</td>
                                    <td>{{ $value->casis->tempat_lahir }}, {{ Carbon\Carbon::parse($value->casis->tanggal_lahir)->format('d/m/Y') }}</td>
                                    <td>{{ $value->casis->nama_ortu }}</td>
                                    <td>{{ $value->casis->alamat }}</td>
                                    <td>{{ Carbon\Carbon::parse($value->tgl_pendaftaran)->format('d-m-Y') }}</td>
                                    <td style="text-align: center;">
                                        <button type="button" class="btn btn-link" data-toggle="modal" data-target="#statusModal{{ $value->id_pendaftaran }}" data-pendaftaran-id="{{ $value->id_pendaftaran }}" data-status="{{ $value->status }}">
                                            @if($value->status === 'Berhasil')
                                            <i class="fas fa-check-circle text-success"></i> Berhasil
                                            @elseif($value->status === 'Gagal')
                                            <i class="fas fa-times-circle text-danger"></i> Gagal
                                            @else
                                            <i class="fas fa-minus-circle text-secondary"></i> Pending
                                            @endif
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="statusModal{{ $value->id_pendaftaran }}" tabindex="-1" role="dialog" aria-labelledby="statusModalLabel{{ $value->id_pendaftaran }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="statusModalLabel{{ $value->id_pendaftaran }}">Status Pendaftaran</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Status saat ini: <strong>{{ $value->status }}</strong></p>
                                                <form action="{{ route('prosesdata', ['id' => $value->id_pendaftaran]) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="status">Ubah Status:</label>
                                                        <select class="form-control" id="status" name="status">
                                                            <option value="Berhasil" {{ $value->status === 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                                                            <option value="Gagal" {{ $value->status === 'Gagal' ? 'selected' : '' }}>Gagal</option>
                                                            <option value="Pending" {{ $value->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
