@extends('layout.tampilan')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-6 mb-2 mb-sm-0">
                            <h1><b>TAHUN AJARAN</b></h1>
                        </div>
                        <div class="col-sm-6 mb-2 mb-sm-0 text-right">
                            <a href="/tahun ajar/add" class="btn btn-primary">Tambah Data</a>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    @include('layout.alert')
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover text-center">
                            <thead class="bg-dark text-white">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Tahun Ajar</th>
                                    <th scope="col">Mulai Pendaftaran</th>
                                    <th scope="col">Batas Pendaftaran</th>
                                    <th scope="col">Kuota</th>
                                    <th scope="col">Tanggal Seleksi</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $no => $value)
                                <tr>
                                    <td>{{ $no+1 }}</td>
                                    <td>{{ $value->tahun_ajar }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->mulai_pendaftaran)->format('d-m-Y') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->batas_pendaftaran)->format('d-m-Y') }}</td>
                                    <td>{{ $value->kuota }}</td>
                                    <td>{{ \Carbon\Carbon::parse($value->tgl_seleksi)->format('d-m-Y') }}</td>
                                    <td><b>{{ $value->status }}</b></td>
                                    <td>
                                        <a href="/tahun ajar/edit/{{$value->id_ajar}}" class="btn btn-sm btn-warning" title="Edit">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <form action="{{ route('tahun.delete', $value->id_ajar) }}" method="post" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" title="Hapus" onclick="return confirmUserDelete('{{ $value->tahun_ajar }}')">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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

@push('scripts')
<script>
    function confirmUserDelete(tahunAjar) {
        return confirm('Apakah Anda yakin ingin menghapus tahun ajaran ' + tahunAjar + '?');
    }
</script>
@endpush
