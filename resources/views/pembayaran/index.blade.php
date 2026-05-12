@extends('layout.tampilan')

@section('page-title', 'Data Pembayaran')

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
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800 font-heading">Data Pembayaran Calon Siswa</h1>
            <p class="text-slate-500 text-sm mt-1">Verifikasi bukti transfer dan kelola status pembayaran pendaftar.</p>
        </div>
        <form action="{{ route('index') }}" method="get" class="w-full md:w-auto">
            <div class="relative max-w-sm ml-auto">
                <input type="text" name="search" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block pl-10 p-2.5" placeholder="Cari Pembayaran..." value="{{ $search ?? '' }}">
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
                        <th scope="col" class="px-6 py-4 font-semibold">Nama Casis</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Tagihan & Tanggal</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Bukti</th>
                        <th scope="col" class="px-6 py-4 font-semibold">Status</th>
                        <th scope="col" class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($data as $no => $value)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-medium text-slate-800">{{ $no + 1 }}</td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800">{{ $value->casis->nama }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-amber-600 mb-1">Rp {{ number_format($value->jumlah_pembayaran, 0, ',', '.') }}</div>
                            <div class="text-xs text-slate-500">
                                <i class="fas fa-calendar-alt mr-1"></i> {{ \Carbon\Carbon::parse($value->tgl_pembayaran)->format('d/m/Y') }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($value->bukti_pembayaran)
                                @php
                                $file_name = $value->bukti_pembayaran;
                                $file_path = asset('storage/pembayaran/' . $file_name);
                                $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                                @endphp
                                <a href="{{ $file_path }}" target="_blank" class="group flex flex-col items-center gap-1 w-max" title="Lihat Bukti Transfer">
                                    @if(in_array($file_extension, ['pdf']))
                                        <div class="w-10 h-10 rounded bg-red-50 text-red-500 flex items-center justify-center group-hover:bg-red-100 transition-colors">
                                            <i class="fas fa-file-pdf"></i>
                                        </div>
                                    @elseif(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                        <img src="{{ $file_path }}" alt="Bukti Pembayaran" class="w-10 h-10 rounded object-cover border border-slate-200 group-hover:border-green-400 transition-colors">
                                    @else
                                        <div class="w-10 h-10 rounded bg-slate-100 text-slate-500 flex items-center justify-center group-hover:bg-slate-200 transition-colors">
                                            <i class="fas fa-file"></i>
                                        </div>
                                    @endif
                                </a>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-500">
                                    Belum Upload
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            @if($value->status_pembayaran === 'Lunas')
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-green-50 text-green-700 border border-green-200">
                                    <i class="fas fa-check-circle"></i> Lunas
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200">
                                    <i class="fas fa-clock"></i> Pending
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex items-center justify-center gap-2">
                                {{-- Tombol Verifikasi --}}
                                <a href="{{ route('tagihan', $value->id_pembayaran) }}" class="px-3 py-1.5 rounded-lg bg-blue-50 text-blue-600 font-medium text-xs flex items-center gap-1.5 hover:bg-blue-600 hover:text-white transition-colors" title="Verifikasi Pembayaran">
                                    <i class="fas fa-check-double"></i> Verifikasi
                                </a>
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('delete', $value->id_pembayaran) }}" method="post" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data pembayaran ini?');">
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
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-3">
                                    <i class="fas fa-file-invoice-dollar text-2xl"></i>
                                </div>
                                <p class="text-slate-500 font-medium">Belum ada data pembayaran.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection