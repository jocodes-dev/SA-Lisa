<?php

use App\Http\Controllers\Api\SuratMasukController;
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

Route::prefix('v1')->controller(SuratMasukController::class)->group(function () {
    Route::get('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk', 'getAllData');
    Route::post('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/create', 'createData');
    Route::get('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/get/{uuid}', 'getDataByUuid');
    Route::post('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/update/{uuid}', 'updateDataByUuid');
    Route::delete('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/delete/{uuid}', 'deleteData');
});
