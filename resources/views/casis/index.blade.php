@extends('layout.tampilan')

@section('page-title', 'Data Casis & Orang Tua')

@section('content')
<div class="space-y-6">
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl relative flex items-center justify-between" role="alert">
        <div class="flex items-center gap-2">
            <i class="fas fa-check-circle"></i>
            <span class="block sm:inline font-medium">{{ session('success') }}</span>
        </div>
        <button @click="show = false" class="text-green-500 hover:text-green-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @elseif (session('error'))
    <div x-data="{ show: true }" x-show="show" class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl relative flex items-center justify-between" role="alert">
        <div class="flex items-center gap-2">
            <i class="fas fa-exclamation-circle"></i>
            <span class="block sm:inline font-medium">{{ session('error') }}</span>
        </div>
        <button @click="show = false" class="text-red-500 hover:text-red-700">
            <i class="fas fa-times"></i>
        </button>
    </div>
    @endif

    {{-- Header & Search --}}
    <div class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800 font-heading">Data Casis & Orang Tua</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola data pendaftar dan informasi wali murid dalam satu tabel terintegrasi.</p>
        </div>
        <form action="/data/casis" method="get" class="w-full md:w-auto">
            <div class="relative max-w-sm ml-auto">
                <input type="text" name="search" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block pl-10 p-2.5" placeholder="Cari Nama Casis..." value="{{ $search ?? '' }}">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>
            </div>
        </form>
    </div>

    {{-- Table Container --}}
    <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th scope="col" class="px-6 py-4 font-semibold">No</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Casis & L/P</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Data Orang Tua / Wali</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Berkas (Akte/KK/Foto)</th>
                        <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($data as $value)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $loop->iteration + $data->firstItem() - 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 mb-1">{{ $value->nama }}</div>
                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium {{ $value->jenis_kelamin == 'Laki-Laki' ? 'bg-blue-100 text-blue-700' : 'bg-pink-100 text-pink-700' }}">
                                <i class="fas {{ $value->jenis_kelamin == 'Laki-Laki' ? 'fa-mars' : 'fa-venus' }} mr-1"></i> {{ $value->jenis_kelamin }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-slate-700 mb-1">{{ $value->nama_ortu ?: '-' }}</div>
                            <div class="flex items-center gap-2 text-xs text-slate-500">
                                <i class="fas fa-phone-alt text-[10px] text-green-500"></i> {{ $value->no_hp ?: '-' }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                @php
                                $documents = ['akte' => 'Akte', 'kk' => 'KK', 'foto' => 'Foto'];
                                @endphp
                                @foreach($documents as $docField => $docLabel)
                                    @if($value->$docField)
                                        @php
                                        $file_name = $value->$docField;
                                        $file_path = asset('storage/berkas/' . $file_name);
                                        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                        @endphp
                                        <a href="{{ $file_path }}" target="_blank" class="group flex flex-col items-center gap-1" title="Lihat {{ $docLabel }}">
                                            @if(in_array($file_extension, ['pdf']))
                                                <div class="w-8 h-8 rounded bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-red-100 transition-colors">
                                                    <i class="fas fa-file-pdf"></i>
                                                </div>
                                            @elseif(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                <img src="{{ $file_path }}" alt="{{ $docLabel }}" class="w-8 h-8 rounded object-cover border border-slate-200 group-hover:border-green-400 transition-colors">
                                            @else
                                                <div class="w-8 h-8 rounded bg-slate-100 text-slate-500 flex items-center justify-center group-hover:bg-slate-200 transition-colors">
                                                    <i class="fas fa-file"></i>
                                                </div>
                                            @endif
                                            <span class="text-[9px] font-medium text-slate-500 group-hover:text-slate-800">{{ $docLabel }}</span>
                                        </a>
                                    @else
                                        <div class="flex flex-col items-center gap-1 opacity-50 cursor-not-allowed" title="{{ $docLabel }} Belum Ada">
                                            <div class="w-8 h-8 rounded bg-slate-50 text-slate-300 flex items-center justify-center border border-dashed border-slate-200">
                                                <i class="fas fa-times"></i>
                                            </div>
                                            <span class="text-[9px] font-medium text-slate-400">{{ $docLabel }}</span>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('detailcasis', $value->id_casis) }}" class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors" title="Detail">
                                    <i class="fas fa-eye text-xs"></i>
                                </a>
                                <a href="{{ route('editdata', $value->id_casis) }}" class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center hover:bg-amber-500 hover:text-white transition-colors" title="Edit">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('deletecasis', $value->id_casis) }}" method="post" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ addslashes($value->nama) }}?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-colors" title="Hapus">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-3">
                                    <i class="fas fa-folder-open text-2xl"></i>
                                </div>
                                <p class="text-slate-500 font-medium">Belum ada data calon siswa.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        {{-- Pagination --}}
        @if($data->hasPages())
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50">
            {{ $data->links() }}
        </div>
        @endif
    </div>
</div>
@endsection