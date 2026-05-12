<div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-6 hover:shadow-md transition-shadow">
    <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center justify-between">
        <h3 class="font-bold text-slate-800 flex items-center gap-2">
            <i class="fas fa-folder-open text-purple-500"></i> Berkas Persyaratan
        </h3>
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-full hidden sm:inline-block">Dokumen</span>
            <a href="{{ route('daftarcasis') }}" class="w-8 h-8 flex items-center justify-center rounded-full text-purple-600 hover:bg-purple-100 transition-colors bg-white shadow-sm border border-slate-200" title="{{ (isset($user->casis->pendaftaran) && ($user->casis->pendaftaran->akte || $user->casis->pendaftaran->kk)) ? 'Edit Berkas' : 'Unggah Berkas' }}">
                <i class="fas {{ (isset($user->casis->pendaftaran) && ($user->casis->pendaftaran->akte || $user->casis->pendaftaran->kk)) ? 'fa-pen' : 'fa-plus' }} text-sm"></i>
            </a>
        </div>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
            @php
            $berkasList = [
                'akte' => ['label' => 'Akte Kelahiran', 'icon' => 'fa-file-signature', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                'kk' => ['label' => 'Kartu Keluarga', 'icon' => 'fa-users', 'color' => 'text-green-500', 'bg' => 'bg-green-50'],
                'foto' => ['label' => 'Pas Foto', 'icon' => 'fa-id-badge', 'color' => 'text-amber-500', 'bg' => 'bg-amber-50']
            ];
            @endphp

            @foreach($berkasList as $key => $data)
            <div class="border border-slate-100 rounded-xl p-4 flex flex-col items-center text-center hover:border-slate-300 transition-colors">
                <div class="w-12 h-12 rounded-full {{ $data['bg'] }} {{ $data['color'] }} flex items-center justify-center text-xl mb-3">
                    <i class="fas {{ $data['icon'] }}"></i>
                </div>
                <h6 class="font-bold text-slate-800 text-sm mb-2">{{ $data['label'] }}</h6>
                
                @if(isset($user->casis) && isset($user->casis->pendaftaran) && $user->casis->pendaftaran->$key)
                    @php
                    $file_name = $user->casis->pendaftaran->$key;
                    $file_path = asset('storage/berkas/' . $file_name);
                    $file_extension = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
                    @endphp
                    
                    <a href="{{ $file_path }}" target="_blank" class="group relative block w-full aspect-video bg-slate-100 rounded-lg overflow-hidden mb-2 border border-slate-200">
                        @if(in_array($file_extension, ['jpg', 'jpeg', 'png', 'gif']))
                            <img src="{{ $file_path }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300" alt="{{ $data['label'] }}">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-red-500">
                                <i class="fas fa-file-pdf text-3xl mb-1"></i>
                                <span class="text-xs font-bold">PDF</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-slate-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                            <span class="bg-white/90 text-slate-800 text-xs font-bold px-2 py-1 rounded backdrop-blur-sm"><i class="fas fa-eye mr-1"></i>Lihat</span>
                        </div>
                    </a>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-green-50 text-green-700 text-xs font-medium">
                        <i class="fas fa-check-circle"></i> Terunggah
                    </span>
                @else
                    <div class="w-full aspect-video bg-slate-50 border-2 border-dashed border-slate-200 rounded-lg mb-2 flex flex-col items-center justify-center text-slate-400">
                        <i class="fas fa-times-circle text-xl mb-1 opacity-50"></i>
                    </div>
                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md bg-red-50 text-red-700 text-xs font-medium">
                        <i class="fas fa-exclamation-circle"></i> Belum Ada
                    </span>
                @endif
            </div>
            @endforeach
        </div>
    </div>
</div>
