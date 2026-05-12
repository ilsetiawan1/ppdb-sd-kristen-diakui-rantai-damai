@extends('layout.tampilan')

@section('page-title', 'Verifikasi Pembayaran')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    {{-- Page Header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Verifikasi Pembayaran</h1>
            <p class="text-slate-500 text-sm mt-1">Periksa bukti transfer dan perbarui status pembayaran pendaftar.</p>
        </div>
        
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="/admin/dashboard" class="hover:text-blue-600 font-medium transition-colors">Dashboard</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="/admin/pembayaran" class="hover:text-blue-600 font-medium transition-colors">Data Pembayaran</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-slate-800 font-medium">Verifikasi</span>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {{-- Preview Bukti Pembayaran --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex items-center justify-center">
                        <i class="fas fa-image text-sm"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Bukti Transfer</h3>
                </div>
                <div class="p-6">
                    @if($data->bukti_pembayaran)
                        @php
                        $file_name = $data->bukti_pembayaran;
                        $file_path = asset('storage/pembayaran/' . $file_name);
                        $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                        @endphp
                        
                        <div class="rounded-xl overflow-hidden bg-slate-100 border border-slate-200">
                            @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif', 'webp']))
                                <a href="{{ $file_path }}" target="_blank" title="Klik untuk memperbesar">
                                    <img src="{{ $file_path }}" alt="Bukti Pembayaran" class="w-full h-auto object-contain max-h-[400px] hover:opacity-90 transition-opacity">
                                </a>
                            @else
                                <div class="p-8 text-center">
                                    <i class="fas fa-file-pdf text-red-500 text-6xl mb-4"></i>
                                    <p class="text-sm font-medium text-slate-700 mb-4">{{ $file_name }}</p>
                                    <a href="{{ $file_path }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-2 bg-slate-800 text-white rounded-lg text-sm font-medium hover:bg-slate-700 transition-colors">
                                        <i class="fas fa-external-link-alt"></i> Buka Dokumen
                                    </a>
                                </div>
                            @endif
                        </div>
                        <p class="text-xs text-center text-slate-500 mt-3"><i class="fas fa-info-circle mr-1"></i> Klik gambar untuk melihat ukuran penuh</p>
                    @else
                        <div class="text-center py-12 px-4 bg-slate-50 rounded-xl border-2 border-dashed border-slate-200">
                            <div class="w-16 h-16 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mx-auto mb-3">
                                <i class="fas fa-image text-2xl"></i>
                            </div>
                            <h4 class="text-sm font-bold text-slate-700 mb-1">Belum Ada Bukti</h4>
                            <p class="text-xs text-slate-500">Calon siswa ini belum mengunggah bukti transfer pembayaran.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Form Verifikasi --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-3">
                    <div class="w-8 h-8 rounded-lg bg-green-100 text-green-600 flex items-center justify-center">
                        <i class="fas fa-clipboard-check text-sm"></i>
                    </div>
                    <h3 class="font-bold text-slate-800">Detail & Verifikasi</h3>
                </div>
                
                <form method="post" action="/admin/pembayaran/proses/{{ $data->id_pembayaran }}">
                    @csrf
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            {{-- NIK --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">NIK Casis</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 font-medium" value="{{ $data->casis->nik }}" readonly>
                            </div>
                            
                            {{-- Nama --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 font-medium" value="{{ $data->casis->nama }}" readonly>
                            </div>
                            
                            {{-- Nominal --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Nominal Tagihan</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-amber-600 font-bold" value="Rp {{ number_format($data->jumlah_pembayaran ?? 100000, 0, ',', '.') }}" readonly>
                            </div>
                            
                            {{-- Tanggal Submit --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Pembayaran</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 font-medium" value="{{ \Carbon\Carbon::parse($data->tgl_pembayaran)->format('d F Y') }}" readonly>
                            </div>

                            {{-- Status Pembayaran --}}
                            <div class="md:col-span-2 pt-4 border-t border-slate-100">
                                <label class="block text-sm font-semibold text-slate-700 mb-3">Status Verifikasi <span class="text-red-500">*</span></label>
                                <div class="flex flex-col sm:flex-row gap-4">
                                    <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer transition-all hover:bg-slate-50 {{ $data->status_pembayaran === 'Lunas' ? 'border-green-500 bg-green-50/50 ring-1 ring-green-500' : 'border-slate-200' }}">
                                        <input type="radio" name="status_pembayaran" value="Lunas" class="w-5 h-5 text-green-600 border-slate-300 focus:ring-green-500" {{ $data->status_pembayaran === 'Lunas' ? 'checked' : '' }} required>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800 flex items-center gap-2"><i class="fas fa-check-circle text-green-500"></i> Lunas</span>
                                            <span class="text-xs text-slate-500">Pembayaran sah dan dikonfirmasi</span>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center gap-3 p-4 border rounded-xl cursor-pointer transition-all hover:bg-slate-50 {{ $data->status_pembayaran === 'Belum Lunas' ? 'border-amber-500 bg-amber-50/50 ring-1 ring-amber-500' : 'border-slate-200' }}">
                                        <input type="radio" name="status_pembayaran" value="Belum Lunas" class="w-5 h-5 text-amber-600 border-slate-300 focus:ring-amber-500" {{ $data->status_pembayaran === 'Belum Lunas' ? 'checked' : '' }} required>
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-800 flex items-center gap-2"><i class="fas fa-clock text-amber-500"></i> Pending</span>
                                            <span class="text-xs text-slate-500">Menunggu verifikasi admin</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Form Actions --}}
                    <div class="p-6 bg-slate-50 border-t border-slate-100 flex items-center justify-end gap-3">
                        <a href="/admin/pembayaran" class="px-5 py-2.5 text-sm font-medium text-slate-600 bg-white border border-slate-300 rounded-xl hover:bg-slate-50 hover:text-slate-800 transition-colors">
                            Batal
                        </a>
                        <button type="submit" class="px-5 py-2.5 text-sm font-bold text-white bg-blue-600 rounded-xl hover:bg-blue-700 shadow-lg shadow-blue-600/30 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                            <i class="fas fa-save"></i> Simpan Verifikasi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
