<!DOCTYPE html>
<html>

<head>
    <title>laporan</title>
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
            padding: 4px; /* Mengurangi padding untuk memberi lebih banyak ruang */
            text-align: center;
            word-wrap: break-word; /* Membuat teks membungkus jika terlalu panjang */
        }

        th {
            background-color: cornflowerblue;
            color: white;
        }

        /* Mengatur lebar kolom untuk NIK, Nama, Tanggal, dan Keterangan */
        th:nth-child(2),
        td:nth-child(2),
        th:nth-child(3),
        td:nth-child(3),
        th:nth-child(4),
        td:nth-child(4),
        th:nth-child(12),
        td:nth-child(12) {
            width: 12%;
        }

        /* Mengatur lebar kolom untuk kolom nilai agar lebih kecil */
        th:nth-child(5),
        td:nth-child(5),
        th:nth-child(6),
        td:nth-child(6),
        th:nth-child(7),
        td:nth-child(7),
        th:nth-child(8),
        td:nth-child(8),
        th:nth-child(9),
        td:nth-child(9),
        th:nth-child(10),
        td:nth-child(10),
        th:nth-child(11),
        td:nth-child(11) {
            width: 6%;
        }

        /* Mengatur lebar kolom untuk nomor urut */
        th:nth-child(1),
        td:nth-child(1) {
            width: 4%;
        }

        /* CSS untuk mengatur posisi tengah tulisan h1 */
        .center {
            text-align: center;
        }

        /* CSS untuk teks judul */
        .title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .jalan {
            font-size: 14px;
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
    <br><br>
    <div class="center title">SD KRISTEN DIAKUI RANTAI DAMAI</div>
    <div class="center jalan">Jl. Singosari, Jetis, Belang Wetan, Kec. Klaten Utara, Kab. Klaten, Jawa Tengah, 57438</div>
    <div class="center line"></div>

    <h3 style="text-align: center;">Laporan Hasil Seleksi Calon Siswa</h3>

    <table class="table" style="text-align: center;">
        <thead>
            <tr>
                <th class="bg-info text-white">No</th>
                <th class="bg-info text-white">Nik</th>
                <th class="bg-info text-white">Nama</th>
                <th class="bg-info text-white">Tanggal Seleksi</th>
                <th class="bg-info text-white">Baca</th>
                <th class="bg-info text-white">Tulis</th>
                <th class="bg-info text-white">Hitung</th>
                <th class="bg-info text-white">Ngaji</th>
                <th class="bg-info text-white">Wawancara</th>
                <th class="bg-info text-white">Total Nilai</th>
                <th class="bg-info text-white">Nilai Akhir</th>
                <th class="bg-info text-white">Ket</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $no => $value)
            <tr>
                <td>{{ $no+1 }}</td>
                <td>{{ $value->casis->nik}}</td>
                <td>{{ $value->casis->nama}}</td>
                <td>{{ \Carbon\Carbon::parse($value->tgl_seleksi)->format('d-m-Y') }}</td>
                <td>{{ $value->nilai_baca?? '0' }}</td>
                <td>{{ $value->nilai_tulis?? '0' }}</td>
                <td>{{ $value->nilai_hitung?? '0' }}</td>
                <td>{{ $value->nilai_ngaji?? '0' }}</td>
                <td>{{ $value->nilai_wawancara?? '0' }}</td>
                <td>{{ $value->total_nilai?? '0' }}</td>
                <td>{{ $value->nilai_akhir?? '0' }}</td>
                <td style="color: {{ $value->hasil_seleksi == 'Lolos' ? 'green' : 'red' }}">
                    <strong>{{ $value->hasil_seleksi == 'Lolos' ? 'LULUS' : 'TIDAK LULUS' }}</strong>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <br>
    <div class="signature-section" style="text-align: right;">
        <div class="signature">
            <div>Klaten, <?php echo date('d-m-Y'); ?></div>
            <div class="name">Yongki</div>
            <br><br><br><br>
            <div class="role">Petugas Seleksi</div>
        </div>
    </div>
</body>

</html>
