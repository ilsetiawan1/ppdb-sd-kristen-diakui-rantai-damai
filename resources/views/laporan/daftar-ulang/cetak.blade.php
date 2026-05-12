<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Daftar Ulang Calon Siswa</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }
.period-text{
    font-size: 12px;
    color: #666;
}
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 15mm;
            background-color: white;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #333;
            padding-bottom: 10px;
        }

        .logo {
            width: 80px;
            height: auto;
            margin-bottom: 10px;
        }

        .school-name {
            font-size: 24px;
            font-weight: bold;
            color: #1a5f7a;
            margin: 0;
        }

        .school-address {
            font-size: 12px;
            color: #666;
            margin: 5px 0;
        }

        .document-title {
            font-size: 18px;
            font-weight: bold;
            margin: 20px 0;
            text-align: center;
            color: #1a5f7a;
            text-transform: uppercase;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #1a5f7a;
        }

        .footer {
            margin-top: 30px;
            text-align: right;
            font-size: 12px;
        }

        .signature-line {
            width: 200px;
            border-bottom: 1px solid #333;
            margin-left: auto;
            margin-top: 50px;
        }

        .status {
            display: inline-block;
            padding: 2px 5px;
            border-radius: 3px;
            font-size: 11px;
            font-weight: bold;
        }

        .status-success {
            background-color: #d4edda;
            color: #155724;
        }

        .status-pending {
            background-color: #fff3cd;
            color: #856404;
        }

        .status-failed {
            background-color: #f8d7da;
            color: #721c24;
        }

        .text-nowrap {
            white-space: nowrap;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="header">
        <img src="{{ asset('images/logo-sd-kristen-diakui-rantai-damai.png') }}" alt="Logo Sekolah" class="logo">

        <h1 class="school-name">SD ISLAM TERPADU HIDAYAH KLATEN</h1>
        <p class="school-address">Jl. Singosari, Jetis, Belang Wetan, Kec. Klaten Utara, Kab. Klaten, Jawa Tengah, 57438</p>
    </div>

    <h2 class="document-title">Laporan Daftar Ulang Calon Siswa</h2>
    <p class="period-text">{{ $periodText }}</p>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NIK</th>
                <th>Tanggal Daftar Ulang</th>
                <th>Metode Pembayaran</th>
                <th>Jumlah Bayar</th>
                <th>Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($daftarUlang as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->pendaftaran->casis->nama }}</td>
                <td>{{ $item->pendaftaran->casis->nik }}</td>
                <td>{{ date('d/m/Y', strtotime($item->tgl_daftar_ulang)) }}</td>
                <td>{{ $item->metode_pembayaran }}</td>
                <td class="text-nowrap">Rp {{ number_format($item->jumlah_bayar, 0, ',', '.') }}</td>
                <td>
                    <span class="status {{ $item->status_bayar == 'Berhasil' ? 'status-success' : ($item->status_bayar == 'Menunggu Konfirmasi' ? 'status-pending' : 'status-failed') }}">
                        {{ $item->status_bayar }}
                    </span>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;">Tidak ada data daftar ulang</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak pada: {{ date('d/m/Y H:i:s') }}</p>
        <p>Petugas: {{ Auth::user()->name }}</p>
        <div class="signature-line"></div>
        <p>Tanda Tangan Petugas</p>
    </div>
</body>

</html>
