<?php

use App\Http\Controllers\KamarKosController;
use App\Http\Controllers\PenyewaController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');


Route::get('transaksi/list-kamar', 'TransaksiController@listKamar')
    ->name('transaksi.list-kamar');

Route::post('transaksi/booking/{transaksi}', [TransaksiController::class, 'booking'])
    ->name('transaksi.booking');

Route::delete('transaksi/booking/{transaksi}', [TransaksiController::class, 'cancelBooking'])
    ->name('transaksi.cancel-booking');


Route::get('transaksi/my-trx', 'TransaksiController@myTrx')
    ->name('transaksi.my-trx');


Route::get('transaksi', [TransaksiController::class, 'index'])
    ->name('transaksi.index');

Route::put('transaksi/confirmation/{transaksi}', 'TransaksiController@confirm')
    ->name('transaksi.confirm');

Route::post('transaksi/submit-bukti-tf/{transaksi}', 'TransaksiController@submitBuktiTf')
    ->name('transaksi.submit-bukti-tf');

Route::put('transaksi/confirmation-payment/{transaksi}', 'TransaksiController@confirmPayment')
    ->name('transaksi.confirmation-payment');

Route::put('transaksi/reject/{transaksi}', 'TransaksiController@reject')
    ->name('transaksi.reject');

Route::resource('kamar-kos', KamarKosController::class)
    ->except(['show']);

Route::resource('penyewa', PenyewaController::class)
    ->except(['show']);
