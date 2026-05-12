<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    use HasFactory;

    protected $table = 'tb_pendaftaran';
    protected $fillable = ['id_pendaftaran', 'casis_id', 'status', 'akte', 'kk','tgl_pendaftaran','foto','ajar_id'];
    protected $primaryKey = 'id_pendaftaran';

    public function casis()
    {
        return $this->belongsTo(casis::class, 'casis_id', 'id_casis');
    }

    public function tahunajar()
    {
        return $this->belongsTo(tahunajar::class, 'ajar_id', 'id_ajar');
    }

    public function pembayaran()
    {
        return $this->hasOne(pembayaran::class, 'casis_id', 'casis_id');
    }

    public function seleksi()
    {
        return $this->hasOne(selekasi::class, 'pendaftaran_id', 'id_pendaftaran');
    }

}
