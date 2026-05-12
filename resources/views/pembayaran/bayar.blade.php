@extends('layout.tampilancasis')

@section('title', 'Form Pembayaran')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    {{-- Page Header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Form Pembayaran</h1>
            <p class="text-slate-500 text-sm mt-1">Selesaikan pembayaran pendaftaran Anda dan unggah buktinya di sini.</p>
        </div>
        
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="{{ route('berandacasis') }}" class="hover:text-blue-600 font-medium transition-colors">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-slate-800 font-medium">Pembayaran</span>
        </div>
    </div>

    @include('layout.alert')

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Kolom Kiri: Info dan Panduan --}}
        <div class="lg:col-span-1 space-y-6">
            {{-- Info Bank --}}
            <div class="bg-gradient-to-br from-blue-600 to-blue-800 rounded-2xl shadow-sm overflow-hidden text-white">
                <div class="p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center backdrop-blur-sm">
                            <i class="fas fa-university text-lg"></i>
                        </div>
                        <h3 class="font-bold text-lg">Tujuan Transfer</h3>
                    </div>
                    
                    <div class="space-y-4">
                        <div>
                            <p class="text-blue-200 text-sm mb-1">Bank Tujuan</p>
                            <p class="font-bold text-xl">Bank BRI</p>
                        </div>
                        <div>
                            <p class="text-blue-200 text-sm mb-1">Nomor Rekening</p>
                            <div class="flex items-center gap-2">
                                <p class="font-mono text-2xl font-bold tracking-wider">1234567890</p>
                            </div>
                        </div>
                        <div>
                            <p class="text-blue-200 text-sm mb-1">Atas Nama</p>
                            <p class="font-bold">SD Kristen Diakui Rantai Damai</p>
                        </div>
                        <div class="pt-4 border-t border-blue-500/30">
                            <p class="text-blue-200 text-sm mb-1">Total Pembayaran</p>
                            <p class="font-bold text-2xl text-amber-300">Rp 100.000</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Panduan --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6">
                <h3 class="font-bold text-slate-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-list-ol text-blue-500"></i> Cara Pembayaran
                </h3>
                <ul class="space-y-3">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">1</span>
                        <p class="text-sm text-slate-600">Transfer tepat <strong>Rp 100.000</strong> ke rekening BRI yang tertera di atas.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">2</span>
                        <p class="text-sm text-slate-600">Simpan struk ATM atau screenshot bukti transfer mobile banking Anda.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">3</span>
                        <p class="text-sm text-slate-600">Unggah gambar bukti transfer pada formulir di samping.</p>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-blue-50 text-blue-600 flex items-center justify-center text-xs font-bold shrink-0 mt-0.5">4</span>
                        <p class="text-sm text-slate-600">Klik konfirmasi dan tunggu verifikasi dari panitia PPDB.</p>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Kolom Kanan: Form Upload --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-indigo-100 text-indigo-600 flex items-center justify-center">
                        <i class="fas fa-upload text-sm"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Form Konfirmasi Pembayaran</h3>
                </div>
                
                <form method="post" action="{{ route('pelunasan') }}" enctype="multipart/form-data" class="p-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        {{-- Data Diri (Readonly) --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">NIK Casis</label>
                            <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed" 
                                   value="{{ $user->casis ? $user->casis->nik : 'Belum Melakukan Pendaftaran' }}" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Casis</label>
                            <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed" 
                                   value="{{ $user->casis ? $user->casis->nama : 'Belum Melakukan Pendaftaran' }}" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Jenis Kelamin</label>
                            <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed" 
                                   value="{{ $user->casis ? $user->casis->jenis_kelamin : '-' }}" readonly>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Tempat, Tanggal Lahir</label>
                            <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed" 
                                   value="{{ $user->casis ? $user->casis->tempat_lahir . ', ' . \Carbon\Carbon::parse($user->casis->tanggal_lahir)->format('d F Y') : '-' }}" readonly>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Orang Tua</label>
                            <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed" 
                                   value="{{ $user->casis ? $user->casis->nama_ortu : '-' }}" readonly>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Status Saat Ini</label>
                            <div class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 font-medium">
                                @isset($user->casis->pembayaran)
                                    @if($user->casis->pembayaran->status_pembayaran === 'Lunas')
                                        <span class="text-green-600"><i class="fas fa-check-circle mr-1"></i> Lunas</span>
                                    @else
                                        <span class="text-amber-600"><i class="fas fa-clock mr-1"></i> Pending / Menunggu Verifikasi</span>
                                    @endif
                                @else 
                                    <span class="text-red-500"><i class="fas fa-times-circle mr-1"></i> Belum Lunas</span>
                                @endisset
                            </div>
                        </div>

                        {{-- Input Bukti Pembayaran --}}
                        <div class="md:col-span-2 mt-2">
                            <label for="bukti_pembayaran" class="block text-sm font-semibold text-slate-700 mb-2">Unggah Bukti Transfer <span class="text-red-500">*</span></label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-300 border-dashed rounded-xl hover:bg-slate-50 hover:border-blue-400 transition-colors group relative" x-data="{ fileName: '' }">
                                <div class="space-y-2 text-center">
                                    <i class="fas fa-image text-4xl text-slate-300 group-hover:text-blue-400 mb-2"></i>
                                    <div class="flex text-sm text-slate-600 justify-center">
                                        <label for="bukti_pembayaran" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span x-text="fileName === '' ? 'Pilih file gambar' : 'Ganti file'">Pilih file gambar</span>
                                            <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only" accept="image/jpeg,image/png,image/jpg" @change="fileName = $event.target.files[0].name" required>
                                        </label>
                                        <p class="pl-1" x-show="fileName === ''">atau drag and drop</p>
                                    </div>
                                    <p class="text-xs text-slate-500" x-show="fileName === ''">PNG, JPG, JPEG (Max. 2MB)</p>
                                    <p class="text-sm font-semibold text-blue-600 mt-2" x-show="fileName !== ''" x-text="'File terpilih: ' + fileName"></p>
                                </div>
                            </div>
                            @error('bukti_pembayaran')
                            <p class="text-red-500 text-xs mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-4 border-t border-slate-100">
                        <a href="{{ route('berandacasis') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 hover:text-slate-800 transition-colors">
                            Kembali ke Beranda
                        </a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                            <i class="fas fa-paper-plane"></i> Kirim Konfirmasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection