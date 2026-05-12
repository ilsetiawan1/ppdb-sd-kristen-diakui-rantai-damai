@extends('layout.tampilan')

@section('page-title', 'Edit Calon Siswa')

@section('content')
<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center justify-between bg-white p-5 sm:p-6 rounded-2xl shadow-sm border border-slate-100 gap-4">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center text-xl shrink-0">
                <i class="fas fa-user-edit"></i>
            </div>
            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800 font-heading">Edit Data Pendaftar</h1>
                <p class="text-sm text-slate-500">Perbarui informasi atas nama <span class="font-semibold text-slate-700">{{ $casis->nama }}</span></p>
            </div>
        </div>
        <div class="flex items-center gap-3">
            <a href="/admin/data/casis" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 hover:bg-slate-200 rounded-lg text-sm font-medium transition-colors">
                <i class="fas fa-arrow-left"></i> <span class="hidden sm:inline">Kembali</span>
            </a>
            <button type="button" onclick="document.getElementById('edit-form').submit()" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-green-600 text-white hover:bg-green-700 rounded-lg text-sm font-medium transition-colors shadow-sm shadow-green-600/20">
                <i class="fas fa-save"></i> <span class="hidden sm:inline">Simpan Perubahan</span>
            </button>
        </div>
    </div>

    <form id="edit-form" method="POST" action="{{ route('updatedata', $casis->id_casis) }}" enctype="multipart/form-data" onsubmit="return validateForm()">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            {{-- Kolom Kiri: Form Data Pokok --}}
            <div class="lg:col-span-2 space-y-6">
                
                {{-- Data Calon Siswa --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-green-50 text-green-600 flex items-center justify-center">
                            <i class="fas fa-address-card"></i>
                        </div>
                        <h2 class="text-lg font-bold text-slate-800">Formulir Data Calon Siswa</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="nik" class="block text-sm font-semibold text-slate-700 mb-1">NIK (Nomor Induk Kependudukan) <span class="text-red-500">*</span></label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="nik" id="nik" value="{{ $casis->nik }}" required maxlength="10" oninput="validateNIK(this)">
                                <small id="nikError" class="text-red-500 text-xs mt-1 font-medium hidden">NIK harus terdiri dari persis 10 digit angka.</small>
                            </div>
                            <div>
                                <label for="nama" class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="nama" id="nama" value="{{ $casis->nama }}" required>
                            </div>
                            <div>
                                <label for="tempat_lahir" class="block text-sm font-semibold text-slate-700 mb-1">Tempat Lahir</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="tempat_lahir" id="tempat_lahir" value="{{ $casis->tempat_lahir }}">
                            </div>
                            <div>
                                <label for="tanggal_lahir" class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Lahir</label>
                                <input type="date" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="tanggal_lahir" id="tanggal_lahir" value="{{ $casis->tanggal_lahir }}">
                            </div>
                            <div>
                                <label for="jenis_kelamin" class="block text-sm font-semibold text-slate-700 mb-1">Jenis Kelamin <span class="text-red-500">*</span></label>
                                <select class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="jenis_kelamin" id="jenis_kelamin" required>
                                    <option value="">-- Pilih Jenis Kelamin --</option>
                                    <option value="Laki-Laki" {{ $casis->jenis_kelamin == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                                    <option value="Perempuan" {{ $casis->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            <div>
                                <label for="jml_saudara" class="block text-sm font-semibold text-slate-700 mb-1">Jumlah Saudara (Termasuk Casis)</label>
                                <input type="number" min="1" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="jml_saudara" id="jml_saudara" value="{{ $casis->jml_saudara }}">
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Data Orang Tua --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-amber-50 text-amber-600 flex items-center justify-center">
                            <i class="fas fa-users"></i>
                        </div>
                        <h2 class="text-lg font-bold text-slate-800">Formulir Orang Tua / Wali</h2>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_ortu" class="block text-sm font-semibold text-slate-700 mb-1">Nama Ayah / Ibu / Wali <span class="text-red-500">*</span></label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="nama_ortu" id="nama_ortu" value="{{ $casis->nama_ortu }}" required>
                            </div>
                            <div>
                                <label for="pendidikan_ortu" class="block text-sm font-semibold text-slate-700 mb-1">Pendidikan Terakhir Wali <span class="text-red-500">*</span></label>
                                <select class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="pendidikan_ortu" id="pendidikan_ortu" required>
                                    <option value="">-- Pilih Pendidikan --</option>
                                    <option value="Tidak Bersekolah" {{ $casis->pendidikan_ortu == 'Tidak Bersekolah' ? 'selected' : '' }}>Tidak Bersekolah</option>
                                    <option value="SD" {{ $casis->pendidikan_ortu == 'SD' ? 'selected' : '' }}>SD</option>
                                    <option value="SMP" {{ $casis->pendidikan_ortu == 'SMP' ? 'selected' : '' }}>SMP</option>
                                    <option value="SMA" {{ $casis->pendidikan_ortu == 'SMA' ? 'selected' : '' }}>SMA</option>
                                    <option value="S1" {{ $casis->pendidikan_ortu == 'S1' ? 'selected' : '' }}>S1</option>
                                    <option value="S2" {{ $casis->pendidikan_ortu == 'S2' ? 'selected' : '' }}>S2</option>
                                </select>
                            </div>
                            <div>
                                <label for="tempat_lahir_ortu" class="block text-sm font-semibold text-slate-700 mb-1">Tempat Lahir Wali</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="tempat_lahir_ortu" id="tempat_lahir_ortu" value="{{ $casis->tempat_lahir_ortu }}">
                            </div>
                            <div>
                                <label for="tanggal_lahir_ortu" class="block text-sm font-semibold text-slate-700 mb-1">Tanggal Lahir Wali</label>
                                <input type="date" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="tanggal_lahir_ortu" id="tanggal_lahir_ortu" value="{{ $casis->tanggal_lahir_ortu }}">
                            </div>
                            <div>
                                <label for="pekerjaan_ortu" class="block text-sm font-semibold text-slate-700 mb-1">Pekerjaan Wali</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="pekerjaan_ortu" id="pekerjaan_ortu" value="{{ $casis->pekerjaan_ortu }}">
                            </div>
                            <div>
                                <label for="gaji_ortu" class="block text-sm font-semibold text-slate-700 mb-1">Penghasilan / Gaji Wali</label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="gaji_ortu" id="gaji_ortu" value="{{ $casis->gaji_ortu }}">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="no_hp" class="block text-sm font-semibold text-slate-700 mb-1">Nomor Telepon / WhatsApp <span class="text-red-500">*</span></label>
                                <input type="text" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="no_hp" id="no_hp" value="{{ $casis->no_hp }}" required>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="alamat" class="block text-sm font-semibold text-slate-700 mb-1">Alamat Lengkap Domisili <span class="text-red-500">*</span></label>
                                <textarea rows="3" class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block p-2.5 transition-colors" name="alamat" id="alamat" required>{{ $casis->alamat }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Kolom Kanan: Upload Berkas --}}
            <div class="space-y-6">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden sticky top-24">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-purple-50 text-purple-600 flex items-center justify-center">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <h2 class="text-lg font-bold text-slate-800">Manajemen Berkas</h2>
                    </div>
                    <div class="p-6">
                        <div class="space-y-5">
                            
                            {{-- Akte --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Akte Kelahiran</label>
                                <div class="flex items-center gap-2 mb-2">
                                    <input type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition-colors" name="akte">
                                </div>
                                @if($casis->akte)
                                <div class="flex items-center gap-2 text-xs text-slate-500 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                                    <i class="fas fa-paperclip text-slate-400"></i> <span class="truncate">{{ $casis->akte }}</span>
                                </div>
                                @endif
                            </div>

                            <hr class="border-slate-100">

                            {{-- KK --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Kartu Keluarga (KK)</label>
                                <div class="flex items-center gap-2 mb-2">
                                    <input type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition-colors" name="kk">
                                </div>
                                @if($casis->kk)
                                <div class="flex items-center gap-2 text-xs text-slate-500 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                                    <i class="fas fa-paperclip text-slate-400"></i> <span class="truncate">{{ $casis->kk }}</span>
                                </div>
                                @endif
                            </div>

                            <hr class="border-slate-100">

                            {{-- Foto --}}
                            <div>
                                <label class="block text-sm font-semibold text-slate-700 mb-2">Pas Foto 3x4</label>
                                <div class="flex items-center gap-2 mb-2">
                                    <input type="file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-purple-50 file:text-purple-700 hover:file:bg-purple-100 transition-colors" name="foto" accept="image/*">
                                </div>
                                @if($casis->foto)
                                <div class="flex items-center gap-2 text-xs text-slate-500 bg-slate-50 px-3 py-2 rounded-lg border border-slate-100">
                                    <i class="fas fa-image text-slate-400"></i> <span class="truncate">{{ $casis->foto }}</span>
                                </div>
                                @endif
                            </div>

                        </div>
                        
                        <div class="mt-8">
                            <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 bg-green-600 text-white hover:bg-green-700 rounded-xl text-sm font-semibold transition-colors shadow-sm shadow-green-600/20">
                                <i class="fas fa-save"></i> Simpan Perubahan
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function validateNIK(input) {
        input.value = input.value.replace(/\D/g, ''); // Hanya angka

        const errorLabel = document.getElementById('nikError');
        if (input.value.length !== 10 && input.value.length > 0) {
            errorLabel.classList.remove('hidden');
            input.classList.add('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
        } else {
            errorLabel.classList.add('hidden');
            input.classList.remove('border-red-500', 'focus:border-red-500', 'focus:ring-red-500');
        }
    }

    function validateForm() {
        var nik = document.getElementById('nik');
        if (nik.value.length !== 10) {
            alert('NIK harus terdiri dari tepat 10 digit angka!');
            nik.focus();
            return false;
        }
        return true;
    }
</script>

@endsection