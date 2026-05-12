<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-6 hover:shadow-md transition-shadow">
    <div class="bg-linear-to-r from-green-600 to-green-500 px-6 py-4 flex items-center gap-3">
        <i class="fas fa-bullhorn text-white text-lg"></i>
        <h3 class="font-bold text-white font-heading text-lg">Pengumuman PPDB</h3>
    </div>
    <div class="p-6">
        <div class="mb-6 pb-6 border-b border-slate-100">
            <h4 class="text-xl font-bold text-slate-800 font-heading mb-1">Selamat Datang, <span class="text-green-600">{{ Auth::user()->name }}</span>!</h4>
            <p class="text-slate-500 text-sm">Berikut adalah detail informasi periode pendaftaran Anda.</p>
        </div>
        
        <div class="space-y-4 mb-6">
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Tahun Ajaran</p>
                    <p class="font-bold text-slate-800">{{ $tahunajar->tahun_ajar }}</p>
                </div>
            </div>
            
            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-hourglass-start"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Pendaftaran Dimulai</p>
                    <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($tahunajar->mulai_pendaftaran)->format('d-m-Y') }}</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-hourglass-end"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Pendaftaran Berakhir</p>
                    <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($tahunajar->batas_pendaftaran)->format('d-m-Y') }}</p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Tanggal Seleksi Observasi</p>
                    <p class="font-bold text-slate-800">{{ \Carbon\Carbon::parse($tahunajar->tgl_seleksi)->format('d-m-Y') }} <span class="text-xs font-normal text-slate-500">(08:00 - 10:00 WITA)</span></p>
                </div>
            </div>

            <div class="flex items-start gap-4">
                <div class="w-10 h-10 rounded-xl bg-green-50 text-green-600 flex items-center justify-center shrink-0">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <p class="text-sm text-slate-500 font-medium">Status PPDB</p>
                    <span class="inline-block mt-1 px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full">{{ $tahunajar->status }}</span>
                </div>
            </div>
        </div>

        <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3">
            <i class="fas fa-info-circle text-blue-500 mt-0.5"></i>
            <p class="text-sm text-blue-800">Hasil Seleksi dapat diunduh pada menu <strong>Pengumuman</strong> setelah Anda menyelesaikan semua TAHAP pendaftaran dan seleksi.</p>
        </div>
    </div>
</div>
