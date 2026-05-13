<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm text-left text-slate-600">

            {{-- Head --}}
            <thead class="text-xs text-slate-500 uppercase bg-slate-50 border-b border-slate-100">
                <tr>
                    <th class="px-6 py-4 font-semibold text-center">No</th>
                    <th class="px-6 py-4 font-semibold">Nama Lengkap</th>
                    <th class="px-6 py-4 font-semibold text-center">Baca</th>
                    <th class="px-6 py-4 font-semibold text-center">Tulis</th>
                    <th class="px-6 py-4 font-semibold text-center">Hitung</th>
                    <th class="px-6 py-4 font-semibold text-center">Wawancara</th>
                    <th class="px-6 py-4 font-semibold text-center">Total</th>
                    <th class="px-6 py-4 font-semibold text-center">Rata-Rata</th>
                    <th class="px-6 py-4 font-semibold text-center">Hasil</th>
                    <th class="px-6 py-4 font-semibold text-center">Aksi</th>
                </tr>
            </thead>

            {{-- Body --}}
            <tbody class="divide-y divide-slate-100">

                @forelse($data as $no => $value)

                <tr class="hover:bg-slate-50/50 transition-colors">

                    {{-- No --}}
                    <td class="px-6 py-4 text-center font-medium text-slate-800">
                        {{ $no + 1 }}
                    </td>

                    {{-- Nama --}}
                    <td class="px-6 py-4">
                        <div class="font-bold text-slate-800">
                            {{ $value->nama }}
                        </div>
                    </td>

                    {{-- Nilai --}}
                    <td class="px-6 py-4 text-center">
                        {{ $value->nilai_baca ?? '- - -' }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $value->nilai_tulis ?? '- - -' }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $value->nilai_hitung ?? '- - -' }}
                    </td>

                    <td class="px-6 py-4 text-center">
                        {{ $value->nilai_wawancara ?? '- - -' }}
                    </td>

                    {{-- Total --}}
                    <td class="px-6 py-4 text-center font-semibold text-slate-700">
                        {{ $value->total_nilai ?? '- - -' }}
                    </td>

                    {{-- Rata-rata --}}
                    <td class="px-6 py-4 text-center font-semibold text-slate-700">
                        {{ $value->nilai_akhir ?? '- - -' }}
                    </td>

                    {{-- Hasil --}}
                    <td class="px-6 py-4 text-center">

                        @if($value->hasil_seleksi === 'Lolos')

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                            <i class="fas fa-check-circle mr-1"></i>
                            LULUS
                        </span>

                        @elseif($value->hasil_seleksi === 'Tidak Lolos' && $value->nilai_akhir !== null)

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                            <i class="fas fa-times-circle mr-1"></i>
                            TIDAK LULUS
                        </span>

                        @else

                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600">
                            <i class="fas fa-hourglass-half mr-1"></i>
                            Menunggu Penilaian
                        </span>

                        @endif
                    </td>

                    {{-- Aksi --}}
                    <td class="px-6 py-4">

                        <div class="flex items-center justify-center gap-2">

                            {{-- Input/Edit --}}
                            <a href="{{ route('input', ['id' => $value->id_casis]) }}"
                                class="w-8 h-8 rounded-lg bg-blue-50 text-blue-600 flex items-center justify-center hover:bg-blue-600 hover:text-white transition-colors"
                                title="Input Nilai">

                                <i class="fas fa-plus text-xs"></i>
                            </a>

                            {{-- Delete --}}
                            <form action="{{ route('hapus', ['id' => $value->id_casis]) }}"
                                method="post"
                                class="inline-block"
                                onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="w-8 h-8 rounded-lg bg-red-50 text-red-600 flex items-center justify-center hover:bg-red-600 hover:text-white transition-colors"
                                    title="Hapus">

                                    <i class="fas fa-trash text-xs"></i>
                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="10" class="px-6 py-12 text-center">

                        <div class="flex flex-col items-center justify-center">

                            <div
                                class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300 mb-3">

                                <i class="fas fa-folder-open text-2xl"></i>
                            </div>

                            <p class="text-slate-500 font-medium">
                                Belum ada data nilai calon siswa.
                            </p>

                        </div>

                    </td>
                </tr>

                @endforelse

            </tbody>
        </table>
    </div>
</div>