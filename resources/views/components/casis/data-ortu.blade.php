<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-full hover:shadow-md transition-shadow">
    <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center justify-between">
        <h3 class="font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-user-friends text-amber-500"></i> Data Orang Tua/Wali
        </h3>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-amber-100 text-amber-700 text-xs font-bold rounded-full hidden sm:inline-block">Keluarga</span>
            <a href="{{ route('daftarcasis') }}" class="w-8 h-8 flex items-center justify-center rounded-full text-amber-600 hover:bg-amber-100 transition-colors bg-white shadow-sm border border-slate-200" title="{{ isset($user->casis->nama_ortu) ? 'Edit Data Orang Tua' : 'Isi Data Orang Tua' }}">
                <i class="fas {{ isset($user->casis->nama_ortu) ? 'fa-pen' : 'fa-plus' }} text-sm"></i>
            </a>
        </div>
    </div>
    <div class="p-6">
        <dl class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Nama Orang Tua</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->nama_ortu ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Pendidikan Terakhir</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->pendidikan_ortu ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">TTL</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">
                    {{ $user->casis?->tempat_lahir_ortu ?? '-' }}, 
                    {{ ($user->casis && $user->casis->tanggal_lahir_ortu) ? \Carbon\Carbon::parse($user->casis->tanggal_lahir_ortu)->format('d F Y') : '-' }}
                </dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Pekerjaan</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->pekerjaan_ortu ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Penghasilan</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->gaji_ortu ? 'Rp ' . number_format($user->casis->gaji_ortu, 0, ',', '.') : '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">No. HP/WhatsApp</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->no_hp ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Alamat Lengkap</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->alamat ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>
