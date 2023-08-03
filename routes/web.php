<?php

use App\Http\Controllers\Api\JenisSuratController;
use App\Http\Controllers\Api\SuratKeluarController;
use App\Http\Controllers\Api\SuratMasukController;
use App\Http\Controllers\Auth\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    return view('dashboard');
});

Route::get('/jenis-surat', function () {
    return view('jenisSurat');
});

Route::get('/surat-masuk', function () {
    return view('suratMasuk');
});

Route::get('/surat-keluar', function () {
    return view('suratKeluar');
});

Route::get('/arsip-surat-masuk', function () {
    return view('arsipSuratMasuk');
});

Route::get('/arsip-surat-masuk/{id_jenis_surat}', function () {
    return view('arsipSuratMasukByName');
});

Route::get('/add-user', function () {
    return view('addUser');
});

Route::get('/login', function () {
    return view('login');
});

// route login
Route::post('/56cfb271-4e29-47cc-a237-8ae819491903/user/login', [UserController::class, 'login']);

Route::middleware(['web', 'auth'])->group(function () {
    // route jenis surat
    Route::prefix('v1')->controller(JenisSuratController::class)->group(function () {
        Route::get('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat', 'getAllData');
        Route::post('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/create', 'createData');
        Route::get('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/get/{uuid}', 'getDataByUuid');
        Route::post('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/update/{uuid}', 'updateDataByUuid');
        Route::delete('/42231a39-a9b8-4781-88cc-1ec4460e5c4d/jenis_surat/delete/{uuid}', 'deleteData');
    });

    // route surat masuk
    Route::prefix('v2')->controller(SuratMasukController::class)->group(function () {
        Route::get('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk', 'getAllData');
        Route::get('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/filter/{id_jenis_surat}/', 'filterData');
        Route::post('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/create', 'createData');
        Route::get('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/get/{uuid}', 'getDataByUuid');
        Route::post('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/update/{uuid}', 'updateDataByUuid');
        Route::delete('/5d089a00-904c-40aa-8fb5-6bdd21bfafe2/surat_masuk/delete/{uuid}', 'deleteData');
    });

    // route surat keluar
    Route::prefix('v3')->controller(SuratKeluarController::class)->group(function () {
        Route::get('/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar', 'getAllData');
        Route::get('/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/filter/{id_jenis_surat}/', 'filterData');
        Route::post('/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/create', 'createData');
        Route::get('/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/get/{uuid}', 'getDataByUuid');
        Route::post('/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/update/{uuid}', 'updateDataByUuid');
        Route::delete('/96d6585-16ae-4d04-9549-c499e52b75/surat/keluar/delete/{uuid}', 'deleteData');
    });

    // route create data user dan log out

});
Route::prefix('v4')->controller(UserController::class)->group(function () {
    Route::get('/56cfb271-4e29-47cc-a237-8ae819491903/user', 'getAllData');
    Route::post('/56cfb271-4e29-47cc-a237-8ae819491903/user/create', 'createData');
    Route::get('/56cfb271-4e29-47cc-a237-8ae819491903/user/get/{uuid}', 'getDataByUuid');
    Route::post('/56cfb271-4e29-47cc-a237-8ae819491903/user/update/{uuid}', 'updateDataByUuid');
    Route::delete('/56cfb271-4e29-47cc-a237-8ae819491903/user/delete/{uuid}', 'deleteData');
    Route::post('/56cfb271-4e29-47cc-a237-8ae819491903/user/logout', 'logout');
});
