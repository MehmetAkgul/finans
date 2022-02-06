<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\MusteriController;
use Illuminate\Support\Facades\Route;




    Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');


        Route::resource('/musteriler', MusteriController::class)->names('musteriler');



    Route::prefix('kalem')->group(function () {
        Route::get('/yeni', [MusteriController::class, 'yeni'])->name('kalem.yeni');
        Route::get('/liste', [MusteriController::class, 'liste'])->name('kalem.liste');
    });

    Route::prefix('islem')->group(function () {
        Route::get('/odeme', [MusteriController::class, 'odeme'])->name('islem.odeme');
        Route::get('/tahsilat', [MusteriController::class, 'tahsilat'])->name('islem.tahsilat');
        Route::get('/liste', [MusteriController::class, 'liste'])->name('islem.liste');
    });

    Route::prefix('fatura')->group(function () {
        Route::get('/gelir', [MusteriController::class, 'gelir'])->name('fatura.gelir');
        Route::get('/gider', [MusteriController::class, 'gider'])->name('fatura.gider');
        Route::get('/liste', [MusteriController::class, 'liste'])->name('fatura.liste');
    });

    Route::prefix('banka')->group(function () {
        Route::get('/yeni', [MusteriController::class, 'yeni'])->name('banka.yeni');
        Route::get('/liste', [MusteriController::class, 'liste'])->name('banka.liste');
    });



