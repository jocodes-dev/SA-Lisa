<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratMasukModel extends Model
{
    use HasFactory;
    protected $table = 'tb_surat_masuk';
    protected $fillable = [
        'id',
        'uuid',
        'id_user',
        'no_surat',
        'id_jenis_surat',
        'tanggal_surat',
        'perihal',
        'asal_surat',
        'file_surat_masuk'
    ];
}
