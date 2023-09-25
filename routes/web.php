<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GenerateController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Models\Transaksi;

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

Route::get('struk', function () {
    return view('struk');
});
Route::get('/',[IndexController::class,'login']);

// Route::get('dashboard',[IndexController::class,'dashboard']);
Route::post('postlogin',[AuthController::class,'postlogin']);
Route::get('logout',[AuthController::class,'logout']);

// Pelanggan
Route::get('registerpelanggan',[MemberController::class,'index']);


Route::get('index',[AuthController::class,'index']);

Route::group(['prefix' => 'laundry','middleware' => ['auth'] ],function(){

    Route::get('tampilstruk',[TransaksiController::class,'struk']);

    Route::group(['middleware' => ['CekLogin:admin']],function() {
        //user
        Route::get('user',[UserController::class, 'tampil']);
        Route::get('registeruserpage',[UserController::class, 'registerpage']);
        Route::post('registeruser',[UserController::class, 'registeruser']);
        Route::get('updateuserpage/{id}',[UserController::class, 'updatepage']);
        Route::post('updateuser/{id}',[UserController::class, 'update']);
        Route::get('deleteuser/{id}',[UserController::class, 'delete']);

        //member
        Route::get('pelanggan',[MemberController::class, 'index']);
        Route::get('registerpage',[IndexController::class, 'registermember']);
        Route::post('registermember',[MemberController::class, 'store']);
        Route::get('updatememberpage/{id_member}',[MemberController::class, 'updatemember']);
        Route::post('updatemember/{id_member}',[MemberController::class, 'update']);
        Route::get('deletemember/{id_member}',[MemberController::class, 'delete']);

        //outlet
        Route::get('outlet',[OutletController::class, 'index']);
        Route::get('registeroutletpage',[OutletController::class, 'tampil']);
        Route::post('registeroutlet',[OutletController::class, 'store']);
        Route::get('updateoutletpage/{id_outlet}',[OutletController::class,'tampilupdate']);
        Route::post('updateoutlet/{id_outlet}',[OutletController::class,'update']);
        Route::get('deleteoutlet/{id_outlet}',[OutletController::class,'delete']);

        //paket
        Route::get('paket',[PaketController::class,'index']);
        Route::get('registerpaketpage',[PaketController::class,'tampilregister']);
        Route::post('registerpaket',[PaketController::class,'store']);
        Route::get('updatepaketpage/{id_paket}',[PaketController::class,'updatepage']);
        Route::post('updatepaket/{id_paket}',[PaketController::class,'update']);
        Route::get('deletepaket/{id_paket}',[PaketController::class,'destroy']);

        //transaksi
        Route::get('transaksi',[TransaksiController::class,'index']);
        Route::get('registertransaksipage',[TransaksiController::class,'registerpage']);
        Route::post('registertransaksi',[TransaksiController::class,'store']);
        Route::get('updatetransaksipage/{id_transaksi}',[TransaksiController::class,'tampilupdate']);
        Route::post('updatetransaksi/{id_transaksi}',[TransaksiController::class,'updatetransaksi']);
        Route::get('deletetransaksi/{id_transaksi}',[TransaksiController::class,'destroy']);

        //pilih paket saat register transaksi
        Route::get('belipaket',[TransaksiController::class,'belipaket']);
        Route::get('tambah/{id_paket}',[TransaksiController::class,'tambah']);
        Route::get('kurang/{id_paket}',[TransaksiController::class,'kurang']);
        Route::get('hapuspilihan/{id_paket}',[TransaksiController::class,'hapus']);
        Route::get('batal',[TransaksiController::class,'batal']);

        //generate laporan
        Route::get('generate',[GenerateController::class,'index']);
        Route::get('generatelaporan',[GenerateController::class,'cetak']);

    });

    Route::group(['middleware' => ['CekLogin:kasir']],function() {
       //transaksi
       Route::get('transaksi',[TransaksiController::class,'index']);
       Route::get('registertransaksipage',[TransaksiController::class,'registerpage']);
       Route::post('registertransaksi',[TransaksiController::class,'store']);
       Route::get('updatetransaksipage/{id_transaksi}',[TransaksiController::class,'tampilupdate']);
       Route::post('updatetransaksi/{id_transaksi}',[TransaksiController::class,'updatetransaksi']);
       Route::get('deletetransaksi/{id_transaksi}',[TransaksiController::class,'destroy']);

       //pilih paket saat register transaksi
       Route::get('belipaket',[TransaksiController::class,'belipaket']);
       Route::get('tambah/{id_paket}',[TransaksiController::class,'tambah']);
       Route::get('kurang/{id_paket}',[TransaksiController::class,'kurang']);
       Route::get('hapuspilihan/{id_paket}',[TransaksiController::class,'hapus']);
       Route::get('batal',[TransaksiController::class,'batal']);


        //generate laporan
        Route::get('generate',[GenerateController::class,'index']);
        Route::get('generatelaporan',[GenerateController::class,'cetak']);
    });

    Route::group(['middleware' => ['CekLogin:owner']],function() {

        //generate laporan
        Route::get('generate',[GenerateController::class,'index']);
        Route::get('generatelaporan',[GenerateController::class,'cetak']);
    });
});

