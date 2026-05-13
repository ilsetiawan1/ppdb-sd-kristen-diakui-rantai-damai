@extends('layout.tampilancasis')

@section('page-title', 'Pengumuman Hasil Seleksi')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">

    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Pengumuman Hasil Seleksi</h1>
            <p class="text-slate-500 text-sm mt-1">Cek hasil seleksi penerimaan peserta didik baru Anda.</p>
        </div>
    </div>

    @if (!isset($data) || count($data) === 0)
        <div class="bg-blue-50 border border-blue-200 text-blue-700 px-6 py-5 rounded-2xl flex items-start gap-4">
            <div class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center shrink-0">
                <i class="fas fa-info-circle text-lg"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-1">Pengumuman Belum Tersedia</h4>
                <p class="text-sm opacity-90">Silahkan melakukan seleksi offline di sekolah atau menunggu pihak panitia menginput nilai seleksi Anda.</p>
            </div>
        </div>
    @else
        @foreach($data as $value)
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="bg-slate-50/50 border-b border-slate-100 px-6 py-4 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Detail Hasil Seleksi</h2>
                        <p class="text-xs text-slate-500">NIK: {{ $value->casis->nik ?? 'Tidak Ada Data' }}</p>
                    </div>
                </div>

                <div class="p-6 md:p-8">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8 pb-8 border-b border-slate-100">
                        <div class="space-y-4">
                            <h4 class="font-bold text-slate-700 border-b border-slate-100 pb-2">Data Calon Siswa</h4>
                            <div>
                                <p class="text-xs text-slate-500 mb-1">Nama Lengkap</p>
                                <p class="font-semibold text-slate-800">{{ $value->casis->nama ?? 'Tidak Ada Data' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 mb-1">Jenis Kelamin</p>
                                <p class="font-semibold text-slate-800">{{ $value->casis->jenis_kelamin ?? 'Tidak Ada Data' }}</p>
                            </div>
                            <div>
                                <p class="text-xs text-slate-500 mb-1">Tempat, Tanggal Lahir</p>
                                <p class="font-semibold text-slate-800">{{ $value->casis->tempat_lahir ?? 'Tidak Ada Data' }}, {{ \Carbon\Carbon::parse($value->casis->tanggal_lahir ?? 'Tidak Ada Data')->format('d-m-Y') }}</p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <h4 class="font-bold text-slate-700 border-b border-slate-100 pb-2">Rincian Nilai</h4>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <p class="text-xs text-slate-500 mb-1">Membaca</p>
                                    <p class="font-semibold text-slate-800">{{ $value->nilai_baca ?? '0' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 mb-1">Menulis</p>
                                    <p class="font-semibold text-slate-800">{{ $value->nilai_tulis ?? '0' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 mb-1">Menghitung</p>
                                    <p class="font-semibold text-slate-800">{{ $value->nilai_hitung ?? '0' }}</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-500 mb-1">Wawancara</p>
                                    <p class="font-semibold text-slate-800">{{ $value->nilai_wawancara ?? '0' }}</p>
                                </div>
                            </div>
                            <div class="pt-2">
                                <p class="text-xs text-slate-500 mb-1">Total Nilai</p>
                                <p class="font-bold text-blue-600 text-lg">{{ $value->total_nilai ?? '0' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="text-center mb-8">
                        <p class="text-sm font-semibold text-slate-500 mb-2">Nilai Rata-rata Akhir</p>
                        <div class="inline-block px-6 py-3 rounded-2xl font-bold text-3xl shadow-sm border border-slate-100 {{ $value->hasil_seleksi === 'Lolos' ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                            {{ $value->nilai_akhir ?? '0' }}
                        </div>
                    </div>

                    @if($value->hasil_seleksi === 'Lolos')
                        <div class="bg-green-100 border border-green-200 text-green-800 px-6 py-8 rounded-2xl text-center shadow-sm relative overflow-hidden mb-8">
                            <div class="absolute -right-6 -top-6 text-green-500/20 text-9xl">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-green-500 text-white rounded-full flex items-center justify-center text-3xl mx-auto mb-4 shadow-lg shadow-green-500/30">
                                    <i class="fas fa-check"></i>
                                </div>
                                <h3 class="text-2xl font-bold mb-2">Selamat, Anda dinyatakan Lulus Seleksi!</h3>
                                <p class="text-green-700 font-medium">Silakan melakukan daftar ulang melalui tautan di bawah ini.</p>
                            </div>
                        </div>
                    @else
                        <div class="bg-red-50 border border-red-200 text-red-800 px-6 py-6 rounded-2xl text-center shadow-sm relative overflow-hidden mb-8">
                            <div class="relative z-10">
                                <div class="w-16 h-16 bg-red-500 text-white rounded-full flex items-center justify-center text-3xl mx-auto mb-4 shadow-lg shadow-red-500/30">
                                    <i class="fas fa-times"></i>
                                </div>
                                <h3 class="text-xl font-bold mb-2">Mohon Maaf, Anda Dinyatakan Tidak Lulus</h3>
                                <p class="text-red-600">Tetap semangat dan terus belajar.</p>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        <a href="/unduh pengumuman/{{ $value->casis->id_casis }}" class="w-full sm:w-auto px-6 py-3 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold rounded-xl transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-download"></i> Unduh Hasil Seleksi
                        </a>

                        @if($value->hasil_seleksi === 'Lolos')
                            <a href="/daftar-ulang" class="w-full sm:w-auto px-8 py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg shadow-amber-500/30 hover:-translate-y-0.5">
                                <i class="fas fa-arrow-right"></i> Lanjutkan Daftar Ulang
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection