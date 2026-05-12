<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bukti Pembayaran dan Daftar Ulang</title>
    <style>
        @page {
            size: A4;
            margin: 0;
        }

        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            width: 210mm;
            min-height: 297mm;
            padding: 20mm;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        .content {
            margin-bottom: 30px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th,
        .info-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        .info-table th {
            width: 30%;
            text-align: left;
            background-color: #f8f8f8;
            font-weight: bold;
            color: #1a5f7a;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
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

        .announcement {
            background-color: #e7f3fe;
            border-left: 5px solid #2196F3;
            padding: 15px;
            margin: 20px 0;
            font-size: 16px;
            color: #0c5460;
        }

        .payment-info {
            background-color: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            color: #856404;
        }

        .footer {
            margin-top: 50px;
            text-align: right;
            font-size: 14px;
        }

        .signature-line {
            width: 200px;
            border-bottom: 1px solid #333;
            margin-left: auto;
            margin-top: 50px;
        }

        .notes {
            margin-top: 30px;
            font-size: 12px;
            color: #666;
        }

        .notes h4 {
            color: #1a5f7a;
        }

        .notes ul {
            padding-left: 20px;
        }

        @media print {
            body {
                background-color: white;
            }

            .container {
                box-shadow: none;
            }
        }
    </style>
</head>

<body onload="window.print()">
    <div class="container">
        <div class="header">
            <img src="{{ asset('images/logo-sd-kristen-diakui-rantai-damai.png') }}" alt="Logo Sekolah" class="logo">
            <h1 class="school-name">SD ISLAM TERPADU HIDAYAH KLATEN</h1>
            <p class="school-address">Jl. Singosari, Jetis, Belang Wetan, Kec. Klaten Utara, Kab. Klaten, Jawa Tengah, 57438</p>
        </div>

        <h2 class="document-title">Bukti Pembayaran dan Daftar Ulang</h2>

        <div class="content">
            <table class="info-table">
                <tr>
                    <th>NIK</th>
                    <td>{{ $daftarUlang->pendaftaran->casis->nik }}</td>
                </tr>
                <tr>
                    <th>Nama Lengkap</th>
                    <td>{{ $daftarUlang->pendaftaran->casis->nama }}</td>
                </tr>
                <tr>
                    <th>Metode Pembayaran</th>
                    @if($daftarUlang->metode_pembayaran == 'Cicilan')
                    <td><b>{{ $daftarUlang->metode_pembayaran }}</b>
                   (Durasi Pembayaran: 3 Bulan)</td>
                    @else
                    <td>{{ $daftarUlang->metode_pembayaran }}</td>
                    @endif
                </tr>
                <tr>
                    <th>Jumlah Pembayaran</th>
                    <td>Rp {{ number_format($daftarUlang->jumlah_bayar, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td>
                        <span class="status {{ $daftarUlang->status_bayar == 'Berhasil' ? 'status-success' : ($daftarUlang->status_bayar == 'Menunggu Konfirmasi' ? 'status-pending' : 'status-failed') }}">
                            {{ $daftarUlang->status_bayar }}
                        </span>
                    </td>
                </tr>
                <tr>
                    <th>Tanggal Pembayaran</th>
                    <td>{{ date('d/m/Y H:i', strtotime($daftarUlang->tgl_daftar_ulang)) }}</td>
                </tr>
            </table>

            <div class="announcement">
                Pembayaran Daftar Ulang telah diterima. Terima kasih atas partisipasi Anda dalam proses penerimaan siswa baru di SD Islam Terpadu Hidayah Klaten.
            </div>

            @if($daftarUlang->metode_pembayaran == 'Cicilan')
            <div class="payment-info">
                <h4>Informasi Pelunasan:</h4>
                <p>Berdasarkan metode pembayaran yang Anda pilih (Cicilan), mohon perhatikan ketentuan berikut:</p>
                <ul>
                    <li>Pelunasan harus diselesaikan dalam jangka waktu maksimal 3 (tiga) bulan terhitung dari tanggal pembayaran pertama.</li>
                    <li>Batas akhir pelunasan: <strong>{{ date('d F Y', strtotime($daftarUlang->tgl_daftar_ulang . ' + 3 months')) }}</strong></li>
                    <li>Total yang harus dilunasi: <strong>Rp {{ number_format($daftarUlang->total_biaya - $daftarUlang->jumlah_bayar, 0, ',', '.') }}</strong></li>
                    <li>Pembayaran dapat dilakukan melalui offline atau transfer ke rekening sekolah:
                        <br>Bank BNI
                        <br>No. Rekening: 1234567890
                        <br>Atas Nama: SD Islam Terpadu Hidayah Klaten
                    </li>
                </ul>
                <p>Harap simpan bukti pembayaran setiap cicilan dan laporkan ke bagian administrasi sekolah.</p>
            </div>
            @endif
        </div>

        <div class="footer">
            <p>Klaten, {{ date('d F Y') }}</p>
            <p><strong>Panitia Penerimaan Siswa Baru</strong></p>
            <!-- <div class="signature-line"></div> -->
            <!-- <p><strong>(Panitia PSB)</strong></p> -->
        </div>

        <div class="notes">
            <h4>Catatan Penting:</h4>
            <ul>
                <li>Bukti pembayaran ini adalah dokumen resmi dan harap disimpan dengan baik.</li>
                <li>Jika ada pertanyaan atau kendala, silakan hubungi panitia penerimaan siswa baru di nomor (0272) 321081.</li>
                <li>Informasi lebih lanjut mengenai jadwal dan persiapan masuk sekolah akan disampaikan kemudian.</li>

            </ul>
        </div>
    </div>
</body>

</html>
