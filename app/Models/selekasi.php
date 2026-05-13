<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class selekasi extends Model
{
    use HasFactory;

    protected $table = 'tb_seleksi';
    protected $fillable = [
    'id_seleksi',
    'casis_id',
    'pendaftaran_id',
    'tgl_seleksi',
    'nilai_baca',
    'nilai_tulis',
    'nilai_hitung',
    'nilai_wawancara',
    'total_nilai',
    'nilai_akhir',
    'hasil_seleksi'
];
    protected $primaryKey = 'id_seleksi';

    public function casis()
    {
        return $this->belongsTo(Casis::class, 'casis_id', 'id_casis');
    }

    public function pendaftaran()
    {
        return $this->belongsTo(pendaftaran::class, 'pendaftaran_id', 'id_pendaftaran');
    }
}
