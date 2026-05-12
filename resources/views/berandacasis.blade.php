@extends('layout.tampilancasis')

@section('title', 'Beranda Calon Siswa')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    
    {{-- Page Header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Portal Calon Siswa</h1>
            <p class="text-slate-500 text-sm mt-1">Kelola data pendaftaran dan pantau status PPDB Anda di sini.</p>
        </div>
        
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="#" class="hover:text-green-600 font-medium transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-slate-800 font-medium">Beranda</span>
        </div>
    </div>

    {{-- Welcome Banner --}}
    <div class="relative overflow-hidden bg-linear-to-br from-blue-600 to-indigo-700 rounded-3xl p-8 sm:p-10 mb-8 shadow-lg shadow-blue-900/20">
        <div class="relative z-10 md:w-2/3">
            <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 hover:bg-white/30 transition-colors rounded-full text-white/90 text-xs font-semibold tracking-wide uppercase mb-4 backdrop-blur-sm border border-white/10">
                <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                PPDB {{ date('Y') }} / {{ date('Y')+1 }}
            </div>
            <h1 class="text-3xl sm:text-4xl font-bold text-white mb-3 font-heading leading-tight">
                Halo, <span class="text-blue-200">{{ Auth::user()->name }}</span> 👋
            </h1>
            <p class="text-blue-100 text-lg max-w-xl leading-relaxed">
                Selamat datang di Portal Calon Siswa. Selesaikan tahapan pendaftaran Anda dan pantau terus informasi seleksi dari kami.
            </p>
        </div>
        
        {{-- Decorative Elements --}}
        <div class="absolute right-0 top-0 w-1/3 h-full opacity-10 pointer-events-none hidden md:block">
            <svg viewBox="0 0 400 400" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-full object-cover">
                <circle cx="200" cy="200" r="150" stroke="white" stroke-width="40" stroke-dasharray="20 20"/>
                <circle cx="200" cy="200" r="100" stroke="white" stroke-width="20"/>
            </svg>
        </div>
        <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white/10 rounded-full blur-3xl pointer-events-none"></div>
    </div>

    {{-- Main Content Grid --}}
    <div class="grid lg:grid-cols-12 gap-8">
        
        {{-- Left Column: Pengumuman & Alur --}}
        <div class="lg:col-span-7 flex flex-col gap-8">
            @if(isset($tahunajar))
                @include('components.casis.pengumuman-card')
            @endif
        </div>

        <div class="lg:col-span-5 flex flex-col gap-8">
            @include('components.casis.alur-card')
        </div>

        {{-- Full Width: Informasi --}}
        <div class="lg:col-span-12 mt-2">
            @include('components.casis.informasi-card')
        </div>

    </div>
</div>
@endsection
