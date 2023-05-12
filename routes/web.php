<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\transaksiController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\OwnerController;
use App\Models\outlet;

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

Route::get('/test', function () {
    return view('welcome');
});

// Route::get('/dashboard', fn() => view('dashboard'));

Route::get('/Dashboard',[OwnerController::class, 'statistik']);
Route::get('/', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout']);
Route::post('/prosesLogin', [LoginController::class, 'prosesLogin']);

Route::get('/member/data_member', [MemberController::class, 'index']);
Route::post('/member/prosestambah', [MemberController::class, 'tambahMember']);
Route::get('/member/delete/{data_member}', [MemberController::class, 'deleteMember']);
Route::post('/member/edit/edit-member/{data_member}', [MemberController::class, 'editMember']);
Route::get('/member/export', [MemberController::class, 'export']);

Route::get('/outlet/data_outlet', [OutletController::class, 'index']);
Route::post('/outlet/prosestambah', [OutletController::class, 'tambahOutlet']);
Route::get('/outlet/delete/{data_outlet}', [OutletController::class, 'deleteOutlet']);
Route::post('/outlet/edit/edit-outlet/{data_outlet}', [OutletController::class, 'editOutlet']);
Route::get('/outlet/export', [OutletController::class, 'export']);
// Route::get('/outlet/data_outlet', [OutletController::class, 'index']);
// Route::get('/exportlaporanpdf', [OutletController::class, 'export']);
// Route::get('/exportlaporanexcel', [OutletController::class, 'export']);
// Route::get('/outlet/data_outlet/cetak_pdf', 'OutletController@cetak_pdf');

Route::get('/user/data_user', [UserController::class, 'index']);
Route::post('/user/prosestambah', [UserController::class, 'tambahUser']);
Route::get('/user/delete/{data_user}', [UserController::class, 'deleteUser']);
Route::post('/user/edit/edit-user/{data_user}', [UserController::class, 'editUser']);
Route::get('/user/export', [UserController::class, 'export']);

Route::get('/paket/paket_laundry', [PaketController::class, 'index']);
Route::post('/paket/prosestambah', [PaketController::class, 'tambahPaket']);
Route::get('/paket/delete/{data_paket}', [PaketController::class, 'deletePaket']);
Route::post('/paket/edit/edit-paket/{data_paket}', [PaketController::class, 'editPaket']);
Route::get('/paket/export', [PaketController::class, 'export']);

Route::get('/transaksi/data_transaksi', [TransaksiController::class, 'index']);
Route::post('/transaksi/prosestambah', [TransaksiController::class, 'tambahTransaksi']);
Route::get('/transaksi/delete/{data_transaksi}', [TransaksiController::class, 'deleteTransaksi']);
Route::post('/transaksi/edit/edit-transaksi/{data_transaksi}', [TransaksiController::class, 'editTransaksi']);

Route::get('/transaksi/detail_transaksi/{transaksi}', [DetailController::class, 'indexDetail']);

