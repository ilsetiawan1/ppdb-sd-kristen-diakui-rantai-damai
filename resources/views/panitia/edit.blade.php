@extends('layout.tampilan')

@section('page-title', 'Edit Panitia')

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    {{-- Header Section --}}
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Edit Data Panitia</h1>
            <p class="text-slate-500 text-sm mt-1">Perbarui informasi akun dan tugas kepanitiaan PPDB.</p>
        </div>
        <a href="/admin/data/panitia" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 hover:bg-slate-200 hover:text-slate-800 rounded-xl text-sm font-medium transition-colors">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Main Form Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 sm:p-8">
            <form method="post" action="/admin/data/panitia/update/{{$data->id_panitia}}" class="space-y-8">
                @csrf

                {{-- Group: Informasi Akun --}}
                <div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-user-shield text-sm"></i>
                        </div>
                        Informasi Akun
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pl-0 md:pl-10">
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Username <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ $data->user->name }}" required placeholder="Masukkan username" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Email <span class="text-red-500">*</span></label>
                            <input type="email" name="email" value="{{ $data->user->email }}" required placeholder="admin@sekolah.com" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                        </div>
                        <div class="col-span-1 md:col-span-2">
                            <div class="p-4 bg-amber-50 border border-amber-200 rounded-xl flex gap-3 text-sm text-amber-800">
                                <i class="fas fa-info-circle mt-0.5 shrink-0"></i>
                                <div>
                                    <p class="font-semibold">Catatan Keamanan</p>
                                    <p class="opacity-90 mt-0.5">Password tidak dapat diubah dari sini. Jika panitia lupa password, Anda bisa meresetnya dari menu Data Master > Data User (Akun).</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100">

                {{-- Group: Profil Panitia --}}
                <div>
                    <h3 class="text-lg font-semibold text-slate-800 mb-4 flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-id-card text-sm"></i>
                        </div>
                        Profil Kepanitiaan
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pl-0 md:pl-10">
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" name="nama" value="{{ $data->nama }}" required placeholder="Nama lengkap panitia" class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all">
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-sm font-medium text-slate-700">Jenis Kelamin <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="jenis_kelamin" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all appearance-none">
                                    <option value="" disabled>Pilih jenis kelamin</option>
                                    <option value="Laki-Laki" {{ $data->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ $data->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>
                        </div>
                        <div class="space-y-1.5 md:col-span-2">
                            <label class="text-sm font-medium text-slate-700">Status Tugas <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <select name="status" required class="w-full px-4 py-2.5 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:outline-none focus:bg-white focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all appearance-none">
                                    <option value="" disabled>Pilih status tugas</option>
                                    <option value="Aktif" {{ $data->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="Non Aktif" {{ $data->status == 'Non Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 text-xs pointer-events-none"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="flex items-center gap-3 pt-6 mt-6 border-t border-slate-100">
                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-green-600 text-white hover:bg-green-700 rounded-xl text-sm font-medium transition-all shadow-sm shadow-green-600/20 active:scale-[0.98]">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="/admin/data/panitia" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-white border border-slate-200 text-slate-600 hover:bg-slate-50 hover:text-slate-800 rounded-xl text-sm font-medium transition-colors">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection