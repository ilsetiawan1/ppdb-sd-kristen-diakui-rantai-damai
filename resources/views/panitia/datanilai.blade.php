@extends('layout.tampilanpanitia')

@section('page-title', 'Data Nilai Calon Siswa')

@section('content')
<div class="space-y-6">

    {{-- Alert --}}
    @include('components.panitia.alert')

    {{-- Header --}}
    <div
        class="bg-white rounded-2xl p-5 sm:p-6 border border-slate-100 shadow-sm flex flex-col md:flex-row md:items-center justify-between gap-4">

        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800 font-heading">
                Data Nilai Calon Siswa
            </h1>

            <p class="text-slate-500 text-sm mt-1">
                Kelola hasil tes seleksi calon siswa secara terintegrasi.
            </p>
        </div>

        {{-- Search --}}
        <form action="/panitia/form nilai" method="get" class="w-full md:w-auto">
            <div class="relative max-w-sm ml-auto">

                <input type="text"
                    name="search"
                    class="w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-green-500 focus:border-green-500 block pl-10 p-2.5"
                    placeholder="Cari Nama Calon Siswa..."
                    value="{{ request('search') }}">

                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <i class="fas fa-search text-slate-400"></i>
                </div>

            </div>
        </form>
    </div>

    {{-- Table --}}
    @include('components.panitia.table-nilai')

</div>
@endsection