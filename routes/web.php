<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LogActivityController;


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
})->name('welcome');

Route::view('form','form')->name('form');
Route::post('form', function(Request $request) {
    $request->validate([
        'nama' => 'required',
        'alamat' => 'required',
        'jk' => 'required'
    ], [], [
        'jk' => 'jenis_kelamin'
    ]);
});

Route::view('list', 'list')->name('list');
Route::delete('list/{list}', function(){
return 'Telah dihapus';
})->name('list.delete');

Route::middleware(['guest'])->group(function(){
    Route::view('/','welcome')->name('welcome');
    Route::get('login',[AuthController::class,'loginForm'])->name('login');
    Route::post('login',[AuthController::class,'login']);
});

Route::middleware(['auth'])->group(function(){
    Route::view('home','home.dashboard')->name('home');
    Route::post('logout',[AuthController::class,'logout'])->name('logout');


    Route::middleware(['can:role, "admin", "manajer"'])->group(function () {
        Route::get('log', [LogActivityController::class, 'index'])->name('log');
});
Route::middleware(['can:admin'])->group(function () {
    Route::delete('log', [LogActivityController::class, 'clear'])->name('log.clear');
    Route::resource('user', UserController::class);
});

Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('profile/edit', [ProfileController::class, 'edit'])->name(' profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['can:manajer'])->group(function () {
    Route::resource('menu', MenuController::class);

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::post('laporan/harian', [LaporanController::class, 'laporanHarian'])->name('laporan.harian');
    Route::post('laporan/perbulan', [LaporanController::class, 'laporanPerbulan'])->name('laporan.perbulan');
});

Route::middleware(['can:kasir'])->group(function () {
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('cart/{menu}/add', [CartController::class, 'add'])->name('cart.add');
    Route::get('cart/{id}/{type}/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('cart/destroy', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::post('cart', [CartController::class, 'store'])->name('cart.store');
  });
  Route::middleware(['can:role, "kasir", "manajer"'])->group(function () {
    Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('transaksi/{transaksi}', [TransaksiController::class, 'show'])->name('transaksi.show');
    Route::get('transaksi/{transaksi}/status', [TransaksiController::class, 'status'])->name('transaksi.status');
    Route::get('transaksi/{transaksi}/cetak', [TransaksiController::class, 'cetak'])->name('transaksi.cetak');
});



// });
// Route::view('log', 'log_activity.index')->name('log');
// Route::get('log', function(){
//     $data = \App\Models\LogActivity::all();
//     return view('log_activity.index', [
//     'data'=>$data,
//     ]);
// })->name('log');
