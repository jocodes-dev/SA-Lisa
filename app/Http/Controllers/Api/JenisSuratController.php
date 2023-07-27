<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JenisSuratModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class JenisSuratController extends Controller
{
    public function getAllData()
    {
        $data = JenisSuratModel::all();
        if ($data->isEmpty()) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'success get all data',
                'data' => $data
            ]);
        }
    }

    public function createData(Request $request)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'jenis_surat' => 'required'
            ],
            [
                'jenis_surat.required' => 'Form jenis surat tidak boleh kosong'
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
            $data = new JenisSuratModel;
            $data->uuid = Uuid::uuid4()->toString();
            $data->jenis_surat = $request->input('jenis_surat');
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'failed',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success create data',
            'data' => $data
        ]);
    }

    public function getDataByUuid($uuid)
    {

        if (!Uuid::isValid($uuid)) {
            return response()->json([
                'code' => 404,
                'message' => 'UUID Failed'
            ]);
        }

        $data = JenisSuratModel::where('uuid', $uuid)->first();
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'success get data by uuid',
                'data' => $data
            ]);
        }
    }
    public function updateDataByUuid(Request $request, $uuid)
    {
        $validation = Validator::make(
            $request->all(),
            [
                'jenis_surat' => 'required'
            ],
            [
                'jenis_surat.required' => 'Form jenis surat tidak boleh kosong'
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
            $data = JenisSuratModel::where('uuid', $uuid)->firstOrFail();
            $data->jenis_surat = $request->input('jenis_surat');
            $data->save();
        } catch (\Throwable $th) {
            return response()->json([
                'code' => 400,
                'message' => 'failed',
                'errors' => $th->getMessage()
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'success update data',
            'data' => $data
        ]);
    }

    public function deleteData($uuid)
    {
        if (!Uuid::isValid($uuid)) {
            return response()->json([
                'code' => 404,
                'message' => 'UUID Failed'
            ]);
        }

        $data = JenisSuratModel::where('uuid', $uuid)->first();
        $data->delete();
        if (!$data) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'success delete data'
            ]);
        }
    }
}
