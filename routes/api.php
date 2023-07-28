<?php

use App\Http\Controllers\Api\SuratMasukController;
use App\Http\Controllers\Api\JenisSuratController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->controller(JenisSuratController::class)->group(function () {
    Route::get('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat', 'getAllData');
    Route::post('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/create', 'createData');
    Route::get('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/get/{uuid}', 'getDataByUuid');
    Route::post('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/update/{uuid}', 'updateDataByUuid');
    Route::delete('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/delete/{uuid}', 'deleteData');
});

Route::prefix('v1')->controller(SuratMasukController::class)->group(function () {
    Route::get('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk', 'getAllData');
    Route::post('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/create', 'createData');
    Route::get('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/get/{uuid}', 'getDataByUuid');
    Route::post('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/update/{uuid}', 'updateDataByUuid');
    Route::delete('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/delete/{uuid}', 'deleteData');
});

