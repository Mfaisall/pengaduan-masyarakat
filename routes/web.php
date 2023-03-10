<?php

use App\Exports\PengaduansExport;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\ResponController;
use App\Http\Middleware\CekRole;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\Route;
use Whoops\Run;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::middleware('IsLogin', 'CekRole:admin')->group(function(){
    Route::get('/dashboard-admin', [PengaduanController::class, 'dashboardAdmin'])->name('dashboard.admin');
    Route::get('/export/pdf/{id}/store-detials/', [PengaduanController::class, 'createPDF'])->name('export-pdf.storeDetail');
    Route::get('/export/pdf/all', [PengaduanController::class, 'printAll'])->name('export.all');
    Route::get('/export/excel', [PengaduanController::class,  'exportExcel'])->name('export.excel');
    Route::delete('/delete/{id}', [PengaduanController::class, 'delete'])->name('delete');
    
});

Route::middleware('IsLogin', 'CekRole:admin,petugas')->group(function(){
    Route::get('/logout', [PengaduanController::class, 'logout'])->name('logout');
    
});

Route::middleware('IsLogin', 'CekRole:petugas')->group(function(){
    Route::get('/data-petugas', [PengaduanController::class, 'dataPetugas'])->name('data.Petugas');

    //menampilkan form tambah atau ubah response
    Route::get('/respon/edit/{pengaduan_id}', [ResponController::class, 'edit'])->name('respon.edit');
    //kirim data response menggunakan patch karean dia bisa berupa tambah data atau update data 
    Route::patch('/respon/update/{pengaduan_id}', [ResponController::class, 'update'])->name('respon.update');

});


Route::get('/',[PengaduanController::class, 'index'])->name('index');
Route::get('/login', [PengaduanController::class, 'login'])->name('login');
Route::post('/auth', [PengaduanController::class, 'auth'])->name('auth');
Route::post('/tambah-data', [PengaduanController::class, 'store'])->name('tambahdata');
