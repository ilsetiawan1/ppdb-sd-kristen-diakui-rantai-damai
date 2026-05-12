<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-6 hover:shadow-md transition-shadow h-full">
    <div class="bg-linear-to-r from-blue-600 to-blue-500 px-6 py-4 flex items-center gap-3">
        <i class="fas fa-route text-white text-lg"></i>
        <h3 class="font-bold text-white font-heading text-lg">Alur Pendaftaran Online</h3>
    </div>
    <div class="p-6 sm:p-8">
        <div class="relative border-l-2 border-blue-100 ml-3 space-y-8 pb-4">
            
            {{-- Step 1 --}}
            <div class="relative pl-8">
                <div class="absolute left-[-17px] w-8 h-8 rounded-full bg-blue-500 text-white flex items-center justify-center font-bold shadow-md ring-4 ring-white">1</div>
                <h5 class="font-bold text-slate-800 text-lg mb-1">Registrasi Akun</h5>
                <p class="text-slate-600 text-sm">Registrasi akun pada website berhasil dilakukan.</p>
            </div>
            
            {{-- Step 2 --}}
            <div class="relative pl-8">
                <div class="absolute left-[-17px] w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold shadow-sm ring-4 ring-white">2</div>
                <h5 class="font-bold text-slate-800 text-lg mb-1">Isi Formulir & Dokumen</h5>
                <p class="text-slate-600 text-sm">Lengkapi data diri calon siswa dan unggah dokumen persyaratan (Akta Kelahiran, KK, Foto).</p>
            </div>

            {{-- Step 3 --}}
            <div class="relative pl-8">
                <div class="absolute left-[-17px] w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold shadow-sm ring-4 ring-white">3</div>
                <h5 class="font-bold text-slate-800 text-lg mb-1">Pembayaran Pendaftaran</h5>
                <p class="text-slate-600 text-sm">Lakukan pembayaran biaya pendaftaran dan unggah bukti transfer.</p>
            </div>

            {{-- Step 4 --}}
            <div class="relative pl-8">
                <div class="absolute left-[-17px] w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold shadow-sm ring-4 ring-white">4</div>
                <h5 class="font-bold text-slate-800 text-lg mb-1">Seleksi Observasi</h5>
                <p class="text-slate-600 text-sm">Ikuti ujian seleksi secara Offline di sekolah sesuai jadwal yang ditentukan.</p>
            </div>

            {{-- Step 5 --}}
            <div class="relative pl-8">
                <div class="absolute left-[-17px] w-8 h-8 rounded-full bg-slate-200 text-slate-500 flex items-center justify-center font-bold shadow-sm ring-4 ring-white">5</div>
                <h5 class="font-bold text-slate-800 text-lg mb-1">Pengumuman & Daftar Ulang</h5>
                <p class="text-slate-600 text-sm">Tunggu hasil seleksi. Jika lolos, segera lakukan daftar ulang.</p>
            </div>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('formcasis') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-blue-50 text-blue-700 hover:bg-blue-100 font-medium rounded-xl transition-colors">
                Lanjut ke Tahap 2 <i class="fas fa-arrow-right text-sm"></i>
            </a>
        </div>
    </div>
</div>
