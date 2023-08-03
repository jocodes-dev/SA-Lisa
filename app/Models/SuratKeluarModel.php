<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuratKeluarModel extends Model
{
    use HasFactory;
    protected $table = "tb_surat_keluar";
    protected $fillable = [
        'id', 'uuid', 'id_user', 'nomor_surat', 'id_jenis_surat', 'tanggal_surat', 'perihal', 'file_surat_masuk', 'asal_surat', 'created_at', 'updated_at'
    ];

    public function jenis_surat()
    {
        return $this->belongsTo(JenisSuratModel::class, 'id_jenis_surat');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function getUser($id_user)
    {
        $data = $this->join('tb_surat_keluar', '=' , 'users.id')
        ->select('tb_users.uuid', 'users.name', 'users.role')
        ->where('tb_surat_keluar.id_user' , '=' , $id_user)
        ->first();
        return $data;
    }

    public function getJenisSurat($id_jenis_surat)
    {
        $data = $this->join('tb_surat_keluar', '=', 'tb_jenis_surat.id')
            ->select('tb_jenis_surat.uuid', 'tb_jenis_surat.jenis_surat')
            ->where('tb_surat_keluar.id_jenis_surat', '=', $id_jenis_surat)
            ->first();
        return $data;
    }
}
