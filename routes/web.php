<?php

use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Master\BarangController;
use App\Http\Controllers\Master\SatuanController;
use App\Http\Controllers\Master\SupplierController;
use App\Http\Controllers\Master\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Transaksi\BarangMasukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::controller(BarangController::class)->group(function () {
    Route::get('/barang', 'index')->name('barang.index');
    Route::get('/barang/create', 'create')->name('barang.create');
    Route::post('/barang', 'store')->name('barang.store');
    Route::get('/barang/{id}', 'show')->name('barang.view');
    Route::delete('/barang/{id}', 'destroy')->name('barang.destroy');
    Route::get('/barang/{id}/edit', 'edit')->name('barang.edit');
    Route::put('/barang/{id}', 'update')->name('barang.update');
});

// supplier
Route::prefix('supplier')->controller(SupplierController::class)->group(function () {
    Route::get('/', 'index')->name('supplier.index');
    Route::get('/create', 'create')->name('supplier.create');
    Route::post('/', 'store')->name('supplier.store');
    Route::get('/{id}', 'show')->name('supplier.view');
    Route::get('/{id}/edit', 'edit')->name('supplier.edit');
    Route::put('/{id}', 'update')->name('supplier.update');
    Route::delete('/{id}', 'destroy')->name('supplier.destroy');
});

//satuan
Route::prefix('satuan')->controller(\App\Http\Controllers\Master\SatuanController::class)->group(function () {
    Route::get('/', 'index')->name('satuan.index');
    Route::get('/create', 'create')->name('satuan.create');
    Route::post('/', 'store')->name('satuan.store');
    Route::get('/{id}', 'show')->name('satuan.view');
    Route::get('/{id}/edit', 'edit')->name('satuan.edit');
    Route::put('/{id}', 'update')->name('satuan.update');
    Route::delete('/{id}', 'destroy')->name('satuan.destroy');
    Route::get('/{id}/delete', 'destroy')->name('satuan.delete');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // barang keluar
    Route::get('/barang-keluar', [BarangKeluarController::class, 'index'])->name('barang-keluar.index');
    Route::get('/barang-keluar/create', [BarangKeluarController::class, 'create'])->name('barang-keluar.create');
    Route::post('/barang-keluar/store', [BarangKeluarController::class, 'store'])->name('barang-keluar.store');
    Route::get('/barang-keluar/{id}/view', [BarangKeluarController::class, 'show'])->name('barang-keluar.view');
    Route::get('/barang-keluar/{id}/edit', [BarangKeluarController::class, 'edit'])->name('barang-keluar.edit');
    Route::post('/barang-keluar/{id}', [BarangKeluarController::class, 'update'])->name('barang-keluar.update');
    Route::delete('/barang-keluar/{id}', [BarangKeluarController::class, 'destroy'])->name('barang-keluar.delete');
    Route::get('/barang/{id}/stock', [BarangController::class, 'getStock']);

    // barang masuk
    Route::get('/barang-masuk', [BarangMasukController::class, 'index'])->name('barang-masuk.index');
    Route::get('/barang-masuk/create', [BarangMasukController::class, 'create'])->name('barang-masuk.create');
    Route::post('/barang-masuk/store', [BarangMasukController::class, 'store'])->name('barang-masuk.store');
    Route::get('/barang-masuk/{id}', [BarangMasukController::class, 'show'])->name('barang-masuk.view');
    Route::get('/barang-masuk/{id}/edit', [BarangMasukController::class, 'edit'])->name('barang-masuk.edit');
    Route::put('/barang-masuk/{id}', [BarangMasukController::class, 'update'])->name('barang-masuk.update');
    Route::delete('/barang-masuk/{id}', [BarangMasukController::class, 'destroy'])->name('barang-masuk.delete');

    // master
    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::get('/user/view/{id}', [UserController::class, 'show'])->name('user.show');
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
});



require __DIR__ . '/auth.php';
