@extends('layout.tampilan')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Verifikasi Daftar Ulang</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola dan verifikasi pembayaran daftar ulang calon siswa yang telah lolos seleksi.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50">
            <form action="{{ route('admin.daftar_ulang.index') }}" method="GET" id="filterForm" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-search text-slate-400"></i>
                        </div>
                        <input type="text" name="search" class="w-full pl-10 pr-4 py-2 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm transition-all" placeholder="Cari nama calon siswa..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="md:w-64">
                    <select name="status" id="statusFilter" class="w-full px-4 py-2 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-sm transition-all" onchange="document.getElementById('filterForm').submit()">
                        <option value="">Semua Status</option>
                        <option value="Menunggu Konfirmasi" {{ request('status') == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                        <option value="Berhasil" {{ request('status') == 'Berhasil' ? 'selected' : '' }}>Berhasil</option>
                        <option value="Gagal" {{ request('status') == 'Gagal' ? 'selected' : '' }}>Gagal</option>
                    </select>
                </div>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-slate-50 border-b border-slate-200 text-slate-500">
                    <tr>
                        <th class="px-6 py-4 font-semibold">No</th>
                        <th class="px-6 py-4 font-semibold">Nama Casis</th>
                        <th class="px-6 py-4 font-semibold">Tanggal Daftar Ulang</th>
                        <th class="px-6 py-4 font-semibold">Metode</th>
                        <th class="px-6 py-4 font-semibold">Jumlah Bayar</th>
                        <th class="px-6 py-4 font-semibold">Status</th>
                        <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($daftarUlang as $index => $item)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 text-slate-600">{{ $daftarUlang->firstItem() + $index }}</td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-slate-800">{{ $item->pendaftaran->casis->nama }}</span>
                        </td>
                        <td class="px-6 py-4 text-slate-600">{{ date('d/m/Y H:i', strtotime($item->tgl_daftar_ulang)) }}</td>
                        <td class="px-6 py-4 text-slate-600">{{ $item->metode_pembayaran }}</td>
                        <td class="px-6 py-4 font-semibold text-blue-600">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                        <td class="px-6 py-4">
                            @if($item->status_bayar == 'Berhasil')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">Berhasil</span>
                            @elseif($item->status_bayar == 'Menunggu Konfirmasi')
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">Menunggu</span>
                            @else
                                <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">Gagal</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('admin.daftar_ulang.show', $item->id_daftar_ulang) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-colors tooltip" data-tip="Lihat Detail & Verifikasi">
                                <i class="fas fa-eye text-sm"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-100 text-slate-400 mb-3">
                                <i class="fas fa-inbox text-xl"></i>
                            </div>
                            <h3 class="text-slate-800 font-bold mb-1">Tidak ada data daftar ulang</h3>
                            <p class="text-slate-500 text-sm">Belum ada calon siswa yang mengunggah bukti daftar ulang.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($daftarUlang->hasPages())
        <div class="p-4 border-t border-slate-100">
            {{ $daftarUlang->appends(request()->query())->links() }}
        </div>
        @endif
    </div>
</div>
@endsection