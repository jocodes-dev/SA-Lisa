<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\SuratKeluarModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Ramsey\Uuid\Uuid;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class SuratKeluarController extends Controller
{
    public function getAllData()
    {
        $data = SuratKeluarModel::with('jenis_surat')->get();
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
                'tujuan_surat' => 'required',
                'file_surat_keluar' =>'required|mimes:png,jpg,pdf,docx,doc|max:2048',

            ],
            [
                'no_surat.required' => 'Form no_surat tidak boleh kosong',
                'id_jenis_surat.required' => 'Form id_jenis_surat tidak boleh kosong',
                'tanggal_surat.required' => 'Form tanggal_surat tidak boleh kosong',
                'perihal.required' => 'Form perihal tidak boleh kosong',
                'tujuan_surat.required' => 'Form tujuan_surat tidak boleh kosong',
                'file_surat_keluar.required' => 'Form  file_surat tidak boleh kosong',
                'file_surat_keluar.mimes' => 'Ekstensi file harus png,jpg,pdf,docx,doc',
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
            $data = new SuratKeluarModel();
            $data->uuid = Uuid::uuid4()->toString();
            $data->id_user = $request->input('id_user');
            $data->no_surat = $request->input('no_surat');
            $data->id_jenis_surat = $request->input('id_jenis_surat');
            $data->tanggal_surat = $request->input('tanggal_surat');
            $data->perihal = $request->input('perihal');
            $data->tujuan_surat = $request->input('tujuan_surat');
            if($request->hasFile('file_surat_keluar')){
                $file= $request->file('file_surat_keluar');
                $extention= $file->getClientOriginalExtension();
                $filename = 'SURAT-KELUAR-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/SuratKeluar/');
                $file->move(public_path('uploads/SuratKeluar/'), $filename);
                $data->file_surat_keluar = $filename;
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

        $data = SuratKeluarModel::where('uuid', $uuid)->first();
        if(!$data){
            return response()->json([
                'code' => 400,
                'message' => 'Data not found',
            ]);
        }else{
            // $data->date = Carbon::createFromFormat('d F Y', $data->date)->format('Y-m-d');
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
                'tujuan_surat' => 'required',
                'file_surat_keluar' => 'required|mimes:png,jpg,pdf,docx,doc|max:2048',

            ],
            [
                'no_surat.required' => 'Form no_surat tidak boleh kosong',
                'id_jenis_surat.required' => 'Form id_jenis_surat tidak boleh kosong',
                'tanggal_surat.required' => 'Form tanggal_surat tidak boleh kosong',
                'perihal.required' => 'Form perihal tidak boleh kosong',
                'tujuan_surat.required' => 'Form tujuan_surat tidak boleh kosong',
                'file_surat_keluar.required' => 'Form  file_surat tidak boleh kosong',
                'file_surat_keluar.mimes' => 'Ekstensi file harus png,jpg,pdf,docx,doc',
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
            $data = SuratKeluarModel::where('uuid', $uuid)->firstOrFail();
            $data->no_surat = $request->input('no_surat');
            $data->id_jenis_surat = $request->input('id_jenis_surat');
            $data->tanggal_surat = $request->input('tanggal_surat');
            $data->perihal = $request->input('perihal');
            $data->tujuan_surat = $request->input('tujuan_surat');
            if ($request->hasFile('file_surat_keluar')) {
                $file = $request->file('file_surat_keluar');
                $extention = $file->getClientOriginalExtension();
                $filename = 'SURAT-KELUAR-' . Str::random(15) . '.' . $extention;
                Storage::makeDirectory('uploads/SuratKeluar/');
                $file->move(public_path('uploads/SuratKeluar/'), $filename);
                $old_file_path = public_path('uploads/SuratKeluar/') . $data->file_surat_keluar;
                if(file_exists($old_file_path)){
                    unlink($old_file_path);
                }
                $data->file_surat_keluar = $filename;
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
            $data = SuratKeluarModel::where('uuid', $uuid)->first();
            if(!$data){
                return response()->json([
                    'code' => 404,
                    'message' => 'Data Not Found',
                ]);
            }

            $filePath = 'uploads/SuratKeluar/' . $data->file_surat_keluar;
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
