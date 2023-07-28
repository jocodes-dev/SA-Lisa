<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratMasukModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Response;

class SuratMasukController extends Controller
{
    public function getAllData()
    {
        $data = SuratMasukModel::with('jenis_surat')->get();
        if ($data->isEmpty()) {
            return response()->json([
                'code' => 404,
                'message' => 'Data not found'
            ]);
        } else {
            return response()->json([
                'code' => 200,
                'message' => 'Success get all data',
                'data' => $data
            ]);
        }
    }

    public function createData(Request $request){
        $validation = Validator::make(
            $request->all(),
            [
                'no_surat'=> 'required',
                'id_jenis_surat'=> 'required',
                'tanggal_surat' => 'required|date',
                'perihal' => 'required',
                'asal_surat' => 'required',
                'file_surat_masuk' =>'required|mimes:png,jpg,pdf,docx,doc|max:2048',

            ],
            [
                'no_surat.required' => 'Form tidak boleh kosong',
                'id_jenis_surat.required' => 'Form tidak boleh kosong',
                'tanggal_surat.required' => 'Form tidak boleh kosong',
                'perihal.required' => 'Form tidak boleh kosong',
                'asal_surat.required' => 'Form tidak boleh kosong',
                'file_surat_masuk.required' =>'Ekstensi file harus png,jpg,pdf,docx,doc',
            ]
        );

        if ($validation->fails()){
            return response()->json([
                'code' => 422,
                'message' => 'check your validation',
                'errors' => $validation->errors()
            ]);
        }

        try{
            $data = new SuratMasukModel();
            $data->uuid = Uuid::uuid4()->toString();
            $data->id_user = $request->input('id_user');
            $data->no_surat = $request->input('no_surat');
            $data->id_jenis_surat = $request->input('id_jenis_surat');
            $data->tanggal_surat = $request->input('tanggal_surat');
            $data->perihal = $request->input('perihal');
            $data->asal_surat = $request->input('asal_surat');
            if($request->hasFile('file_surat_masuk')){
                $file= $request->file('file_surat_masuk');
                $extention= $file->getClientOriginalExtension();
                $filename = 'SURAT_MASUK-'.Str::random(15).' '.$extention;
                Storage::makeDirectory('uploads/SuratMasuk/');
                $file->move(public_path('uploads/SuratMasuk/'), $filename);
                $data->file_surat_masuk = $filename;
            }
            $data->save();
        }catch(\Throwable $th){
            return response()->json([
                'code' =>400,
                'message' =>'Failed',
                'errors' => $th->getMessage(),
            ]);
        }

        return response()->json([
            'code' => 200,
            'message' => 'Success create data',
            'data' => $data
        ]);
    }

    public function getDataByUuid($uuid){
        if(!Uuid::isValid($uuid)){
            return response()->json([
                'code' => 400,
                'message' => 'Uuid is failed',
            ]);
        }

        $data = SuratMasukModel::where('uuid', $uuid)->first();
        if(!$data){
            return response()->json([
                'code' => 400,
                'message' => 'Data not found',
            ]);
        }else{
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
                'file_surat_masuk' => 'required|mimes:png,jpg,pdf,docx,doc|max:2048',

            ],
            [
                'no_surat.required' => 'Form tidak boleh kosong',
                'id_jenis_surat.required' => 'Form tidak boleh kosong',
                'tanggal_surat.required' => 'Form tidak boleh kosong',
                'perihal.required' => 'Form tidak boleh kosong',
                'asal_surat.required' => 'Form tidak boleh kosong',
                'file_surat_masuk.required' => 'Ekstensi file harus png,jpg,pdf,docx,doc',
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
            $data = SuratMasukModel::where('uuid', $uuid)->firstOrFail();
            $data->no_surat = $request->input('no_surat');
            $data->id_jenis_surat = $request->input('id_jenis_surat');
            $data->tanggal_surat = $request->input('tanggal_surat');
            $data->perihal = $request->input('perihal');
            $data->asal_surat = $request->input('asal_surat');
            if ($request->hasFile('file_surat_masuk')) {
                $file = $request->file('file_surat_masuk');
                $extention = $file->getClientOriginalExtension();
                $filename = 'SURAT_MASUK-' . Str::random(15) . ' ' . $extention;
                Storage::makeDirectory('uploads/SuratMasuk/');
                $file->move(public_path('uploads/SuratMasuk/'), $filename);
                $old_file_path = public_path('uploads/SuratMasuk/') . $data->file_surat_masuk;
                if(file_exists($old_file_path)){
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
        if(!Uuid::isValid($uuid)){
            return response()->json([
                'code' => 404,
                'message' => 'Data Not Found',
            ]);
        }

        try {
            $data = SuratMasukModel::where('uuid', $uuid)->first();
            if(!$data){
                return response()->json([
                    'code' => 404,
                    'message' => 'Data Not Found',
                ]);
            }

            $filePath = 'uploads/SuratMasuk/' . $data->file_surat_masuk;
            if(File::exists($filePath)){
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
            'code'=>200,
            'message'=>'Delete data success'
        ]);
    }
}
