@extends ('layout.tampilanpanitia')

@section('page-title', 'Input Nilai Seleksi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Input Nilai Seleksi</h1>
            <p class="text-slate-500 text-sm mt-1">Evaluasi kemampuan calon siswa untuk PPDB SD Kristen Diakui Rantai Damai.</p>
        </div>
        <div class="flex items-center gap-2 mt-4 sm:mt-0">
            <a href="{{ route('nilai') }}" class="px-4 py-2 bg-slate-100 hover:bg-slate-200 text-slate-700 text-sm font-semibold rounded-xl transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>Kembali
            </a>
        </div>
    </div>

    @include('layout.alert')

    {{-- Form Card --}}
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="bg-slate-50/50 border-b border-slate-100 px-6 py-4 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Data Calon Siswa</h2>
                <p class="text-xs text-slate-500">NIK: {{ $data->nik }}</p>
            </div>
        </div>

        <form method="post" action="{{ route('simpan', ['id' => $data->id_casis]) }}" class="p-6 md:p-8">
            @csrf

            {{-- Info Siswa (Readonly) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 pb-8 border-b border-slate-100">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                    <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed font-medium" value="{{ $data->nama }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Penilaian</label>
                    <input type="date" name="tgl_seleksi" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-2.5 text-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-medium" value="{{ $seleksi->tgl_seleksi ?? date('Y-m-d') }}" required>
                </div>
            </div>

            {{-- Input Nilai --}}
            <h3 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                <i class="fas fa-star text-amber-400"></i> Form Penilaian (Skala 0-100)
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                {{-- Baca --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Membaca</label>
                    <div class="relative">
                        <input type="number" name="nilai_baca" min="0" max="100" class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-slate-800 font-bold text-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-center" placeholder="0" value="{{ $seleksi->nilai_baca ?? '' }}" required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-book-reader text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- Tulis --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Menulis</label>
                    <div class="relative">
                        <input type="number" name="nilai_tulis" min="0" max="100" class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-slate-800 font-bold text-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-center" placeholder="0" value="{{ $seleksi->nilai_tulis ?? '' }}" required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-pen-nib text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- Hitung --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Menghitung</label>
                    <div class="relative">
                        <input type="number" name="nilai_hitung" min="0" max="100" class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-slate-800 font-bold text-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-center" placeholder="0" value="{{ $seleksi->nilai_hitung ?? '' }}" required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-calculator text-sm"></i>
                        </div>
                    </div>
                </div>

                {{-- Wawancara --}}
                <div class="space-y-2">
                    <label class="block text-sm font-semibold text-slate-700">Wawancara Ortu</label>
                    <div class="relative">
                        <input type="number" name="nilai_wawancara" min="0" max="100" class="w-full bg-white border border-slate-200 rounded-xl pl-10 pr-4 py-2.5 text-slate-800 font-bold text-lg focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all text-center" placeholder="0" value="{{ $seleksi->nilai_wawancara ?? '' }}" required>
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <i class="fas fa-comments text-sm"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 border-t border-slate-100">
                <a href="{{ route('nilai') }}" class="px-6 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 transition-colors">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-md shadow-blue-600/20 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Penilaian
                </button>
            </div>
        </form>
    </div>
</div>
@endsection