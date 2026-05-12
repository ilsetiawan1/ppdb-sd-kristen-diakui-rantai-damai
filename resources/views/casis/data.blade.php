@extends('layout.tampilancasis')

@section('title', 'Data Pendaftaran')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    
    {{-- Alerts --}}
    @if (session('success'))
    <div x-data="{ show: true }" x-show="show" class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-start justify-between">
        <div class="flex items-start gap-3">
            <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
            <div>
                <h4 class="text-sm font-bold text-green-800">Berhasil!</h4>
                <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-green-500 hover:text-green-700"><i class="fas fa-times"></i></button>
    </div>
    @elseif (session('error'))
    <div x-data="{ show: true }" x-show="show" class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-start justify-between">
        <div class="flex items-start gap-3">
            <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
            <div>
                <h4 class="text-sm font-bold text-red-800">Error!</h4>
                <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
            </div>
        </div>
        <button @click="show = false" class="text-red-500 hover:text-red-700"><i class="fas fa-times"></i></button>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Data Pendaftaran</h1>
            <p class="text-slate-500 text-sm mt-1">Lengkapi profil calon siswa dan unggah dokumen persyaratan.</p>
        </div>
        
        <div class="flex items-center gap-3">
            @if(!$kuotaTersedia)
                <span class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-500 text-sm font-medium rounded-lg cursor-not-allowed">
                    <i class="fas fa-lock"></i> Kuota Penuh
                </span>
            @endif
        </div>
    </div>

    @if(!$kuotaTersedia)
        <div class="mb-6 bg-amber-50 border-l-4 border-amber-500 p-4 rounded-r-lg flex items-start gap-3">
            <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5 text-lg"></i>
            <div>
                <h4 class="font-bold text-amber-800">Pendaftaran Tidak Tersedia!</h4>
                <p class="text-sm text-amber-700 mt-1">{{ $pesanKuota }}</p>
                <p class="text-sm text-amber-700 mt-2">Silakan hubungi panitia untuk informasi lebih lanjut.</p>
            </div>
        </div>
    @endif

    {{-- Summary Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8 flex flex-col sm:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 rounded-full bg-slate-100 flex items-center justify-center text-xl text-slate-500 font-bold border border-slate-200">
                {{ substr($user->name, 0, 1) }}
            </div>
            <div>
                <h3 class="font-bold text-slate-800">{{ $user->name }}</h3>
                <p class="text-sm text-slate-500">{{ $user->email }}</p>
            </div>
        </div>
        <div class="flex flex-col items-end">
            <span class="text-xs text-slate-500 mb-1">Status Pendaftaran</span>
            @if(isset($user->casis) && isset($user->casis->pendaftaran))
                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">
                    {{ $user->casis->pendaftaran->status }}
                </span>
            @else
                <span class="px-3 py-1 bg-slate-100 text-slate-600 text-xs font-bold rounded-full">Belum Mengisi</span>
            @endif
        </div>
    </div>

    @if($kuotaTersedia)
        {{-- Data Grid --}}
        <div class="grid lg:grid-cols-2 gap-6 mb-6">
            {{-- Biodata --}}
            @include('components.casis.data-casis')

            {{-- Data Ortu --}}
            @include('components.casis.data-ortu')
        </div>

        {{-- Full Width: Berkas --}}
        @include('components.casis.berkas')
    @endif

</div>
@endsection