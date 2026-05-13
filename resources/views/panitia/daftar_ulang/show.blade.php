@extends('layout.tampilan')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Detail Verifikasi Daftar Ulang</h1>
            <p class="text-slate-500 text-sm mt-1">Tinjau bukti pembayaran dan perbarui status daftar ulang calon siswa.</p>
        </div>
        <a href="{{ route('admin.daftar_ulang.index') }}" class="px-5 py-2 bg-white border border-slate-300 text-slate-700 font-semibold rounded-xl hover:bg-slate-50 transition-colors shadow-sm inline-flex items-center gap-2">
            <i class="fas fa-arrow-left text-sm"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        {{-- Kolom Kiri: Informasi Siswa & Update Status --}}
        <div class="lg:col-span-5 space-y-6">
            
            {{-- Kartu Info Siswa --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Informasi Siswa</h2>
                    </div>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-xs text-slate-500 mb-1">Nama Calon Siswa</p>
                        <p class="font-bold text-slate-800 text-lg">{{ $daftarUlang->pendaftaran->casis->nama }}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Tanggal Bayar</p>
                            <p class="font-semibold text-slate-800">{{ date('d/m/Y H:i', strtotime($daftarUlang->tgl_daftar_ulang)) }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Metode</p>
                            <p class="font-semibold text-slate-800">{{ $daftarUlang->metode_pembayaran }}</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 mb-1">Jumlah Pembayaran</p>
                        <p class="font-bold text-blue-600 text-xl">Rp {{ number_format($daftarUlang->jumlah_bayar, 0, ',', '.') }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-slate-500 mb-2">Status Saat Ini</p>
                        @if($daftarUlang->status_bayar == 'Berhasil')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-green-100 text-green-700"><i class="fas fa-check-circle mr-2"></i> Berhasil</span>
                        @elseif($daftarUlang->status_bayar == 'Menunggu Konfirmasi')
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-amber-100 text-amber-700"><i class="fas fa-clock mr-2"></i> Menunggu Konfirmasi</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1.5 rounded-full text-sm font-semibold bg-red-100 text-red-700"><i class="fas fa-times-circle mr-2"></i> Gagal</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Form Update Status --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center shrink-0">
                        <i class="fas fa-edit"></i>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">Verifikasi Pembayaran</h2>
                    </div>
                </div>
                
                <form action="{{ route('admin.daftar_ulang.update', $daftarUlang->id_daftar_ulang) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    
                    <div class="space-y-5">
                        <div>
                            <label for="status_bayar" class="block text-sm font-semibold text-slate-700 mb-2">Ubah Status</label>
                            <select name="status_bayar" id="status_bayar" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 font-medium focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all">
                                <option value="Menunggu Konfirmasi" {{ $daftarUlang->status_bayar == 'Menunggu Konfirmasi' ? 'selected' : '' }}>⏳ Menunggu Konfirmasi</option>
                                <option value="Berhasil" {{ $daftarUlang->status_bayar == 'Berhasil' ? 'selected' : '' }}>✅ Berhasil (Terverifikasi)</option>
                                <option value="Gagal" {{ $daftarUlang->status_bayar == 'Gagal' ? 'selected' : '' }}>❌ Gagal (Tolak)</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="keterangan" class="block text-sm font-semibold text-slate-700 mb-2">Catatan / Keterangan Tambahan</label>
                            <textarea name="keterangan" id="keterangan" rows="3" class="w-full bg-white border border-slate-200 rounded-xl px-4 py-3 text-slate-700 focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all placeholder-slate-400" placeholder="Opsional, masukkan alasan penolakan jika gagal...">{{ $daftarUlang->keterangan }}</textarea>
                        </div>
                    </div>
                    
                    <div class="mt-6 pt-6 border-t border-slate-100 flex gap-3">
                        <button type="submit" class="flex-1 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md shadow-blue-600/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Status
                        </button>
                    </div>
                </form>
            </div>

        </div>

        {{-- Kolom Kanan: Bukti Pembayaran --}}
        <div class="lg:col-span-7">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden h-full flex flex-col">
                <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-image"></i>
                        </div>
                        <h2 class="text-lg font-bold text-slate-800">Bukti Pembayaran</h2>
                    </div>
                    <a href="{{ asset('storage/' . $daftarUlang->bukti_pembayaran) }}" target="_blank" class="px-4 py-2 bg-white border border-slate-300 text-slate-700 text-sm font-semibold rounded-lg hover:bg-slate-50 transition-colors shadow-sm inline-flex items-center gap-2">
                        <i class="fas fa-external-link-alt text-xs"></i> Buka Penuh
                    </a>
                </div>
                <div class="p-6 flex-1 flex items-center justify-center bg-slate-100/50">
                    @if($daftarUlang->bukti_pembayaran)
                        <img src="{{ asset('storage/' . $daftarUlang->bukti_pembayaran) }}" alt="Bukti Pembayaran {{ $daftarUlang->pendaftaran->casis->nama }}" class="max-w-full max-h-[800px] object-contain rounded-xl shadow-sm border border-slate-200 bg-white">
                    @else
                        <div class="text-center text-slate-400">
                            <i class="fas fa-image text-4xl mb-3 opacity-50"></i>
                            <p>Tidak ada bukti pembayaran</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection