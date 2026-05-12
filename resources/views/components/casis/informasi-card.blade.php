<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-6 hover:shadow-md transition-shadow">
    <div class="bg-linear-to-r from-amber-500 to-amber-400 px-6 py-4 flex items-center gap-3">
        <i class="fas fa-info-circle text-white text-lg"></i>
        <h3 class="font-bold text-white font-heading text-lg">Informasi Penting</h3>
    </div>
    <div class="p-6">
        <div class="grid md:grid-cols-2 gap-8">
            {{-- Tata Cara Pembayaran --}}
            <div>
                <h5 class="flex items-center gap-2 font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                    <i class="fas fa-money-bill-wave text-green-500"></i> Tata Cara Pembayaran
                </h5>
                <p class="text-sm text-slate-600 mb-4">Pembayaran biaya pendaftaran PPDB dapat dilakukan melalui transfer bank ke rekening resmi sekolah berikut:</p>
                
                <div class="bg-slate-50 border border-slate-200 rounded-xl p-4 mb-4">
                    <div class="flex items-center justify-between mb-3">
                        <div class="flex items-center gap-2">
                            <i class="fas fa-university text-blue-600 text-lg"></i>
                            <span class="font-bold text-slate-800 text-lg">Bank BNI</span>
                        </div>
                    </div>
                    <div class="space-y-1">
                        <p class="text-xs text-slate-500 uppercase font-semibold tracking-wider">Nomor Rekening</p>
                        <p class="font-mono font-bold text-lg text-slate-800">1234 5678 90</p>
                    </div>
                    <div class="space-y-1 mt-3">
                        <p class="text-xs text-slate-500 uppercase font-semibold tracking-wider">Atas Nama</p>
                        <p class="font-bold text-slate-800">SD Kristen Diakui Rantai Damai</p>
                    </div>
                </div>

                <div class="bg-amber-50 border-l-4 border-amber-500 p-3 rounded-r-lg flex gap-3">
                    <i class="fas fa-exclamation-triangle text-amber-500 mt-0.5"></i>
                    <p class="text-sm text-amber-800">Setelah melakukan transfer, harap <strong>unggah bukti transfer</strong> (foto/screenshot) pada menu Pembayaran Pendaftaran.</p>
                </div>
            </div>

            {{-- Informasi Daftar Ulang --}}
            <div>
                <h5 class="flex items-center gap-2 font-bold text-slate-800 mb-4 pb-2 border-b border-slate-100">
                    <i class="fas fa-user-check text-blue-500"></i> Informasi Daftar Ulang
                </h5>
                
                <ul class="space-y-3 mb-5">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-check text-green-500 mt-1"></i>
                        <span class="text-sm text-slate-600">Daftar ulang hanya diwajibkan untuk calon siswa yang <strong>dinyatakan lulus seleksi</strong>.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-times text-red-500 mt-1"></i>
                        <span class="text-sm text-slate-600">Tidak melakukan daftar ulang pada waktu yang ditentukan dianggap mengundurkan diri.</span>
                    </li>
                    <li class="flex items-start gap-2">
                        <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                        <span class="text-sm text-slate-600">Biaya yang telah dibayarkan tidak dapat ditarik kembali dengan alasan apapun.</span>
                    </li>
                </ul>

                <h6 class="font-bold text-slate-800 mb-3 text-sm uppercase tracking-wider">Rincian Biaya Daftar Ulang:</h6>
                <div class="bg-slate-50 border border-slate-100 rounded-xl p-4 space-y-2 text-sm">
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                        <span class="text-slate-600">Biaya Pembangunan</span>
                        <span class="font-bold text-slate-800">Rp 6.000.000</span>
                    </div>
                    <div class="flex justify-between items-center pb-2 border-b border-slate-200">
                        <span class="text-slate-600">Buku Pelajaran</span>
                        <span class="font-bold text-slate-800">Rp 1.295.000</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-slate-600">Seragam</span>
                        <div class="text-right">
                            <span class="font-bold text-slate-800 block">Putra: Rp 705.000</span>
                            <span class="font-bold text-slate-800 block">Putri: Rp 830.000</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
