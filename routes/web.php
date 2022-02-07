<?php

use App\Http\Controllers\Admin\FaturaController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\KalemController;
use App\Http\Controllers\Admin\MusteriController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeController::class, 'index'])->name('admin.dashboard');


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

Route::prefix('banka')->group(function () {
    Route::get('/yeni', [MusteriController::class, 'yeni'])->name('banka.yeni');
    Route::get('/liste', [MusteriController::class, 'liste'])->name('banka.liste');
});



