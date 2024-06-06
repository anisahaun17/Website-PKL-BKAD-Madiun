<?php

use App\Http\Controllers\ApiController;
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

Route::as('api.')->group(function () {
    Route::get("/jenis/search/kategori/{kategori_id}", [ApiController::class, 'jenisByKategori'])->name('jenisByKategori');
    Route::get("/asset/search/jenis/{jenis_id}", [ApiController::class, 'assetByJenis'])->name('assetByJenis');
    Route::get("/assetDetail/search/jenis/{asset_id}", [ApiController::class, 'assetDetailByJenis'])->name('assetDetailByJenis');
    Route::get("/assetDetail/search/{assetDetail}", [ApiController::class, 'assetDetailById'])->name('assetDetailById');
});
