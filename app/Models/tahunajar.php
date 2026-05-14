<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahunajar extends Model
{
    use HasFactory;

    protected $table = 'tahun_ajar';
    protected $fillable = ['id_ajar', 'tahun_ajar', 'status', 'mulai_pendaftaran', 'batas_pendaftaran', 'tgl_seleksi', 'kuota'];
    protected $primaryKey = 'id_ajar';

    public function pendaftaran()
    {
        return $this->hasOne(pendaftaran::class, 'ajar_id', 'id_ajar');
    }
}
