<?php

namespace App\Http\Controllers\Api;

use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\SuratMasukModel;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SuratMasukController extends Controller
{
    public function getAllData()
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            $data = SuratMasukModel::with('jenis_surat', 'users')
            ->where('id_user', $user->id)
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data not found ',
                ]);
            } else {
                return response()->json([
                    'code' => 200,
                    'message' => 'success get all data',
                    'data' => $data
                ]);
            }
        } elseif ($user->role == 'admin') {
            $data = SuratMasukModel::with('jenis_surat', 'users')
            ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data not found ',
                ]);
            } else {
                return response()->json([
                    'code' => 200,
                    'message' => 'success get all data',
                    'data' => $data
                ]);
            }
        }
    }

    public function filterData($id_jenis_surat)
    {
        $user = Auth::user();
        if ($user->role == 'user') {
            $data = SuratMasukModel::with('jenis_surat', 'users')
                ->where('id_jenis_surat', $id_jenis_surat)
                ->where('id_user', $user->id)
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data not found'
                ]);
            } else {
                return response()->json([
                    'code' => 200,
                    'message' => 'success filterisasi data by user dan jenis surat',
                    'data' => $data
                ]);
            }
        } elseif ($user->role == 'admin') {
            $data = SuratMasukModel::with('jenis_surat', 'users')
                ->where('id_jenis_surat', $id_jenis_surat)
                ->get();

            if ($data->isEmpty()) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data not found'
                ]);
            } else {
                return response()->json([
                    'code' => 200,
                    'message' => 'success filterisasi data by user dan jenis surat',
                    'data' => $data
                ]);
            }
        }
    }


    public function createData(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'no_surat' => 'required',
                'id_jenis_surat' => 'required',
                'tanggal_surat' => 'required|date',
                'perihal' => 'required',
                'asal_surat' => 'required',
                'file_surat_masuk' => 'required|mimes:png,jpg,pdf,docx,doc|max:2048',

            ],
            [
                'no_surat.required' => 'Form no_surat tidak boleh kosong',
                'id_jenis_surat.required' => 'Form id_jenis_surat tidak boleh kosong',
                'tanggal_surat.required' => 'Form tanggal_surat tidak boleh kosong',
                'perihal.required' => 'Form perihal tidak boleh kosong',
                'asal_surat.required' => 'Form asal_surat tidak boleh kosong',
                'file_surat_masuk.required' => 'Form  file_surat tidak boleh kosong',
                'file_surat_masuk.mimes' => 'Ekstensi file harus png,jpg,pdf,docx,doc',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'check your validation',
                'errors' => $validation->errors()
            ]);
        }

        try {
            $user = Auth()->user();
            $data = new SuratMasukModel();
            $data->uuid = Uuid::uuid4()->toString();
            $data->id_user = $user->id;
            $data->no_surat = $request->input('no_surat');
            $data->id_jenis_surat = $request->input('id_jenis_surat');
            $data->tanggal_surat = $request->input('tanggal_surat');
            $data->perihal = $request->input('perihal');
            $data->asal_surat = $request->input('asal_surat');
            if ($request->hasFile('file_surat_masuk')) {
                $file = $request->file('file_surat_masuk');
                $extention = $file->getClientOriginalExtension();
                $filename = 'SURAT_MASUK-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/SuratMasuk/');
                $file->move(public_path('uploads/SuratMasuk/'), $filename);
                $data->file_surat_masuk = $filename;
            }
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed',
                'errors' => $th->getMessage(),
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success create data',
            'data' => $data
        ]);
    }

    public function getDataByUuid($uuid)
    {
        if (!Uuid::isValid($uuid)) {
            return response()->json([
                'code' => 400,
                'message' => 'Uuid is failed',
            ]);
        }

        $data = SuratMasukModel::where('uuid', $uuid)->first();
        if (!$data) {
            return response()->json([
                'code' => 400,
                'message' => 'Data not found',
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'Success get data by Uuid',
                'data' => $data
            ]);
        }
    }

    public function updateDataByUuid(Request $request, $uuid)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'no_surat' => 'required',
                'id_jenis_surat' => 'required',
                'tanggal_surat' => 'required|date',
                'perihal' => 'required',
                'asal_surat' => 'required',
                'file_surat_masuk' => 'mimes:png,jpg,pdf,docx,doc|max:2048',

            ],
            [
                'no_surat.required' => 'Form no_surat tidak boleh kosong',
                'id_jenis_surat.required' => 'Form id_jenis_surat tidak boleh kosong',
                'tanggal_surat.required' => 'Form tanggal_surat tidak boleh kosong',
                'perihal.required' => 'Form perihal tidak boleh kosong',
                'asal_surat.required' => 'Form asal_surat tidak boleh kosong',
                'file_surat_masuk.mimes' => 'Ekstensi file harus png,jpg,pdf,docx,doc',
            ]
        );

        if ($validation->fails()) {
            return response()->json([
                'code' => 422,
                'message' => 'check your validation',
                'errors' => $validation->errors()
            ]);
        }
        try {
            $data = SuratMasukModel::where('uuid', $uuid)->first();
            $data->no_surat = $request->input('no_surat');
            $data->id_jenis_surat = $request->input('id_jenis_surat');
            $data->tanggal_surat = $request->input('tanggal_surat');
            $data->perihal = $request->input('perihal');
            $data->asal_surat = $request->input('asal_surat');
            if ($request->hasFile('file_surat_masuk')) {
                $file = $request->file('file_surat_masuk');
                $extention = $file->getClientOriginalExtension();
                $filename = 'SURAT_MASUK-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/SuratMasuk/');
                $file->move(public_path('uploads/SuratMasuk/'), $filename);
                $old_file_path = public_path('uploads/SuratMasuk/') . $data->file_surat_masuk;
                if (file_exists($old_file_path)) {
                    unlink($old_file_path);
                }
                $data->file_surat_masuk = $filename;
            }
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed to update data',
                'errors' => $th->getMessage(),
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success update data',
            'data' => $data
        ]);
    }

    public function deleteData($uuid)
    {
        if (!Uuid::isValid($uuid)) {
            return response()->json([
                'code' => 404,
                'message' => 'Data Not Found',
            ]);
        }

        try {
            $data = SuratMasukModel::where('uuid', $uuid)->first();
            if (!$data) {
                return response()->json([
                    'code' => 404,
                    'message' => 'Data Not Found',
                ]);
            }

            $filePath = 'uploads/SuratMasuk/' . $data->file_surat_masuk;
            if (File::exists($filePath)) {
                File::delete($filePath);
            }
            $data->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'Failed to delete data',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Delete data success'
        ]);
    }
}
