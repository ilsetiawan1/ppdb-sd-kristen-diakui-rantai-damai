@extends('layout.tampilancasis')

@section('content')
<div class="min-h-screen bg-slate-50 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold text-slate-800">
                Profil Calon Siswa
            </h1>

            <p class="text-slate-500 mt-1">
                Informasi lengkap data calon siswa.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Sidebar Profile --}}
            <div class="lg:col-span-1">

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

                    {{-- Cover --}}
                    <div class="h-28 bg-gradient-to-r from-green-600 to-emerald-500"></div>

                    <div class="px-6 pb-6 relative">

                        {{-- Avatar --}}
                        <div class="flex justify-center">
                            <div class="-mt-16">
                                <img src="{{ asset('template/dist/img/user0-128x128.jpg') }}"
                                    alt="avatar"
                                    class="w-32 h-32 rounded-full border-4 border-white shadow-md object-cover">
                            </div>
                        </div>

                        {{-- Name --}}
                        <div class="text-center mt-4">
                            <h2 class="text-xl font-bold text-slate-800">
                                {{ $user->name }}
                            </h2>

                            <p class="text-sm text-slate-500 mt-1">
                                Akun Calon Siswa
                            </p>
                        </div>

                        {{-- Status --}}
                        <div class="mt-6">
                            <div class="bg-green-50 border border-green-100 rounded-xl p-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center">
                                        <i class="fas fa-user-graduate text-green-600"></i>
                                    </div>

                                    <div>
                                        <p class="text-sm text-slate-500">
                                            Status Akun
                                        </p>

                                        <p class="font-semibold text-green-700">
                                            Aktif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>

            {{-- Detail Profile --}}
            <div class="lg:col-span-2">

                <div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

                    {{-- Card Header --}}
                    <div class="px-6 py-5 border-b border-slate-100">
                        <h3 class="text-lg font-bold text-slate-800">
                            Informasi Detail
                        </h3>

                        <p class="text-sm text-slate-500 mt-1">
                            Data pribadi calon siswa yang telah terdaftar.
                        </p>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-6">

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Nama Lengkap --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-500">
                                    Nama Lengkap
                                </label>

                                <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium">
                                    {{ $casis->nama ?? 'Belum Ada' }}
                                </div>
                            </div>

                            {{-- NIK --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-500">
                                    NIK
                                </label>

                                <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium">
                                    {{ $casis->nik ?? 'Belum Ada' }}
                                </div>
                            </div>

                            {{-- Tempat Lahir --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-500">
                                    Tempat Lahir
                                </label>

                                <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium">
                                    {{ $casis->tempat_lahir ?? 'Belum Ada' }}
                                </div>
                            </div>

                            {{-- Tanggal Lahir --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-500">
                                    Tanggal Lahir
                                </label>

                                <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium">
                                    {{ $casis->tanggal_lahir ?? 'Belum Ada' }}
                                </div>
                            </div>

                            {{-- Jenis Kelamin --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-500">
                                    Jenis Kelamin
                                </label>

                                <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium">
                                    {{ $casis->jenis_kelamin ?? 'Belum Ada' }}
                                </div>
                            </div>

                            {{-- Nama Orang Tua --}}
                            <div>
                                <label class="text-sm font-semibold text-slate-500">
                                    Nama Orang Tua
                                </label>

                                <div class="mt-2 bg-slate-50 border border-slate-200 rounded-xl px-4 py-3 text-slate-800 font-medium">
                                    {{ $casis->nama_ortu ?? 'Belum Ada' }}
                                </div>
                            </div>

                        </div>

                        {{-- Empty State --}}
                        @if(!$casis)
                        <div class="mt-8">

                            <div class="bg-amber-50 border border-amber-200 rounded-2xl p-5 flex items-start gap-4">
                                <div class="w-12 h-12 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                                    <i class="fas fa-exclamation-circle text-amber-600"></i>
                                </div>

                                <div>
                                    <h4 class="font-semibold text-amber-800">
                                        Data Profil Belum Lengkap
                                    </h4>

                                    <p class="text-sm text-amber-700 mt-1">
                                        Silakan lengkapi data profil calon siswa untuk melanjutkan proses pendaftaran.
                                    </p>
                                </div>
                            </div>

                        </div>
                        @endif

                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection