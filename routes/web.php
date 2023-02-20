<?php

use App\Http\Controllers\PengaduanController;
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

Route::get('/',[PengaduanController::class, 'index'])->name('index');
Route::get('/login', [PengaduanController::class, 'login'])->name('login');
Route::post('/auth', [PengaduanController::class, 'auth'])->name('auth');
Route::post('/tambah-data', [PengaduanController::class, 'store'])->name('tambahdata');
Route::get('/logout', [PengaduanController::class, 'logout'])->name('logout');


Route::middleware('IsLogin')->group(function (){
    Route::delete('/delete/{id}', [PengaduanController::class, 'delete'])->name('delete');
    Route::get('/dashboard.admin', [PengaduanController::class, 'dashboardAdmin'])->name('dashboard');
});


