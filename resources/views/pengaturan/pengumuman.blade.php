@extends('layout.tampilan')

@section('content')
<div class="p-6 max-w-7xl mx-auto">
    <div class="mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Publikasi Pengumuman Seleksi</h1>
            <p class="text-slate-500 text-sm mt-1">Tinjau nilai calon siswa dan terbitkan status kelulusan mereka agar dapat dilihat di portal pendaftaran.</p>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
            <i class="fas fa-check-circle"></i>
            <p class="font-medium">{{ session('success') }}</p>
        </div>
    @endif
    
    @if(session('error'))
        <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl flex items-center gap-3 shadow-sm">
            <i class="fas fa-exclamation-circle"></i>
            <p class="font-medium">{{ session('error') }}</p>
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
        <form action="{{ route('pengumuman.updateStatusSeleksi') }}" method="POST">
            @csrf
            
            <div class="p-4 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                <div class="text-sm text-slate-600 font-medium">
                    <i class="fas fa-info-circle text-blue-500 mr-1"></i> Pilih siswa yang akan diumumkan statusnya
                </div>
                <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-xl transition-all shadow-sm flex items-center gap-2" onclick="return confirm('Apakah Anda yakin ingin mempublikasikan pengumuman untuk siswa yang dipilih?')">
                    <i class="fas fa-bullhorn"></i> Publikasikan Pengumuman
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-slate-100 border-b border-slate-200 text-slate-600">
                        <tr>
                            <th class="px-6 py-4 font-semibold text-center w-12">
                                <input type="checkbox" id="select-all" class="w-4 h-4 text-blue-600 bg-white border-slate-300 rounded focus:ring-blue-500 cursor-pointer">
                            </th>
                            <th class="px-6 py-4 font-semibold">No</th>
                            <th class="px-6 py-4 font-semibold">Nama Lengkap</th>
                            <th class="px-4 py-4 font-semibold text-center">Baca</th>
                            <th class="px-4 py-4 font-semibold text-center">Tulis</th>
                            <th class="px-4 py-4 font-semibold text-center">Hitung</th>
                            <th class="px-4 py-4 font-semibold text-center">Wawancara</th>
                            <th class="px-4 py-4 font-semibold text-center">Total</th>
                            <th class="px-4 py-4 font-semibold text-center">Rata-Rata</th>
                            <th class="px-6 py-4 font-semibold text-center">Hasil Seleksi</th>
                            <th class="px-6 py-4 font-semibold text-center">Status Publikasi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($data as $no => $value)
                        <tr class="hover:bg-slate-50/50 transition-colors {{ $value->status_seleksi == 'Berhasil' ? 'bg-blue-50/30' : '' }}">
                            <td class="px-6 py-4 text-center">
                                <input type="checkbox" name="seleksi_ids[]" value="{{ $value->id_seleksi }}" class="w-4 h-4 text-blue-600 bg-white border-slate-300 rounded focus:ring-blue-500 cursor-pointer" {{ $value->status_seleksi == 'Berhasil' ? 'checked' : '' }}>
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $no + 1 }}</td>
                            <td class="px-6 py-4 font-bold text-slate-800">{{ $value->nama }}</td>
                            <td class="px-4 py-4 text-center text-slate-600">{{ $value->nilai_baca ?? '-' }}</td>
                            <td class="px-4 py-4 text-center text-slate-600">{{ $value->nilai_tulis ?? '-' }}</td>
                            <td class="px-4 py-4 text-center text-slate-600">{{ $value->nilai_hitung ?? '-' }}</td>
                            <td class="px-4 py-4 text-center text-slate-600">{{ $value->nilai_wawancara ?? '-' }}</td>
                            <td class="px-4 py-4 text-center font-semibold text-slate-700">{{ $value->total_nilai ?? '-' }}</td>
                            <td class="px-4 py-4 text-center font-bold text-blue-600">{{ $value->nilai_akhir ?? '-' }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($value->hasil_seleksi == 'Lolos')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">LULUS</span>
                                @elseif($value->hasil_seleksi == 'Tidak Lolos')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700">TIDAK LULUS</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-slate-100 text-slate-500">BELUM DINILAI</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($value->status_seleksi == 'Berhasil')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700 border border-blue-200">
                                        <i class="fas fa-globe"></i> Dipublikasikan
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 border border-amber-200">
                                        <i class="fas fa-lock"></i> Draft (Pending)
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="11" class="px-6 py-12 text-center">
                                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-slate-100 text-slate-400 mb-3">
                                    <i class="fas fa-users-slash text-xl"></i>
                                </div>
                                <h3 class="text-slate-800 font-bold mb-1">Tidak ada data seleksi</h3>
                                <p class="text-slate-500 text-sm">Belum ada calon siswa yang masuk dalam proses seleksi tahun ajaran ini.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>
    </div>
</div>

<script>
document.getElementById('select-all').addEventListener('change', function() {
    var checkboxes = document.getElementsByName('seleksi_ids[]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
});
</script>
@endsection