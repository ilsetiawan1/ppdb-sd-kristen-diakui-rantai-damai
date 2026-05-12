@extends('layout.tampilan')

@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">
    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-green-600 to-teal-700 rounded-2xl p-6 sm:p-8 shadow-sm">
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white mb-2 font-heading">
                    Halo, {{ Auth::user()->name }}! 👋
                </h1>
                <p class="text-green-50 text-sm sm:text-base max-w-2xl">
                    Selamat datang di Panel Admin PPDB. Kelola pendaftaran, pembayaran, dan seleksi calon siswa dengan mudah dan cepat.
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
        
        {{-- Kuota Card --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600">
                    <i class="fas fa-chart-pie"></i>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg">Kuota</span>
            </div>
            <div>
                <h3 class="text-slate-500 text-sm font-medium mb-1">Keterisian Kuota</h3>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-bold text-slate-800">{{ $kuotaTerisi }}</span>
                    <span class="text-slate-400 text-lg font-medium mb-1">/ {{ $kuotaTotal }}</span>
                </div>
            </div>
            <div class="mt-4 pt-4 border-t border-slate-50 flex justify-between text-xs">
                <span class="text-slate-500">Tersisa: <strong class="text-slate-700">{{ $kuotaTersisa }}</strong></span>
                <span class="{{ $kuotaTerisi >= $kuotaTotal ? 'text-red-500 font-semibold' : 'text-green-500' }}">
                    {{ $kuotaTotal > 0 ? round(($kuotaTerisi / $kuotaTotal) * 100) : 0 }}% Terisi
                </span>
            </div>
            {{-- Progress bar --}}
            <div class="w-full bg-slate-100 rounded-full h-1.5 mt-3">
                <div class="bg-blue-500 h-1.5 rounded-full" style="width: {{ $kuotaTotal > 0 ? min(100, ($kuotaTerisi / $kuotaTotal) * 100) : 0 }}%"></div>
            </div>
        </div>

        {{-- Total Pendaftar --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-purple-50 flex items-center justify-center text-purple-600">
                    <i class="fas fa-users"></i>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-slate-100 text-slate-600 rounded-lg">Pendaftar</span>
            </div>
            <div>
                <h3 class="text-slate-500 text-sm font-medium mb-1">Total Pendaftar</h3>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-bold text-slate-800">{{ $totalPendaftar }}</span>
                    <span class="text-slate-400 text-sm font-medium mb-1">Casis</span>
                </div>
            </div>
            <div class="mt-auto pt-4 border-t border-slate-50">
                <a href="/pendaftaran" class="text-purple-600 hover:text-purple-700 text-xs font-semibold flex items-center gap-1 transition-colors">
                    Lihat Data Pendaftar <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        {{-- Diterima --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-green-50 flex items-center justify-center text-green-600">
                    <i class="fas fa-user-check"></i>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-green-100 text-green-700 rounded-lg">Lulus</span>
            </div>
            <div>
                <h3 class="text-slate-500 text-sm font-medium mb-1">Pendaftar Diterima</h3>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-bold text-slate-800">{{ $totalDiterima }}</span>
                    <span class="text-slate-400 text-sm font-medium mb-1">Casis</span>
                </div>
            </div>
            <div class="mt-auto pt-4 border-t border-slate-50">
                <a href="/laporan/siswa lulus" class="text-green-600 hover:text-green-700 text-xs font-semibold flex items-center gap-1 transition-colors">
                    Lihat Laporan Kelulusan <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

        {{-- Ditolak --}}
        <div class="bg-white rounded-2xl p-5 border border-slate-100 shadow-sm flex flex-col">
            <div class="flex items-center justify-between mb-4">
                <div class="w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center text-red-600">
                    <i class="fas fa-user-times"></i>
                </div>
                <span class="text-xs font-semibold px-2.5 py-1 bg-red-100 text-red-700 rounded-lg">Gagal</span>
            </div>
            <div>
                <h3 class="text-slate-500 text-sm font-medium mb-1">Pendaftar Ditolak</h3>
                <div class="flex items-end gap-2">
                    <span class="text-3xl font-bold text-slate-800">{{ $totalDitolak }}</span>
                    <span class="text-slate-400 text-sm font-medium mb-1">Casis</span>
                </div>
            </div>
            <div class="mt-auto pt-4 border-t border-slate-50">
                <a href="/laporan/siswa/tidak lulus" class="text-red-600 hover:text-red-700 text-xs font-semibold flex items-center gap-1 transition-colors">
                    Lihat Data Penolakan <i class="fas fa-arrow-right text-[10px]"></i>
                </a>
            </div>
        </div>

    </div>
</div>
@endsection
