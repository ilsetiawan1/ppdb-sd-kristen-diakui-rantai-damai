<!DOCTYPE html>
<html>

<head>
    <title>Laporan</title>
    <style>
        /* CSS untuk gaya cetak, Anda bisa menyesuaikan sesuai kebutuhan */
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: cornflowerblue;
            /* Mengubah latar belakang menjadi biru */
            color: white;
            /* Mengubah warna teks menjadi putih agar lebih terlihat */
        }

        /* CSS untuk mengatur posisi tengah tulisan h1 */
        .center {
            text-align: center;
        }

        /* CSS untuk teks judul */
        .title {
            font-size: 24px;
            /* Menghapus teks "bold" */
            font-weight: bold;
            margin-bottom: 5px;
        }

        .jalan {
            font-size: 14px;
            /* Menghapus teks "bold" */
            /* font-weight: bold; */
            margin-bottom: 5px;
        }

        /* CSS untuk garis panjang */
        .line {
            border: none;
            border-top: 2px solid black;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <!-- Tambahkan jeda di atas judul -->
    <br><br>
    <div class="center title">SD KRISTEN DIAKUI RANTAI DAMAI</div>
    <!-- Menghapus teks "bold" pada teks berikut -->
    <div class="center jalan">Jl. Singosari, Jetis, Belang Wetan, Kec. Klaten Utara, Kab. Klaten, Jawa Tengah, 57438</div>
    <!-- Tambahkan garis panjang -->
    <div class="center line"></div>

    <h3 style="text-align: center;">Laporan Data Pembayaran Calon Siswa</h3>
    <!-- Tambahkan jeda setelah garis panjang
        <br><br> -->

    <table class="table">
        <thead>
            <tr>
                <th class="text-center bg-info text-white">No</th>
                <th class="text-center bg-info text-white">Nik</th>
                <th class="text-center bg-info text-white">Nama Lengkap</th>
                <th class="text-center bg-info text-white">Nama Orang Tua</th>
                <th class="text-center bg-info text-white">Tanggal</th>
                <th class="text-center bg-info text-white">Nominal</th>
                <th class="text-center bg-info text-white">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $no => $value)
            <tr>
                <td class="text-center">{{ $no + 1 }}</td>
                <td class="text-center">{{ $value->casis->nik}}</td>
                <td class="text-center">{{ $value->casis->nama}}</td>
                <td class="text-center">{{ $value->casis->nama_ortu}}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($value->tgl_pembayaran)->format('d-m-Y') }}</td>
                <td class="text-center">Rp. {{ number_format($value->jumlah_pembayaran, 0, ',', '.') }}
                <td class="text-center"><b>{{ $value->status_pembayaran}}</b></td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <!-- Bagian tanda tangan -->
    <div class="signature-section" style="text-align: right;">
        <div class="signature">
            <div>Klaten, <?php echo date('d-m-Y'); ?></div>
            <div class="name">Yongki</div>
            <br><br><br><br>
            <div class="role">Petugas Administrasi</div>
        </div>
    </div>

</body>

</html>