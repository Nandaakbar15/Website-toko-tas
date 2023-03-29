<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboardbootstrap', function() {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');

// untuk master data toko
Route::get('/toko','App\Http\Controllers\TokoController@index')->middleware(['auth'])->name('toko');
Route::get('/toko/create', 'App\Http\Controllers\TokoController@create')->middleware(['auth']);
Route::post('/toko/store', 'App\Http\Controllers\TokoController@store')->middleware(['auth']);
Route::get('/toko/destroy/{id}', '\App\Http\Controllers\TokoController@destroy')->middleware(['auth']);
Route::get('/toko/edit/{id}', 'App\Http\Controllers\TokoController@edit')->middleware(['auth']);
Route::post('/toko/update', 'App\Http\Controllers\TokoController@update')->middleware(['auth']);

// untuk master data produk
Route::get('/produk', 'App\Http\Controllers\ProdukController@index')->middleware(['auth']);
Route::post('/produk', 'App\Http\Controllers\ProdukController@store')->middleware(['auth']);
Route::get('/produk/destroy/{id}', 'App\Http\Controllers\ProdukController@destroy')->middleware(['auth']);
Route::get('/produk/viewdata/{id}', 'App\Http\Controllers\ProdukController@view')->middleware(['auth']);
Route::get('/produk/viewdata2/{id}', 'App\Http\Controllers\ProdukController@viewdata')->middleware(['auth']);
Route::get('/produk/edit/{id}', 'App\Http\Controllers\ProdukController@edit')->middleware(['auth']);

Route::get('/produk/fetchproduk', 'App\Http\Controllers\ProdukController@fetchproduk')->middleware(['auth']);

// untuk master data pelanggan
Route::get('/pelanggan', 'App\Http\Controllers\PelangganController@index')->middleware(['auth']);
Route::post('/pelanggan', 'App\Http\Controllers\PelangganController@store')->middleware(['auth']);
Route::get('/pelanggan/destroy/{id}', 'App\Http\Controllers\PelangganController@destroy')->middleware(['auth']);
Route::get('/pelanggan/viewdata/{id}', 'App\Http\Controllers\PelangganController@view')->middleware(['auth']);
Route::get('/pelanggan/viewdata2/{id}', 'App\Http\Controllers\PelangganController@viewdata')->middleware(['auth']);
Route::get('/pelanggan/edit/{id}', 'App\Http\Controllers\PelangganController@edit')->middleware(['auth']);

Route::get('/pelanggan/fetchpelanggan', 'App\Http\Controllers\PelangganController@fetchpelanggan')->middleware(['auth']);

// untuk transaksi penjualan
Route::get('/penjualan', 'App\Http\Controllers\PenjualanController@index')->middleware(['auth']);
Route::get('/penjualan/barang/{id}', 'App\Http\Controllers\PenjualanController@getDataBarang')->middleware(['auth']);
Route::post('/penjualan', 'App\Http\Controllers\PenjualanController@store')->middleware(['auth']);
Route::get('/penjualan/keranjang', 'App\Http\Controllers\PenjualanController@keranjang')->middleware(['auth']);
Route::get('/penjualan/invoice', 'App\Http\Controllers\PenjualanController@invoice')->middleware(['auth']);
Route::get('/penjualan/jmlinvoice', 'App\Http\Controllers\PenjualanController@getInvoice')->middleware(['auth']);
Route::get('/penjualan/destroypenjualandetail/{id}', 'App\Http\Controllers\PenjualanController@destroypenjualandetail')->middleware(['auth']);
Route::get('/penjualan/barang', 'App\Http\Controllers\PenjualanController@getDataBarangAll')->middleware(['auth']);
Route::get('/penjualan/jmlbarang', 'App\Http\Controllers\PenjualanController@getJumlahBarang')->middleware(['auth']);
Route::get('/penjualan/keranjangjson', 'App\Http\Controllers\PenjualanController@keranjangjson')->middleware(['auth']);
Route::get('/penjualan/checkout', 'App\Http\Controllers\PenjualanController@checkout')->middleware(['auth']);

// transaksi pembayaran viewkeranjang
Route::get('/pembayaran/viewkeranjang', 'App\Http\Controllers\PembayaranController@viewkeranjang')->middleware(['auth']);
Route::post('/pembayaran/store', 'App\Http\Controllers\PembayaranController@store')->middleware(['auth']);
Route::get('/pembayaran', 'App\Http\Controllers\PembayaranControllers@index')->middleware(['auth']);
Route::get('/pembayaran/viewstatus', 'App\Http\Controllers\PembayaranController@viewstatus')->middleware(['auth']);
Route::get('/pembayaran/viewapprovalstatus', 'App\Http\Controllers\PembayaranController@viewapprovalstatus')->middleware(['auth','admin']);
Route::get('/pembayaran/approve/{no_transaksi}', 'App\Http\Controllers\PembayaranController@approve')->middleware(['auth']);
Route::get('/pembayaran/viewstatusPG', 'App\Http\Controllers\PembayaranController@viewstatusPG')->middleware(['auth']);

// untuk midtrans
Route::get('/midtrans', 'App\Http\Controllers\CobaMidtransController@index')->middleware(['auth','admin']);
Route::get('/midtrans/status', 'App\Http\Controllers\CobaMidtransController@cekstatus')->middleware(['auth','admin']);
Route::get('/midtrans/tes/{id}', 'App\Http\Controllers\CobaMidtransController@tes')->middleware(['auth','admin']);
Route::get('/midtrans/bayar', 'App\Http\Controllers\CobaMidtransController@bayar')->middleware(['auth','admin']);
Route::post('/midtrans/proses_bayar', 'App\Http\Controllers\CobaMidtransController@proses_bayar')->middleware(['auth']);


// untuk master data gambar produk
Route::get('/gambarproduk', 'App\Http\Controllers\GambarProdukController@index')->middleware(['auth']);
Route::post('/gambarproduk', 'App\Http\Controllers\GambarProdukController@store')->middleware(['auth']);
Route::get('/gambarproduk/fetchgambar', 'App\Http\Controllers\GambarProdukController@fetchgambar')->middleware(['auth']);
Route::get('/gambarproduk/destroy/{id}', 'App\Http\Controllers\GambarProdukController@destroy')->middleware(['auth']);
Route::get('/gambarproduk/edit/{id}', 'App\Http\Controllers\GambarProdukController@edit')->middleware(['auth']);

// grafik
Route::get('/grafik/viewPenjualanBlnBerjalan', 'App\Http\Controllers\GrafikController@viewPenjualanBlnBerjalan')->middleware(['auth','admin']);
Route::get('/grafik/viewStatusPenjualan', 'App\Http\Controllers\GrafikController@viewStatusPenjualan')->middleware(['auth','admin']);
Route::get('/grafik/viewJmlBarangTerjual', 'App\Http\Controllers\GrafikController@viewJmlBarangTerjual')->middleware(['auth','admin']);

// dashboard
// Route::get('dashboardbootstrap', 'App\Http\Controllers\DashboardController@viewPenjualanBlnBerjalan')->middleware(['auth','admin']);
// Route::get('dashboardbootstrap', 'App\Http\Controllers\DashboardController@viewStatusPenjualan')->middleware(['auth','admin']);
Route::get('dashboardbootstrap', 'App\Http\Controllers\DashboardController@viewJmlBarangTerjual')->middleware(['auth'])->name('dashboardbootstrap');


require __DIR__.'/auth.php';
