<?php

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/jenis-surat', function () {
    return view('jenisSurat');
});

Route::get('/surat-masuk', function () {
    return view('suratKeluar');
});

Route::get('/surat-keluar', function () {
    return view('suratKeluar');
});

Route::get('/arsip', function () {
    return view('arsip');
});
