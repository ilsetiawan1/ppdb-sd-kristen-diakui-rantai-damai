@extends('layout.tampilan')

@section('content')

<div class="content-wrapper min-h-screen bg-slate-50">
    <div class="content-header py-6">

        <div class="container-fluid mb-4">
            @include('layout.alert')
        </div>

        <div class="container-fluid">

            {{-- Page Header Component --}}
            <x-admin.page-header 
                title="Data Pendaftaran Calon Siswa" 
                description="Kelola seluruh data pendaftaran calon siswa PPDB."
                icon="fas fa-clipboard-list">
                
                <a href="/admin/pendaftaran/form"
                    class="inline-flex items-center justify-center px-5 py-2.5 bg-blue-600 hover:bg-blue-700 transition-all duration-200 rounded-xl text-white font-semibold shadow-sm hover:shadow-md hover:-translate-y-0.5">
                    <i class="fas fa-plus mr-2"></i>
                    Tambah Data
                </a>
            </x-admin.page-header>

            {{-- Main Data Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">

                {{-- Toolbar (Search & Actions) --}}
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                    <div class="flex items-center gap-2 text-slate-700 font-semibold">
                        <i class="fas fa-list-ul text-slate-400"></i>
                        Daftar Pendaftar
                    </div>

                    <x-admin.search-bar 
                        action="/admin/pendaftaran" 
                        placeholder="Cari nama calon siswa..." />
                </div>

                {{-- Table Area --}}
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-slate-600">
                        <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                            <tr>
                                <th class="px-5 py-4 font-semibold">No</th>
                                <th class="px-5 py-4 font-semibold">Nama Lengkap</th>
                                <th class="px-5 py-4 font-semibold">Tempat, Tgl Lahir</th>
                                <th class="px-5 py-4 font-semibold">Nama Orang Tua</th>
                                <th class="px-5 py-4 font-semibold">Alamat</th>
                                <th class="px-5 py-4 font-semibold text-center">Tgl Pendaftaran</th>
                                <th class="px-5 py-4 font-semibold">Verifikasi Status</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">

                            @forelse($data as $no => $value)

                            <tr class="hover:bg-slate-50/80 transition-colors group">

                                {{-- No --}}
                                <td class="px-5 py-4 font-medium text-slate-800">
                                    {{ $no + 1 }}
                                </td>

                                {{-- Nama --}}
                                <td class="px-5 py-4">
                                    <div class="font-bold text-slate-800 mb-1.5">
                                        {{ $value->casis->nama }}
                                    </div>
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold tracking-wide uppercase
                                        {{ $value->casis->jenis_kelamin == 'Laki-Laki' ? 'bg-blue-50 text-blue-600 border border-blue-100' : 'bg-pink-50 text-pink-600 border border-pink-100' }}">
                                        <i class="fas {{ $value->casis->jenis_kelamin == 'Laki-Laki' ? 'fa-mars' : 'fa-venus' }} mr-1"></i>
                                        {{ $value->casis->jenis_kelamin }}
                                    </span>
                                </td>

                                {{-- TTL --}}
                                <td class="px-5 py-4 text-slate-600">
                                    <div class="font-medium text-slate-700">
                                        {{ $value->casis->tempat_lahir }}
                                    </div>
                                    <div class="text-xs text-slate-500 mt-1 flex items-center gap-1">
                                        <i class="far fa-calendar-alt text-[10px]"></i>
                                        {{ Carbon\Carbon::parse($value->casis->tanggal_lahir)->format('d/m/Y') }}
                                    </div>
                                </td>

                                {{-- Ortu --}}
                                <td class="px-5 py-4">
                                    <div class="font-semibold text-slate-700">
                                        {{ $value->casis->nama_ortu }}
                                    </div>
                                </td>

                                {{-- Alamat --}}
                                <td class="px-5 py-4 text-slate-600">
                                    <div class="line-clamp-2 text-xs leading-relaxed" title="{{ $value->casis->alamat }}">
                                        {{ $value->casis->alamat }}
                                    </div>
                                </td>

                                {{-- Tanggal Pendaftaran --}}
                                <td class="px-5 py-4 text-center">
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg bg-slate-100 text-slate-600 text-xs font-semibold shadow-sm border border-slate-200/60">
                                        {{ Carbon\Carbon::parse($value->tgl_pendaftaran)->format('d-m-Y') }}
                                    </span>
                                </td>

                                {{-- Verifikasi Status Inline Form --}}
                                <td class="px-5 py-4">
                                    <div class="flex flex-col gap-2 min-w-[160px]">
                                        {{-- Current Status Badge --}}
                                        <div class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-lg text-xs font-bold w-max shadow-sm
                                            @if($value->status === 'Berhasil') bg-green-100 text-green-700 border border-green-200
                                            @elseif($value->status === 'Gagal') bg-red-100 text-red-700 border border-red-200
                                            @else bg-amber-100 text-amber-700 border border-amber-200
                                            @endif">
                                            
                                            @if($value->status === 'Berhasil')
                                                <i class="fas fa-check-circle"></i>
                                            @elseif($value->status === 'Gagal')
                                                <i class="fas fa-times-circle"></i>
                                            @else
                                                <i class="fas fa-clock"></i>
                                            @endif

                                            <span>{{ $value->status }}</span>
                                        </div>

                                        {{-- Update Form --}}
                                        <form action="{{ route('prosesdata', ['id' => $value->id_pendaftaran]) }}" method="POST" class="flex items-center gap-2 mt-1">
                                            @csrf
                                            <select name="status" class="bg-white border border-slate-300 text-slate-700 text-xs font-medium rounded-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 block w-full py-1.5 px-2 shadow-sm cursor-pointer hover:border-blue-400 transition-colors">
                                                <option value="Pending" {{ $value->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="Berhasil" {{ $value->status === 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                                                <option value="Gagal" {{ $value->status === 'Gagal' ? 'selected' : '' }}>Gagal</option>
                                            </select>
                                            <button type="submit"
                                                class="bg-blue-600 hover:bg-blue-700 active:scale-95 text-white flex items-center gap-1.5 px-3 py-1.5 rounded-lg shadow-sm hover:shadow-md transition-all font-semibold text-xs whitespace-nowrap shrink-0"
                                                title="Simpan Status">
                                                <i class="fas fa-save text-xs"></i>
                                                Simpan
                                            </button>
                                        </form>
                                    </div>
                                </td>

                            </tr>

                            @empty

                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center">
                                        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-4 border border-slate-100 shadow-inner">
                                            <i class="fas fa-folder-open text-3xl"></i>
                                        </div>
                                        <h3 class="text-lg font-bold text-slate-700 mb-1">Belum ada data</h3>
                                        <p class="text-slate-500 text-sm">
                                            Belum ada data pendaftaran yang tersedia saat ini.
                                        </p>
                                    </div>
                                </td>
                            </tr>

                            @endforelse

                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>

@endsection