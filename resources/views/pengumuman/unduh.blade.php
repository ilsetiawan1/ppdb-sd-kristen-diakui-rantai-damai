<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Siswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            margin: 0 auto;
            padding: 20px;
            width: 80%;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1,
        .header h2 {
            margin: 0;
        }

        .content {
            margin: 10px 0;
        }

        .content p {
            margin-top: -10px;
        }

        .content table {
            width: 100%;
            margin: 20px 0;
            border-collapse: collapse;
        }

        .content table th,
        .content table td {
            padding: 8px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .content .announcement {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .announcement.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .announcement.danger {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .footer {
            margin-top: 10px;
        }

        .signature {
            text-align: right;
            margin-top: 20px;
        }

        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }

        .kop-surat img {
            max-width: 100px;
            margin-bottom: 10px;
        }

        .kop-surat h1,
        .kop-surat p {
            color: #333;
            font-size: 18px;
            margin: 5px 0;
        }

        .kop-surat .jalan {
            color: #555;
            font-size: 14px;
            margin: 5px 0;
        }

        .kop-surat .line {
            border-top: 2px solid #333;
            margin: 10px 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 22px;
        }

        h3 {
            margin-bottom: 0;
        }

        .data-item {
            margin: 15px 0;
            font-size: 18px;
            display: flex;
            align-items: center;
        }

        .data-label {
            font-weight: bold;
            color: #333;
            min-width: 200px;
            position: relative;
            padding-right: 10px;
        }

        .data-label::after {
            content: ":";
            position: absolute;
            right: 0;
        }

        .data-value {
            flex: 1;
            padding-left: 10px;
            background-color: #e9f5ff;
            border-radius: 5px;
            padding: 5px 10px;
        }

        .note {
            text-align: left;
            font-weight: bold;
            margin-top: 10px;
            font-size: small;
        }

        .note ul {
            list-style-type: none;
            padding: 0;
        }

        .note li {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="kop-surat">
            <h1>SD KRISTEN DIAKUI RANTAI DAMAI</h1>
            <p style="font-size: small;">Jl. Andi Pangeran, Desa Rantai Damai, Kec. Walenrang Timur, Kabupaten Luwu</p>
            <div class="line"></div>
            <h3>SURAT KETERANGAN</h3>
        </div>
        <div class="content">
            <p>Berdasarkan kegiatan tes/seleksi yang diselenggarakan panitia penerima siswa baru tahun pelajaran <b>{{ $aktivTahunAjaran->tahun_ajar ?? date('Y') }}</b>, maka sebagai tindak lanjut dari hasil tes tersebut kami menetapkan bahwa siswa berikut ini:</p>
            <table>
                <tr>
                    <th style="width: 350px;">NIK</th>
                    <td>: {{ $data->nik ?? 'Tidak Ada Data' }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>: {{ $data->nama ?? 'Tidak Ada Data' }}</td>
                </tr>
                <tr>
                    <th>Tempat, Tanggal Lahir</th>
                    <td>: {{ $data->tempat_lahir ?? 'Tidak Ada Data' }}, {{ \Carbon\Carbon::parse($data->tanggal_lahir ?? 'Tidak Ada Data')->format('d-m-Y') }}</td>
                </tr>
                <tr>
                    <th>Jenis Kelamin</th>
                    <td>: {{ $data->jenis_kelamin ?? 'Tidak Ada Data' }}</td>
                </tr>
                <tr>
                    <th>Nilai Akhir</th>
                    <td>: {{ $data->nilai_akhir ?? 'Tidak Ada Data' }}</td>
                </tr>
            </table>
            <div class="announcement {{ $data->hasil_seleksi === 'Lolos' ? 'success' : 'danger' }}">
                @if($data->hasil_seleksi === 'Lolos')
                Dinyatakan Lulus Seleksi dan Diterima sebagai Siswa Baru
                @else
                Belum Lulus Seleksi
                @endif
            </div>

            <p>Demikian pengumuman ini dibuat untuk dapat dipergunakan sebagaimana mestinya.</p>
        </div>
        <div class="footer">
            <div class="signature">
                <p>Klaten, {{ date('d M Y') }}</p>
                <p>Kepala Sekolah,</p>
                <br>
                <p><strong>Serni, S.Pd.K</strong></p>
            </div>
        </div>
        @if($data->hasil_seleksi === 'Lolos')
            <div class="note">
                <p>Catatan:</p>
                <ul>
                    <li>1. Daftar ulang dilaksanakan pada tanggal {{ $aktivTahunAjaran ? \Carbon\Carbon::parse($aktivTahunAjaran->tgl_seleksi)->format('d F Y') : '-' }} s.d {{ $aktivTahunAjaran ? \Carbon\Carbon::parse($aktivTahunAjaran->batas_pendaftaran)->addDays(7)->format('d F Y') : '-' }}.</li>
                    <li>2. Apabila pada tanggal tersebut tidak melakukan daftar ulang, maka yang bersangkutan dianggap mengundurkan diri.</li>
                </ul>
            </div>
        @endif
    </div>
</body>

</html>
