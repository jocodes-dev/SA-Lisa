<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisSuratModel;
use App\Models\SuratKeluarModel;
use App\Models\SuratMasukModel;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function countData()
    {
        $user = User::count();
        $Jenis_Surat = JenisSuratModel::count();
        $Surat_Keluar = SuratKeluarModel::count();
        $Surat_Masuk = SuratMasukModel::count();


        return response()->json([
            'code'=> 200,
            'message' => 'success count',
            'data' => [
                'user' => $user,
                'Jenis_Surat' => $Jenis_Surat,
                'Surat_Keluar' => $Surat_Keluar,
                'Surat_Masuk' => $Surat_Masuk,
            ]
        ]);
    }
}
