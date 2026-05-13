@extends('layout.tampilancasis')

@section('page-title', 'Daftar Ulang Calon Siswa')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">

    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Daftar Ulang Calon Siswa</h1>
            <p class="text-slate-500 text-sm mt-1">Lengkapi administrasi daftar ulang Anda untuk menjadi bagian dari SD Kristen Diakui Rantai Damai.</p>
        </div>
    </div>

    @include('layout.alert')

    @if(isset($error))
        <div class="bg-red-50 border border-red-200 text-red-700 px-6 py-5 rounded-2xl flex items-start gap-4 shadow-sm">
            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                <i class="fas fa-exclamation-triangle text-lg"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-1">Perhatian!</h4>
                <p class="text-sm opacity-90">{{ $error }}</p>
                <hr class="my-3 border-red-200">
                <p class="text-sm">Jika Anda memiliki pertanyaan, silakan hubungi panitia penerimaan siswa baru.</p>
            </div>
        </div>
    @elseif(!$seleksi || $seleksi->status != 'Berhasil' || $seleksi->hasil_seleksi != 'Lolos')
        <div class="bg-amber-50 border border-amber-200 text-amber-700 px-6 py-5 rounded-2xl flex items-start gap-4 shadow-sm">
            <div class="w-10 h-10 rounded-full bg-amber-100 flex items-center justify-center shrink-0">
                <i class="fas fa-exclamation-triangle text-lg"></i>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-1">Pendaftaran Anda Belum Selesai!</h4>
                <p class="text-sm opacity-90">Maaf, Anda belum dapat melakukan daftar ulang. Daftar ulang hanya bisa dilakukan setelah Anda dinyatakan lolos seleksi.</p>
                <hr class="my-3 border-amber-200">
                <p class="text-sm">Silakan tunggu hasil seleksi atau hubungi panitia untuk informasi lebih lanjut.</p>
            </div>
        </div>
    @elseif($daftarUlang)
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="bg-slate-50/50 border-b border-slate-100 px-6 py-4 flex items-center gap-3">
                <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-slate-800">Status Administrasi Daftar Ulang</h2>
                </div>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    <div class="space-y-4">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Metode Pembayaran</p>
                            <p class="font-semibold text-slate-800">{{ $daftarUlang->metode_pembayaran }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Jumlah Pembayaran</p>
                            <p class="font-bold text-lg text-blue-600">Rp {{ number_format($daftarUlang->jumlah_bayar, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Status Pembayaran</p>
                            @if($daftarUlang->status_bayar == 'Menunggu Konfirmasi')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 border border-amber-200">Menunggu Konfirmasi</span>
                            @elseif($daftarUlang->status_bayar == 'Berhasil')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">Berhasil</span>
                            @elseif($daftarUlang->status_bayar == 'Gagal')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">Gagal</span>
                            @endif
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Tanggal Konfirmasi</p>
                            <p class="font-semibold text-slate-800">{{ date('d/m/Y H:i', strtotime($daftarUlang->created_at)) }}</p>
                        </div>
                    </div>
                    
                    <div class="flex flex-col justify-center items-start gap-4 bg-slate-50 p-6 rounded-xl border border-slate-100">
                        @if($daftarUlang->status_bayar == 'Berhasil')
                            <a href="{{ route('calon_siswa.daftar_ulang.print') }}" class="w-full px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition-all shadow-md shadow-blue-600/20 hover:-translate-y-0.5 text-center flex items-center justify-center gap-2" target="_blank">
                                <i class="fas fa-print"></i> Cetak Bukti Pendaftaran
                            </a>
                        @endif
                        <a href="{{ asset('storage/'.$daftarUlang->bukti_pembayaran) }}" class="w-full px-6 py-3 bg-white border border-slate-300 hover:bg-slate-50 text-slate-700 font-semibold rounded-xl transition-all shadow-sm text-center flex items-center justify-center gap-2" target="_blank">
                            <i class="fas fa-eye"></i> Lihat File Bukti Upload
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <div class="lg:col-span-5 space-y-6">
                {{-- Rincian Biaya --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50/50 border-b border-slate-100 px-6 py-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-info-circle"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-800">Rincian Biaya</h2>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            @foreach($biayaComponents as $component)
                                <div class="flex justify-between items-center py-2 border-b border-slate-50">
                                    <span class="text-slate-600 font-medium flex items-center gap-2"><i class="fas fa-hand-holding-usd text-slate-400"></i> {{ $component->nama_biaya }}</span>
                                    <span class="font-semibold text-slate-800">Rp {{ number_format($component->nominal, 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                            <div class="flex justify-between items-center pt-4 pb-2">
                                <span class="text-slate-800 font-bold flex items-center gap-2"><i class="fas fa-calculator text-blue-600"></i> Total Biaya</span>
                                <span class="font-bold text-xl text-blue-600" id="totalBiayaDisplay">Rp {{ number_format($totalBiaya, 0, ',', '.') }}</span>
                                <span id="totalBiayaRaw" class="hidden">{{ $totalBiaya }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Informasi Transfer --}}
                <div class="bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl shadow-md text-white p-6 relative overflow-hidden">
                    <i class="fas fa-university absolute -right-4 -bottom-4 text-white/10 text-8xl"></i>
                    <h3 class="text-lg font-bold mb-4 relative z-10 flex items-center gap-2"><i class="fas fa-university"></i> Rekening Pembayaran</h3>
                    <div class="space-y-2 relative z-10">
                        <p class="text-blue-100 text-sm">Silakan transfer pembayaran ke rekening berikut:</p>
                        <div class="bg-white/10 backdrop-blur-md rounded-xl p-4 border border-white/20 mt-3">
                            <p class="font-bold text-lg mb-1">Bank BNI</p>
                            <p class="text-xl font-mono tracking-wider mb-1">1234 5678 90</p>
                            <p class="text-sm text-blue-100">A.N. SD Kristen Diakui Rantai Damai</p>
                        </div>
                    </div>
                </div>

                {{-- Ketentuan --}}
                <div class="bg-amber-50 rounded-2xl border border-amber-100 p-6">
                    <h3 class="text-amber-800 font-bold mb-3 flex items-center gap-2"><i class="fas fa-info-circle"></i> Ketentuan Daftar Ulang</h3>
                    <ul class="text-amber-700/80 text-sm space-y-2">
                        <li class="flex items-start gap-2"><i class="fas fa-check-circle mt-1 text-amber-500"></i> Pembayaran DP minimal 50% (untuk metode cicilan).</li>
                        <li class="flex items-start gap-2"><i class="fas fa-check-circle mt-1 text-amber-500"></i> Metode Cicilan: Pelunasan dilakukan maksimal 3 bulan.</li>
                        <li class="flex items-start gap-2"><i class="fas fa-check-circle mt-1 text-amber-500"></i> Pastikan foto/scan bukti pembayaran terlihat jelas.</li>
                    </ul>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="bg-slate-50/50 border-b border-slate-100 px-6 py-4 flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center shrink-0">
                            <i class="fas fa-money-check-alt"></i>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-slate-800">Form Konfirmasi Pembayaran</h2>
                        </div>
                    </div>
                    
                    <form method="post" action="{{ route('calon_siswa.daftar_ulang.store') }}" enctype="multipart/form-data" class="p-6 md:p-8 space-y-6">
                        @csrf
                        
                        {{-- Metode Pembayaran --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-3"><i class="fas fa-coins mr-1 text-amber-500"></i> Pilih Metode Pembayaran</label>
                            <div class="grid grid-cols-2 gap-4">
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="metode_pembayaran" value="DP 50%" class="peer sr-only" required>
                                    <div class="rounded-xl border border-slate-200 p-4 hover:bg-slate-50 transition-colors peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:ring-1 peer-checked:ring-blue-500 text-center">
                                        <div class="font-bold text-slate-800 peer-checked:text-blue-700 mb-1">Cicilan (DP 50%)</div>
                                    </div>
                                    <div class="absolute top-3 right-3 hidden peer-checked:block text-blue-600">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </label>
                                
                                <label class="cursor-pointer relative">
                                    <input type="radio" name="metode_pembayaran" value="Lunas" class="peer sr-only" required>
                                    <div class="rounded-xl border border-slate-200 p-4 hover:bg-slate-50 transition-colors peer-checked:border-blue-500 peer-checked:bg-blue-50 peer-checked:ring-1 peer-checked:ring-blue-500 text-center">
                                        <div class="font-bold text-slate-800 peer-checked:text-blue-700 mb-1">Lunas 100%</div>
                                    </div>
                                    <div class="absolute top-3 right-3 hidden peer-checked:block text-blue-600">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                </label>
                            </div>
                        </div>

                        {{-- Nominal Pembayaran --}}
                        <div>
                            <label for="jumlah_bayar" class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Pembayaran (Rp)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                    <span class="text-slate-500 font-medium">Rp</span>
                                </div>
                                <input type="text" name="jumlah_bayar" id="jumlah_bayar" 
                                    class="w-full bg-white border border-slate-200 rounded-xl pl-12 pr-4 py-3 text-slate-800 font-bold focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all @error('jumlah_bayar') border-red-500 focus:border-red-500 focus:ring-red-500/20 @enderror" 
                                    placeholder="0" required>
                            </div>
                            @error('jumlah_bayar')
                                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                            <p id="paymentError" class="mt-1 text-sm font-medium hidden"></p>
                        </div>

                        {{-- Bukti Upload --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">Unggah Bukti Pembayaran</label>
                            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-slate-200 border-dashed rounded-xl hover:border-blue-400 hover:bg-slate-50 transition-all cursor-pointer relative" id="upload-container">
                                <div class="space-y-2 text-center">
                                    <div class="mx-auto w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mb-3">
                                        <i class="fas fa-cloud-upload-alt text-xl"></i>
                                    </div>
                                    <div class="text-sm text-slate-600">
                                        <label for="bukti_pembayaran" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                            <span>Pilih file gambar</span>
                                            <input id="bukti_pembayaran" name="bukti_pembayaran" type="file" class="sr-only" accept="image/*" required>
                                        </label>
                                        <p class="pl-1">atau drag and drop di sini</p>
                                    </div>
                                    <p class="text-xs text-slate-500" id="file-name-display">PNG, JPG, JPEG maksimal 2MB</p>
                                </div>
                            </div>
                            @error('bukti_pembayaran')
                                <p class="mt-1 text-sm text-red-500 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="pt-4 border-t border-slate-100">
                            <button type="submit" class="w-full px-6 py-3.5 bg-blue-600 hover:bg-blue-700 text-white font-bold rounded-xl transition-all shadow-md shadow-blue-600/20 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                                <i class="fas fa-paper-plane"></i> Kirim Konfirmasi Pembayaran
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const jumlahBayar = document.getElementById('jumlah_bayar');
        if (jumlahBayar) {
            const totalBiayaRaw = document.getElementById('totalBiayaRaw');
            if (totalBiayaRaw) {
                const totalBiaya = parseInt(totalBiayaRaw.textContent);
                const paymentError = document.getElementById('paymentError');

                new Cleave('#jumlah_bayar', {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    numeralDecimalMark: ',',
                    delimiter: '.'
                });

                // Handle file upload display
                const fileInput = document.getElementById('bukti_pembayaran');
                const fileDisplay = document.getElementById('file-name-display');
                
                if(fileInput && fileDisplay) {
                    fileInput.addEventListener('change', function(e) {
                        if(e.target.files.length > 0) {
                            fileDisplay.textContent = 'File terpilih: ' + e.target.files[0].name;
                            fileDisplay.classList.add('text-blue-600', 'font-semibold');
                        }
                    });
                }

                $('input[name="metode_pembayaran"]').on('change', function() {
                    const method = $(this).val();
                    if (method === 'DP 50%') {
                        jumlahBayar.value = (totalBiaya * 0.5).toLocaleString('id-ID').replace(/,/g, '.');
                    } else if (method === 'Lunas') {
                        jumlahBayar.value = totalBiaya.toLocaleString('id-ID').replace(/,/g, '.');
                    }
                    updateValidation();
                });

                jumlahBayar.addEventListener('input', updateValidation);

                function updateValidation() {
                    const method = $('input[name="metode_pembayaran"]:checked').val();
                    const amount = parseInt(jumlahBayar.value.replace(/\D/g, ''));

                    paymentError.classList.remove('hidden', 'text-red-500', 'text-green-500');
                    
                    if (amount < totalBiaya * 0.5) {
                        paymentError.textContent = 'Pembayaran minimum adalah 50% dari total biaya';
                        paymentError.classList.add('text-red-500');
                    } else if (amount > totalBiaya) {
                        paymentError.textContent = 'Pembayaran tidak boleh melebihi total biaya';
                        paymentError.classList.add('text-red-500');
                    } else if (method === 'Lunas' && amount !== totalBiaya) {
                        paymentError.textContent = 'Pembayaran lunas harus sama dengan total biaya';
                        paymentError.classList.add('text-red-500');
                    } else if (amount === totalBiaya) {
                        paymentError.textContent = 'Pembayaran sesuai: Lunas';
                        paymentError.classList.add('text-green-500');
                    } else {
                        paymentError.textContent = 'Pembayaran sesuai: DP / Cicilan';
                        paymentError.classList.add('text-green-500');
                    }
                }
            }
        }
    });
</script>
@endpush
