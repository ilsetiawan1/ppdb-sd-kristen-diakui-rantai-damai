@extends('layout.tampilancasis')

@section('title', 'Isi / Edit Form Pendaftaran')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
    
    {{-- Page Header --}}
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold font-heading">Formulir Pendaftaran</h1>
            <p class="text-slate-500 text-sm mt-1">Mohon isi data diri dan orang tua dengan lengkap dan benar.</p>
        </div>
        
        <div class="flex items-center gap-2 text-sm text-slate-500">
            <a href="{{ route('formcasis') }}" class="hover:text-green-600 font-medium transition-colors">Data Pendaftaran</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-slate-800 font-medium">Formulir</span>
        </div>
    </div>

    {{-- Alerts --}}
    @if (session('success'))
    <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded-r-lg flex items-start gap-3">
        <i class="fas fa-check-circle text-green-500 mt-0.5"></i>
        <div>
            <h4 class="text-sm font-bold text-green-800">Berhasil!</h4>
            <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
        </div>
    </div>
    @endif
    
    @if (session('error'))
    <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded-r-lg flex items-start gap-3">
        <i class="fas fa-exclamation-circle text-red-500 mt-0.5"></i>
        <div>
            <h4 class="text-sm font-bold text-red-800">Terjadi Kesalahan!</h4>
            <p class="text-sm text-red-700 mt-1">{{ session('error') }}</p>
        </div>
    </div>
    @endif

    <form method="post" action="{{ route('prosescasis') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        {{-- Card: Data Akun --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-2">
                <i class="fas fa-shield-alt text-slate-400"></i>
                <h3 class="font-bold text-slate-800">Data Akun (Read-Only)</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Username</label>
                    <input type="text" class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed" value="{{ $user->name }}" readonly>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-2">Email Aktif</label>
                    <input type="email" class="w-full bg-slate-100 border border-slate-200 rounded-xl px-4 py-2.5 text-slate-500 cursor-not-allowed" value="{{ $user->email }}" readonly>
                </div>
            </div>
        </div>

        {{-- Card: Biodata Casis --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-2">
                <i class="fas fa-child text-blue-500"></i>
                <h3 class="font-bold text-slate-800">Biodata Calon Siswa</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div x-data="{ nikVal: '{{ old('nik', $user->casis ? $user->casis->nik : '') }}' }">
                    <div class="flex items-center justify-between mb-2">
                        <label for="nik" class="text-sm font-semibold text-slate-700">NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span></label>
                        @if(!($user->casis && $user->casis->nik))
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-orange-50 text-orange-600 border border-orange-200"><i class="fas fa-exclamation-circle mr-1"></i>Belum diisi</span>
                        @endif
                    </div>
                    <input type="text" name="nik" id="nik" x-model="nikVal"
                           value="{{ old('nik', $user->casis ? $user->casis->nik : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 transition-all @error('nik') border-red-400 @enderror" 
                           placeholder="Masukkan 16 digit NIK" oninput="validateNIK(this)" maxlength="16" required>
                    <div class="flex justify-between items-center mt-1">
                        <small id="nikError" class="text-red-500 font-medium"></small>
                        <span class="text-xs text-slate-400" x-text="nikVal.length + ' / 16'">0 / 16</span>
                    </div>
                    @error('nik') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="nama" class="text-sm font-semibold text-slate-700">Nama Lengkap Casis <span class="text-red-500">*</span></label>
                        @if(!($user->casis && $user->casis->nama))
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-orange-50 text-orange-600 border border-orange-200"><i class="fas fa-exclamation-circle mr-1"></i>Belum diisi</span>
                        @endif
                    </div>
                    <input type="text" name="nama" id="nama" value="{{ old('nama', $user->casis ? $user->casis->nama : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all" 
                           placeholder="Sesuai Akta Kelahiran" required>
                    @error('nama') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="tempat_lahir" class="text-sm font-semibold text-slate-700">Tempat Lahir <span class="text-red-500">*</span></label>
                        @if(!($user->casis && $user->casis->tempat_lahir))
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-orange-50 text-orange-600 border border-orange-200"><i class="fas fa-exclamation-circle mr-1"></i>Belum diisi</span>
                        @endif
                    </div>
                    <input type="text" name="tempat_lahir" id="tempat_lahir" value="{{ old('tempat_lahir', $user->casis ? $user->casis->tempat_lahir : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all" 
                           placeholder="Contoh: Klaten" required>
                    @error('tempat_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label for="tanggal_lahir" class="text-sm font-semibold text-slate-700">Tanggal Lahir <span class="text-red-500">*</span></label>
                        @if(!($user->casis && $user->casis->tanggal_lahir))
                            <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-orange-50 text-orange-600 border border-orange-200"><i class="fas fa-exclamation-circle mr-1"></i>Belum diisi</span>
                        @endif
                    </div>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" value="{{ old('tanggal_lahir', $user->casis ? $user->casis->tanggal_lahir : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all" required>
                    @error('tanggal_lahir') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jenis_kelamin" class="block text-sm font-semibold text-slate-700 mb-2">Jenis Kelamin <span class="text-red-500">*</span></label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all" required>
                        <option value="">Pilih Jenis Kelamin</option>
                        <option value="Laki-Laki" {{ old('jenis_kelamin', $user->casis ? $user->casis->jenis_kelamin : '') == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $user->casis ? $user->casis->jenis_kelamin : '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('jenis_kelamin') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="jml_saudara" class="block text-sm font-semibold text-slate-700 mb-2">Jumlah Saudara <span class="text-red-500">*</span></label>
                    <input type="number" name="jml_saudara" id="jml_saudara" value="{{ old('jml_saudara', $user->casis ? $user->casis->jml_saudara : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition-all" 
                           placeholder="Angka" required>
                    @error('jml_saudara') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Card: Data Orang Tua --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-2">
                <i class="fas fa-user-friends text-amber-500"></i>
                <h3 class="font-bold text-slate-800">Data Orang Tua / Wali</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="nama_ortu" class="block text-sm font-semibold text-slate-700 mb-2">Nama Lengkap Orang Tua <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_ortu" id="nama_ortu" value="{{ old('nama_ortu', $user->casis ? $user->casis->nama_ortu : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" 
                           placeholder="Nama Ayah/Ibu/Wali" required>
                    @error('nama_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="pendidikan_ortu" class="block text-sm font-semibold text-slate-700 mb-2">Pendidikan Terakhir <span class="text-red-500">*</span></label>
                    <select name="pendidikan_ortu" id="pendidikan_ortu" class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" required>
                        <option value="">Pilih Pendidikan</option>
                        <option value="Tidak Bersekolah" {{ old('pendidikan_ortu', $user->casis ? $user->casis->pendidikan_ortu : '') == 'Tidak Bersekolah' ? 'selected' : '' }}>Tidak Bersekolah</option>
                        <option value="SD" {{ old('pendidikan_ortu', $user->casis ? $user->casis->pendidikan_ortu : '') == 'SD' ? 'selected' : '' }}>SD</option>
                        <option value="SMP" {{ old('pendidikan_ortu', $user->casis ? $user->casis->pendidikan_ortu : '') == 'SMP' ? 'selected' : '' }}>SMP</option>
                        <option value="SMA" {{ old('pendidikan_ortu', $user->casis ? $user->casis->pendidikan_ortu : '') == 'SMA' ? 'selected' : '' }}>SMA</option>
                        <option value="S1" {{ old('pendidikan_ortu', $user->casis ? $user->casis->pendidikan_ortu : '') == 'S1' ? 'selected' : '' }}>S1</option>
                        <option value="S2" {{ old('pendidikan_ortu', $user->casis ? $user->casis->pendidikan_ortu : '') == 'S2' ? 'selected' : '' }}>S2</option>
                    </select>
                    @error('pendidikan_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tempat_lahir_ortu" class="block text-sm font-semibold text-slate-700 mb-2">Tempat Lahir Orang Tua <span class="text-red-500">*</span></label>
                    <input type="text" name="tempat_lahir_ortu" id="tempat_lahir_ortu" value="{{ old('tempat_lahir_ortu', $user->casis ? $user->casis->tempat_lahir_ortu : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" required>
                    @error('tempat_lahir_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="tanggal_lahir_ortu" class="block text-sm font-semibold text-slate-700 mb-2">Tanggal Lahir Orang Tua <span class="text-red-500">*</span></label>
                    <input type="date" name="tanggal_lahir_ortu" id="tanggal_lahir_ortu" value="{{ old('tanggal_lahir_ortu', $user->casis ? $user->casis->tanggal_lahir_ortu : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" required>
                    @error('tanggal_lahir_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="pekerjaan_ortu" class="block text-sm font-semibold text-slate-700 mb-2">Pekerjaan Saat Ini <span class="text-red-500">*</span></label>
                    <input type="text" name="pekerjaan_ortu" id="pekerjaan_ortu" value="{{ old('pekerjaan_ortu', $user->casis ? $user->casis->pekerjaan_ortu : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" required>
                    @error('pekerjaan_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="gaji_ortu" class="block text-sm font-semibold text-slate-700 mb-2">Penghasilan / Gaji per Bulan (Rp) <span class="text-red-500">*</span></label>
                    <input type="number" name="gaji_ortu" id="gaji_ortu" value="{{ old('gaji_ortu', $user->casis ? $user->casis->gaji_ortu : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" placeholder="Misal: 3000000" required>
                    @error('gaji_ortu') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-semibold text-slate-700 mb-2">Alamat Lengkap (Domisili) <span class="text-red-500">*</span></label>
                    <input type="text" name="alamat" id="alamat" value="{{ old('alamat', $user->casis ? $user->casis->alamat : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" 
                           placeholder="Jalan, RT/RW, Desa/Kelurahan, Kecamatan" required>
                    @error('alamat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label for="no_hp" class="block text-sm font-semibold text-slate-700 mb-2">No. HP / WhatsApp Aktif <span class="text-red-500">*</span></label>
                    <input type="text" name="no_hp" id="no_hp" value="{{ old('no_hp', $user->casis ? $user->casis->no_hp : '') }}" 
                           class="w-full bg-white border border-slate-300 rounded-xl px-4 py-2.5 text-slate-900 focus:bg-white focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500 transition-all" 
                           placeholder="Maksimal 12 digit" oninput="validateNoHP()" maxlength="12" required>
                    <small id="noHpError" class="text-red-500 mt-1 block font-medium"></small>
                    @error('no_hp') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- Card: Berkas Upload --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="border-b border-slate-100 px-6 py-4 bg-slate-50 flex items-center gap-2">
                <i class="fas fa-folder-open text-purple-500"></i>
                <h3 class="font-bold text-slate-800">Unggah Berkas Persyaratan</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                
                {{-- Akte --}}
                <div class="border border-slate-200 rounded-xl p-5 hover:border-purple-300 transition-colors bg-slate-50/50">
                    <label for="akte" class="block text-sm font-semibold text-slate-800 mb-2">Akte Kelahiran</label>
                    <p class="text-xs text-slate-500 mb-4">Format: JPG, PNG, PDF (Maks 2MB)</p>
                    <input type="file" name="akte" id="akte" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">
                    @error('akte') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    @if ($user->casis && $user->casis->pendaftaran && $user->casis->pendaftaran->akte)
                    <div class="mt-3 flex items-center gap-2 text-xs font-medium text-green-600 bg-green-50 p-2 rounded-lg">
                        <i class="fas fa-check-circle"></i> Berkas sudah diunggah
                    </div>
                    @endif
                </div>

                {{-- KK --}}
                <div class="border border-slate-200 rounded-xl p-5 hover:border-purple-300 transition-colors bg-slate-50/50">
                    <label for="kk" class="block text-sm font-semibold text-slate-800 mb-2">Kartu Keluarga (KK)</label>
                    <p class="text-xs text-slate-500 mb-4">Format: JPG, PNG, PDF (Maks 2MB)</p>
                    <input type="file" name="kk" id="kk" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">
                    @error('kk') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    @if ($user->casis && $user->casis->pendaftaran && $user->casis->pendaftaran->kk)
                    <div class="mt-3 flex items-center gap-2 text-xs font-medium text-green-600 bg-green-50 p-2 rounded-lg">
                        <i class="fas fa-check-circle"></i> Berkas sudah diunggah
                    </div>
                    @endif
                </div>

                {{-- Foto --}}
                <div class="border border-slate-200 rounded-xl p-5 hover:border-purple-300 transition-colors bg-slate-50/50">
                    <label for="foto" class="block text-sm font-semibold text-slate-800 mb-2">Pas Foto Casis</label>
                    <p class="text-xs text-slate-500 mb-4">Format: JPG, PNG, JPEG (Maks 2MB)</p>
                    <input type="file" name="foto" id="foto" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 cursor-pointer">
                    @error('foto') <p class="text-red-500 text-xs mt-2">{{ $message }}</p> @enderror
                    @if ($user->casis && $user->casis->pendaftaran && $user->casis->pendaftaran->foto)
                    <div class="mt-3 flex items-center gap-2 text-xs font-medium text-green-600 bg-green-50 p-2 rounded-lg">
                        <i class="fas fa-check-circle"></i> Berkas sudah diunggah
                    </div>
                    @endif
                </div>

            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end pt-4 pb-10">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl shadow-lg shadow-blue-600/30 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all flex items-center gap-2">
                <i class="fas fa-save"></i> Simpan Data Pendaftaran
            </button>
        </div>
    </form>
</div>

<script>
    function validateNIK(input) {
        input.value = input.value.replace(/\D/g, '');
        var nikError = document.getElementById('nikError');
        if (input.value.length !== 16) {
            nikError.textContent = 'NIK harus terdiri dari 16 digit angka.';
            input.setCustomValidity('NIK harus terdiri dari 16 digit.');
        } else {
            nikError.textContent = '';
            input.setCustomValidity('');
        }
    }

    function validateNoHP() {
        const noHpInput = document.getElementById('no_hp');
        const noHpError = document.getElementById('noHpError');
        const noHpValue = noHpInput.value.replace(/\D/g, '');
        noHpInput.value = noHpValue;
        if (noHpValue.length !== 12) {
            noHpError.textContent = 'No Telepon harus berupa 12 digit angka.';
            noHpInput.setCustomValidity('No Telepon harus berupa 12 digit angka');
        } else {
            noHpError.textContent = '';
            noHpInput.setCustomValidity('');
        }
    }

    document.querySelector('form').addEventListener('submit', function(event) {
        const nikEl = document.getElementById('nik');
        if (nikEl.value.length !== 16) { nikEl.setCustomValidity('NIK harus 16 digit.'); }
        validateNIK(nikEl);
        validateNoHP();
        if (!this.checkValidity()) {
            event.preventDefault();
            event.stopPropagation();
        }
        this.classList.add('was-validated');
    });
</script>
@endsection