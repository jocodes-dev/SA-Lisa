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
        'file_surat_masuk',
        'created_at',
        'updated_at'
    ];

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSuratModel::class, 'id_jenis_surat');
    }

    public function getJenisSurat($id_jenis_surat)
    {
        $data = $this->join('tb_surat_masuk', '=', 'tb_jenis_surat.id')
        ->select('tb_jenis_surat.uuid', 'tb_jenis_surat.jenis_surat')
        ->where('tb_surat_masuk.id_jenis_surat', '=', $id_jenis_surat)
            ->first();
        return $data;
    }
}
