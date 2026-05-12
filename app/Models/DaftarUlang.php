<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarUlang extends Model
{
    use HasFactory;

    protected $table = 'tb_daftar_ulang';
    protected $primaryKey = 'id_daftar_ulang';

    protected $fillable = [
        'pendaftaran_id',
        'tahun_ajaran',
        'tgl_daftar_ulang',
        'total_biaya',
        'metode_pembayaran',
        'jumlah_bayar',
        'status_bayar',
        'bukti_pembayaran',
        'keterangan',
    ];

    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class, 'pendaftaran_id', 'id_pendaftaran');
    }
}
