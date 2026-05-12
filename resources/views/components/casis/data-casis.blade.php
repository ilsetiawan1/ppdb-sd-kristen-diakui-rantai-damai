<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden h-full hover:shadow-md transition-shadow">
    <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center justify-between">
        <h3 class="font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-child text-blue-500"></i> Data Calon Siswa
        </h3>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full hidden sm:inline-block">Biodata</span>
            <a href="{{ route('daftarcasis') }}" class="w-8 h-8 flex items-center justify-center rounded-full text-blue-600 hover:bg-blue-100 transition-colors bg-white shadow-sm border border-slate-200" title="{{ isset($user->casis->nik) ? 'Edit Biodata' : 'Isi Biodata' }}">
                <i class="fas {{ isset($user->casis->nik) ? 'fa-pen' : 'fa-plus' }} text-sm"></i>
            </a>
        </div>
    </div>
    <div class="p-6">
        <dl class="space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">NIK</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->nik ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Nama Lengkap</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->nama ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Tempat Lahir</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->tempat_lahir ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Tanggal Lahir</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">
                    {{ ($user->casis && $user->casis->tanggal_lahir) ? \Carbon\Carbon::parse($user->casis->tanggal_lahir)->format('d F Y') : '-' }}
                </dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Jenis Kelamin</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->jenis_kelamin ?? '-' }}</dd>
            </div>
            <div class="flex flex-col sm:flex-row sm:items-center py-2 border-b border-slate-50 last:border-0">
                <dt class="sm:w-1/3 text-sm font-medium text-slate-500">Anak Ke / Jml Saudara</dt>
                <dd class="sm:w-2/3 mt-1 sm:mt-0 font-semibold text-slate-800">{{ $user->casis?->jml_saudara ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>
