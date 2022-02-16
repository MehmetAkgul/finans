<?php

use App\Http\Controllers\Admin\BankaController;
use App\Http\Controllers\Admin\FaturaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\IslemController;
use App\Http\Controllers\Admin\KalemController;
use App\Http\Controllers\Admin\MusteriController;
use App\Http\Controllers\Admin\ProfilController;
use Illuminate\Support\Facades\Route;


require __DIR__ . '/auth.php';

Route::middleware('auth')->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');


    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/index', [ProfilController::class, 'index'])->name('index');
    });

    Route::prefix('musteriler')->name('musteriler.')->group(function () {
        Route::get('/index', [MusteriController::class, 'index'])->name('index');
        Route::get('/create', [MusteriController::class, 'create'])->name('create');
        Route::post('/store', [MusteriController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [MusteriController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [MusteriController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [MusteriController::class, 'delete'])->name('delete');
        Route::post('/data', [MusteriController::class, 'data'])->name('data');
    });

    Route::prefix('kalem')->name('kalem.')->group(function () {
        Route::get('/index', [KalemController::class, 'index'])->name('index');
        Route::get('/create', [KalemController::class, 'create'])->name('create');
        Route::post('/store', [KalemController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [KalemController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [KalemController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [KalemController::class, 'delete'])->name('delete');
        Route::post('/data', [KalemController::class, 'data'])->name('data');
    });

    Route::prefix('islem')->group(function () {
        Route::get('/odeme', [MusteriController::class, 'odeme'])->name('islem.odeme');
        Route::get('/tahsilat', [MusteriController::class, 'tahsilat'])->name('islem.tahsilat');
        Route::get('/liste', [MusteriController::class, 'liste'])->name('islem.liste');
    });

    Route::prefix('fatura')->name('fatura.')->group(function () {
        Route::get('/index', [FaturaController::class, 'index'])->name('index');
        Route::get('/create/{type}', [FaturaController::class, 'create'])->name('create');
        Route::post('/store/{type}', [FaturaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [FaturaController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [FaturaController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [FaturaController::class, 'delete'])->name('delete');
        Route::post('/data', [FaturaController::class, 'data'])->name('data');
    });

    Route::prefix('banka')->name('banka.')->group(function () {
        Route::get('/index', [BankaController::class, 'index'])->name('index');
        Route::get('/create', [BankaController::class, 'create'])->name('create');
        Route::post('/store', [BankaController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BankaController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [BankaController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [BankaController::class, 'delete'])->name('delete');
        Route::post('/data', [BankaController::class, 'data'])->name('data');
    });


    Route::prefix('islem')->name('islem.')->group(function () {
        Route::get('/index', [IslemController::class, 'index'])->name('index');
        Route::get('/create/{type}', [IslemController::class, 'create'])->name('create');
        Route::post('/store', [IslemController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [IslemController::class, 'edit'])->name('edit');
        Route::post('/update/{id}', [IslemController::class, 'update'])->name('update');
        Route::get('/delete/{id}', [IslemController::class, 'delete'])->name('delete');
        Route::post('/data', [IslemController::class, 'data'])->name('data');
    });


});


