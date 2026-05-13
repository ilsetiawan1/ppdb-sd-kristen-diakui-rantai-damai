@extends('layout.tampilanpanitia')

@section('page-title', 'Dashboard Panitia')

@section('content')

<div class="space-y-6">

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden bg-linear-to-br from-green-600 to-teal-700 rounded-2xl p-6 sm:p-8 shadow-sm">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2 font-heading">
                    Halo, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-green-50 text-sm sm:text-base max-w-2xl">
                    Selamat datang di Panel Panitia PPDB. Kelola pendaftaran, seleksi, dan verifikasi calon siswa dengan mudah dan cepat.
                </p>
            </div>
            <div class="shrink-0 bg-white/10 backdrop-blur-md border border-white/20 rounded-xl px-5 py-3 text-center">
                <p class="text-green-100 text-xs font-semibold uppercase tracking-wider mb-1">Tahun Ajaran Aktif</p>
                <p class="text-2xl font-bold text-white">{{ $tahunAjaranString }}</p>
            </div>
        </div>
        
        {{-- Decorative --}}
        <div class="absolute right-0 top-0 w-64 h-64 bg-white/5 rounded-full blur-3xl pointer-events-none -translate-y-1/2 translate-x-1/3"></div>
    </div>

    {{-- Stats Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
        
        {{-- Kuota Card Component --}}
        <x-panitia.dashboard.kuota-card 
            :terisi="$kuotaTerisi" 
            :total="$kuotaTotal" 
            :tersisa="$kuotaTersisa" />

        {{-- Total Pendaftar --}}
        <x-panitia.dashboard.stat-card 
            title="Total Pendaftar"
            :value="$totalPendaftar"
            suffix="Casis"
            icon="fas fa-users"
            iconColor="purple"
            badgeText="Pendaftar"
            badgeColor="slate"
            linkText="Lihat Data Seleksi"
            linkUrl="/panitia/form nilai" />

        {{-- Diterima --}}
        <x-panitia.dashboard.stat-card 
            title="Pendaftar Diterima"
            :value="$totalDiterima"
            suffix="Casis"
            icon="fas fa-user-check"
            iconColor="green"
            badgeText="Lulus"
            badgeColor="green"
            linkText="Lihat Laporan Kelulusan"
            linkUrl="/laporan/siswa lulus" />

        {{-- Ditolak --}}
        <x-panitia.dashboard.stat-card 
            title="Pendaftar Ditolak"
            :value="$totalDitolak"
            suffix="Casis"
            icon="fas fa-user-times"
            iconColor="red"
            badgeText="Gagal"
            badgeColor="red"
            linkText="Lihat Data Penolakan"
            linkUrl="/laporan/siswa/tidak lulus" />

    </div>

    {{-- Top 5 Casis Table --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mt-2">
        <div class="p-5 sm:p-6 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-base sm:text-lg font-bold text-slate-800 flex items-center gap-2">
                <i class="fas fa-trophy text-amber-500"></i>
                Top 5 Calon Siswa (Lolos Seleksi)
            </h3>
            <a href="/panitia/form nilai" class="text-xs sm:text-sm font-medium text-blue-600 hover:text-blue-700 flex items-center gap-1 transition-colors">
                Selengkapnya <i class="fas fa-arrow-right text-[10px]"></i>
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-sm text-left text-slate-600">
                <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 font-semibold">Peringkat</th>
                        <th class="px-6 py-4 font-semibold">Nama Calon Siswa</th>
                        <th class="px-6 py-4 font-semibold text-right">Nilai Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 bg-white">
                    @forelse ($casisTertinggi as $index => $casis)
                    <tr class="hover:bg-slate-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center w-8 h-8 rounded-full shadow-sm
                                @if($index == 0) text-amber-600
                                @elseif($index == 1)
                                @elseif($index == 2)
                                @else bg-slate-50 border border-slate-100
                                @endif 
                                font-bold text-xs">
                                @if($index < 3)
                                    <i class="fas fa-medal"></i>
                                @else
                                    #{{ $index + 1 }}
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-bold text-slate-800 text-base">{{ $casis->casis->nama }}</div>
                            <div class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-[10px] font-bold bg-green-100 text-green-700 mt-1 uppercase tracking-wider">
                                <i class="fas fa-check"></i> Lolos Seleksi
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="inline-flex items-center justify-center px-3 py-1 rounded-lg bg-blue-50 text-blue-700 font-bold text-sm">
                                {{ number_format($casis->nilai_akhir, 2) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center">
                                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-3 border border-slate-100 shadow-inner">
                                    <i class="fas fa-star text-2xl"></i>
                                </div>
                                <h4 class="text-slate-700 font-semibold">Belum Ada Data</h4>
                                <p class="text-slate-500 text-xs mt-1">Belum ada calon siswa yang lolos seleksi.</p>
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
