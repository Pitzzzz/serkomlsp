<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');

Route::view('/tentang', 'tentang')->name('tentang');

Route::get('/kontak', [ContactController::class, 'show'])->name('kontak');
Route::post('/kontak', [ContactController::class, 'store'])->name('kontak.store');

Route::get('/produk', [ProductController::class, 'index'])->name('produk');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri');

Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel');
Route::get('/artikel/{article}', [ArticleController::class, 'show'])->name('artikel.show');

Route::get('/konsultasi', [ConsultationController::class, 'create'])->name('konsultasi');
Route::post('/konsultasi', [ConsultationController::class, 'store'])->name('konsultasi.store');
