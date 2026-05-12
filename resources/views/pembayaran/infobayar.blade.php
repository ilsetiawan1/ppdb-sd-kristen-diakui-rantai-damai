@extends('layout.tampilancasis')

@section('title', 'Informasi Pembayaran')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    {{-- Page Header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Informasi Pembayaran</h1>
            <p class="text-slate-500 text-sm mt-1">Detail tagihan dan status pembayaran pendaftaran Anda.</p>
        </div>
        
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="{{ route('berandacasis') }}" class="hover:text-green-600 font-medium transition-colors">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-slate-800 font-medium">Pembayaran</span>
        </div>
    </div>

    @include('layout.alert')

    @if(!$kuotaTersedia)
    <div class="bg-amber-50 border-l-4 border-amber-500 p-5 rounded-r-xl shadow-sm mb-6 flex items-start gap-4">
        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div>
            <h4 class="text-lg font-bold text-amber-800 mb-1">Pendaftaran Tidak Tersedia!</h4>
            <p class="text-amber-700 text-sm mb-2">{{ $pesanKuota }}</p>
            <div class="h-px bg-amber-200 w-full my-2"></div>
            <p class="text-amber-700 text-xs font-medium">Silakan hubungi panitia untuk informasi lebih lanjut.</p>
        </div>
    </div>
    @else
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        
        {{-- Card: Data Calon Siswa --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-full">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                    <i class="fas fa-user-graduate text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800">Data Pendaftar</h3>
            </div>
            <div class="p-6">
                <dl class="space-y-4">
                    <div class="flex flex-col sm:flex-row py-2 border-b border-slate-50 last:border-0">
                        <dt class="sm:w-1/3 text-sm font-medium text-slate-500">NIK</dt>
                        <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis->nik ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:flex-row py-2 border-b border-slate-50 last:border-0">
                        <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Nama Lengkap</dt>
                        <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->name }}</dd>
                    </div>
                    <div class="flex flex-col sm:flex-row py-2 border-b border-slate-50 last:border-0">
                        <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Jenis Kelamin</dt>
                        <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis->jenis_kelamin ?? '-' }}</dd>
                    </div>
                    <div class="flex flex-col sm:flex-row py-2 border-b border-slate-50 last:border-0">
                        <dt class="sm:w-1/3 text-sm font-medium text-slate-500">TTL</dt>
                        <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">
                            {{ $user->casis->tempat_lahir ?? '-' }}
                            @if($user->casis && $user->casis->tanggal_lahir)
                            , {{ \Carbon\Carbon::parse($user->casis->tanggal_lahir)->format('d F Y') }}
                            @endif
                        </dd>
                    </div>
                    <div class="flex flex-col sm:flex-row py-2 border-b border-slate-50 last:border-0">
                        <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Nama Orang Tua</dt>
                        <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis->nama_ortu ?? '-' }}</dd>
                    </div>
                </dl>
            </div>
        </div>

        {{-- Card: Data Tagihan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-full flex flex-col">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-3">
                <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                    <i class="fas fa-file-invoice-dollar text-sm"></i>
                </div>
                <h3 class="font-bold text-slate-800">Rincian Tagihan</h3>
            </div>
            <div class="p-6 grow">
                <dl class="space-y-4">
                    <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50">
                        <dt class="sm:w-2/5 text-sm font-medium text-slate-500">Tujuan Transfer</dt>
                        <dd class="sm:w-3/5 mt-1 sm:mt-0">
                            <div class="font-bold text-slate-800">Bank BRI</div>
                            <div class="text-sm text-slate-600">Norek: 1234567890</div>
                            <div class="text-xs text-slate-500 mt-0.5">a.n SD Kristen Diakui Rantai Damai</div>
                        </dd>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50">
                        <dt class="sm:w-2/5 text-sm font-medium text-slate-500">Total Tagihan</dt>
                        <dd class="sm:w-3/5 mt-1 sm:mt-0 font-bold text-xl text-green-600">
                            Rp 100.000
                        </dd>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50">
                        <dt class="sm:w-2/5 text-sm font-medium text-slate-500">Status Pembayaran</dt>
                        <dd class="sm:w-3/5 mt-1 sm:mt-0">
                            @if($user->casis && $user->casis->pembayaran)
                                @if($user->casis->pembayaran->status_pembayaran === 'Lunas')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-green-50 text-green-700 text-sm font-bold border border-green-200">
                                        <i class="fas fa-check-circle"></i> Lunas
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-amber-50 text-amber-700 text-sm font-bold border border-amber-200">
                                        <i class="fas fa-clock"></i> Menunggu Verifikasi
                                    </span>
                                @endif
                            @else
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-red-50 text-red-700 text-sm font-bold border border-red-200">
                                    <i class="fas fa-times-circle"></i> Belum Dibayar
                                </span>
                            @endif
                        </dd>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:items-center py-2">
                        <dt class="sm:w-2/5 text-sm font-medium text-slate-500">Bukti Transfer</dt>
                        <dd class="sm:w-3/5 mt-1 sm:mt-0">
                            @if($user->casis && $user->casis->pembayaran && $user->casis->pembayaran->bukti_pembayaran)
                                @php
                                $bukti = $user->casis->pembayaran->bukti_pembayaran;
                                $file_path = asset('storage/pembayaran/' . $bukti);
                                @endphp
                                <a href="{{ $file_path }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors border border-slate-200">
                                    <i class="fas fa-image text-slate-400"></i> Lihat Bukti
                                </a>
                            @else
                                <span class="text-sm text-slate-400 italic">Belum diunggah</span>
                            @endif
                        </dd>
                    </div>
                </dl>
            </div>
            
            {{-- Action Area --}}
            @if(!$user->casis || !$user->casis->pembayaran || $user->casis->pembayaran->status_pembayaran !== 'Lunas')
            <div class="p-6 bg-slate-50 border-t border-slate-100">
                <a href="{{ route('pembayaran') }}" class="w-full flex items-center justify-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all">
                    <i class="fas fa-cloud-upload-alt"></i> Unggah Bukti Pembayaran
                </a>
            </div>
            @endif
        </div>
    </div>
    @endif
</div>
@endsection