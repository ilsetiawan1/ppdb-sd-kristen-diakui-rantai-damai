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
            padding: 20px 0;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            max-width: 600px;
            width: 100%;
            page-break-after: avoid;
        }
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
        }
        .kop-surat img {
            max-width: 100px;
            margin-bottom: 10px;
        }
        .kop-surat h1, .kop-surat p {
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
        .data-item {
            margin: 15px 0;
            font-size: 18px;
            display: flex;
            align-items: center;
        }
        .data-label {
            font-weight: bold;
            color:#333;
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
    </style>
</head>
<body>
    <div class="container">
        <div class="kop-surat">
            <img src="{{asset('images/logo-sd-kristen-diakui-rantai-damai.png')}}" alt="Logo Sekolah" />
            <h1>SD ISLAM TERPADU HIDAYAH KLATEN</h1>
            <p style="font-size: small;">Jl. Singosari, Jetis, Belang Wetan, Kec. Klaten Utara, Kab. Klaten, Jawa Tengah, 57438</p>
            <div class="line"></div>
        </div>
        <h2>Data Pendaftaran Calon Siswa</h2>
        <div class="data-item">
            <span class="data-label">NIK</span>
            <span class="data-value">1234567890123456</span>
        </div>
        <div class="data-item">
            <span class="data-label">Nama</span>
            <span class="data-value">John Doe</span>
        </div>
        <div class="data-item">
            <span class="data-label">Tempat, Tgl Lahir</span>
            <span class="data-value">Jakarta, 01 Januari 2000</span>
        </div>
        <div class="data-item">
            <span class="data-label">Jenis Kelamin</span>
            <span class="data-value">Laki-laki</span>
        </div>
        <div class="data-item">
            <span class="data-label">Jumlah Saudara</span>
            <span class="data-value">2</span>
        </div>
        <div class="data-item">
            <span class="data-label">Nama Orang Tua</span>
            <span class="data-value">Jane Doe & John Smith</span>
        </div>
        <div class="data-item">
            <span class="data-label">Tempat, Tanggal Lahir</span>
            <span class="data-value">Jakarta, 10 Maret 1975/span>
        </div>
        <div class="data-item">
            <span class="data-label">Pendidikan Orang Tua</span>
            <span class="data-value">S1 & S2</span>
        </div>
        <div class="data-item">
            <span class="data-label">Pekerjaan Orang Tua</span>
            <span class="data-value">Dokter & Pengacara</span>
        </div>
        <div class="data-item">
            <span class="data-label">Gaji Orang Tua</span>
            <span class="data-value">Rp 10.000.000 & Rp 15.000.000</span>
        </div>
        <div class="data-item">
            <span class="data-label">Alamat</span>
            <span class="data-value">Jl. Merdeka No. 123, Jakarta</span>
        </div>
        <div class="data-item">
            <span class="data-label">No Telepon</span>
            <span class="data-value">08123456789</span>
        </div>
    </div>
</body>
</html>
