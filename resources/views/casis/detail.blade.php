@extends('layout.tampilan')

@section('page-title', 'Detail Calon Siswa')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex items-center justify-between bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-100">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-user-graduate"></i>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800 font-heading">Profil Calon Siswa</h1>
                <p class="text-sm text-slate-500">Rincian data pendaftaran atas nama <span class="font-semibold text-slate-700">{{ $casis->nama }}</span></p>
            </div>
        </div>
        <div class="hidden sm:block">
            <a href="/admin/data/casis" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-800 rounded-lg text-sm font-medium transition-colors">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Kolom Kiri: Data Casis --}}
        <div class="lg:col-span-2 space-y-6">
            
            {{-- Data Calon Siswa --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">
                        <i class="fas fa-address-card"></i>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Data Calon Siswa</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">NIK</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->nik ?: '-' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Lengkap</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->nama ?: '-' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tempat Lahir</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->tempat_lahir ?: '-' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Lahir</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                                {{ $casis->tanggal_lahir ? \Carbon\Carbon::parse($casis->tanggal_lahir)->translatedFormat('d F Y') : '-' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Jenis Kelamin</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                                @if($casis->jenis_kelamin == 'Laki-Laki')
                                    <span class="text-blue-600"><i class="fas fa-mars mr-1"></i> Laki-Laki</span>
                                @elseif($casis->jenis_kelamin == 'Perempuan')
                                    <span class="text-pink-600"><i class="fas fa-venus mr-1"></i> Perempuan</span>
                                @else
                                    -
                                @endif
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Anak Ke / Jml Saudara</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->jml_saudara ?: 'belum diinput' }}</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data Orang Tua --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                        <i class="fas fa-users"></i>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Data Orang Tua / Wali</h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nama Orang Tua</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->nama_ortu ?: '-' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pendidikan</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->pendidikan_ortu ?: 'belum diinput' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tempat Lahir</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->tempat_lahir_ortu ?: 'belum diinput' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Tanggal Lahir</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                                {{ $casis->tanggal_lahir_ortu ? \Carbon\Carbon::parse($casis->tanggal_lahir_ortu)->translatedFormat('d F Y') : 'belum diinput' }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Pekerjaan</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->pekerjaan_ortu ?: 'belum diinput' }}</div>
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Penghasilan / Gaji</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->gaji_ortu ?: 'belum diinput' }}</div>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Nomor Telepon (WhatsApp)</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100 flex items-center gap-2">
                                <i class="fab fa-whatsapp text-green-500"></i> {{ $casis->no_hp ?: 'belum diinput' }}
                            </div>
                        </div>
                        <div class="sm:col-span-2">
                            <label class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1">Alamat Lengkap</label>
                            <div class="text-slate-800 font-medium bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">{{ $casis->alamat ?: 'belum diinput' }}</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Kolom Kanan: Berkas --}}
        <div class="space-y-6">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                        <i class="fas fa-folder-open"></i>
                    </div>
                    <h2 class="text-lg font-bold text-slate-800">Berkas Upload</h2>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        @php
                            $pendaftaran = $casis->pendaftaran;
                            $documents = [
                                'foto' => ['label' => 'Pas Foto 3x4', 'icon' => 'fa-image', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                                'akte' => ['label' => 'Akte Kelahiran', 'icon' => 'fa-file-contract', 'color' => 'text-green-500', 'bg' => 'bg-green-50'],
                                'kk' => ['label' => 'Kartu Keluarga', 'icon' => 'fa-id-card', 'color' => 'text-amber-500', 'bg' => 'bg-amber-50'],
                            ];
                        @endphp

                        @foreach($documents as $docField => $docInfo)
                            @php
                                $hasDoc = $pendaftaran && $pendaftaran->$docField;
                                $file_path = $hasDoc ? asset('storage/berkas/' . $pendaftaran->$docField) : '#';
                            @endphp
                            <div class="flex items-center justify-between p-3 rounded-xl border {{ $hasDoc ? 'border-slate-200 bg-white' : 'border-dashed border-slate-200 bg-slate-50' }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-lg {{ $hasDoc ? $docInfo['bg'] . ' ' . $docInfo['color'] : 'bg-slate-100 text-slate-400' }} flex items-center justify-center">
                                        <i class="fas {{ $docInfo['icon'] }}"></i>
                                    </div>
                                    <div>
                                        <h4 class="text-sm font-semibold {{ $hasDoc ? 'text-slate-800' : 'text-slate-500' }}">{{ $docInfo['label'] }}</h4>
                                        <p class="text-xs {{ $hasDoc ? 'text-green-600 font-medium' : 'text-slate-400' }}">
                                            @if($hasDoc)
                                                <i class="fas fa-check-circle mr-0.5"></i> Terunggah
                                            @else
                                                Belum diunggah
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if($hasDoc)
                                    <a href="{{ $file_path }}" target="_blank" class="w-8 h-8 flex items-center justify-center rounded-lg bg-slate-100 text-slate-600 hover:bg-slate-200 transition-colors" title="Lihat Berkas">
                                        <i class="fas fa-external-link-alt text-xs"></i>
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Mobile Back Button --}}
            <div class="sm:hidden">
                <a href="/admin/data/casis" class="flex items-center justify-center gap-2 w-full py-3 bg-slate-100 text-slate-700 hover:bg-slate-200 rounded-xl font-medium transition-colors">
                    <i class="fas fa-arrow-left"></i> Kembali ke Data Casis
                </a>
            </div>
        </div>
    </div>
</div>
@endsection