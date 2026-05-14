@extends('layout.tampilan')

@section('page-title', 'Tambah Tahun Ajaran')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

    <div class="mb-8 flex items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Tambah Tahun Ajaran</h1>
            <p class="text-slate-500 text-sm mt-1">Isi detail tahun ajaran baru untuk sistem PPDB.</p>
        </div>
        <a href="{{ route('beranda.tahun') }}" class="px-5 py-2 bg-white border border-slate-300 text-slate-700 font-semibold text-sm rounded-xl hover:bg-slate-50 transition-colors shadow-sm flex items-center gap-2">
            <i class="fas fa-arrow-left text-xs"></i> Kembali
        </a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
            <div class="w-10 h-10 rounded-full bg-green-100 text-green-600 flex items-center justify-center shrink-0">
                <i class="fas fa-calendar-plus"></i>
            </div>
            <div>
                <h2 class="text-lg font-bold text-slate-800">Form Tahun Ajaran Baru</h2>
                <p class="text-slate-500 text-xs">Semua field wajib diisi dengan benar.</p>
            </div>
        </div>

        <form method="POST" action="{{ route('tahun.simpan') }}" class="p-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                {{-- Tahun Ajaran --}}
                <div class="md:col-span-2">
                    <label for="tahun_ajar" class="block text-sm font-semibold text-slate-700 mb-2">
                        Tahun Ajaran <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="tahun_ajar" name="tahun_ajar"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-semibold text-lg focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all placeholder-slate-400"
                        placeholder="Contoh: 2025/2026" required>
                    <p class="text-slate-400 text-xs mt-1">Format: YYYY/YYYY (contoh: 2025/2026)</p>
                </div>

                {{-- Mulai Pendaftaran --}}
                <div>
                    <label for="mulai_pendaftaran" class="block text-sm font-semibold text-slate-700 mb-2">
                        Tanggal Mulai Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="mulai_pendaftaran" name="mulai_pendaftaran"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                        required>
                </div>

                {{-- Batas Pendaftaran --}}
                <div>
                    <label for="batas_pendaftaran" class="block text-sm font-semibold text-slate-700 mb-2">
                        Tanggal Batas Pendaftaran <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="batas_pendaftaran" name="batas_pendaftaran"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                        required>
                </div>

                {{-- Tanggal Seleksi --}}
                <div>
                    <label for="tgl_seleksi" class="block text-sm font-semibold text-slate-700 mb-2">
                        Tanggal Seleksi <span class="text-red-500">*</span>
                    </label>
                    <input type="date" id="tgl_seleksi" name="tgl_seleksi"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                        required>
                </div>

                {{-- Kuota --}}
                <div>
                    <label for="kuota" class="block text-sm font-semibold text-slate-700 mb-2">
                        Kuota Penerimaan <span class="text-red-500">*</span>
                    </label>
                    <input type="number" id="kuota" name="kuota" min="1"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                        placeholder="Contoh: 30" required>
                    <p class="text-slate-400 text-xs mt-1">Jumlah maksimal siswa yang dapat diterima</p>
                </div>

                {{-- Status --}}
                <div class="md:col-span-2">
                    <label for="status" class="block text-sm font-semibold text-slate-700 mb-2">
                        Status Tahun Ajaran <span class="text-red-500">*</span>
                    </label>
                    <select id="status" name="status"
                        class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-green-500/20 focus:border-green-500 transition-all"
                        required>
                        <option value="" disabled selected>-- Pilih Status --</option>
                        <option value="Belum Dimulai">📅 Belum Dimulai</option>
                        <option value="Berlangsung">🟢 Berlangsung (Aktif)</option>
                        <option value="Berakhir">✅ Berakhir</option>
                    </select>
                    <p class="text-slate-400 text-xs mt-1">Hanya satu tahun ajaran yang boleh berstatus <strong>"Berlangsung"</strong> pada satu waktu.</p>
                </div>
            </div>

            <div class="mt-8 pt-6 border-t border-slate-100 flex gap-3">
                <button type="submit"
                    class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-all shadow-md shadow-green-600/20 hover:-translate-y-0.5 flex items-center gap-2">
                    <i class="fas fa-save"></i> Simpan Tahun Ajaran
                </button>
                <a href="{{ route('beranda.tahun') }}"
                    class="px-6 py-3 bg-white border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition-colors">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
