<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulerController;
use App\Http\Controllers\AdminYonetim;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
});
Route::middleware(['auth:sanctum','verified'])->prefix('yonetim')->group(function(){
    Route::get('/',[AdminYonetim::class,'home'])->name('home');
    Route::get('/moduler',[ModulController::class,'index'])->name('moduler');
    Route::post('/modul-ekle',[ModulController::class,'modulekle'])->name('modul-ekle');
    Route::get('/liste/{modul}',[AdminYonetim::class,'liste'])->name('liste');
    Route::get('/ekle/{modul}',[AdminYonetim::class,'ekle'])->name('ekle');
    Route::post('/ekle-post/{modul}',[AdminYonetim::class,'eklePost'])->name('eklepost');
    Route::get('/duzenle/{modul}/{id}',[AdminYonetim::class,'duzenle'])->name('duzenle');
    Route::post('/duzenle-post/{modul}/{id}',[AdminYonetim::class,'duzenlePost'])->name('duzenlepost');
    Route::get('/sil/{modul}/{id}',[AdminYonetim::class,'sil'])->name('sil');
    Route::get('/durum/{modul}/{id}',[AdminYonetim::class,'durum'])->name('durum');
    Route::get('/ayarlar',[AdminYonetim::class,'ayarlar'])->name('ayarlar');
    Route::post('/ayarpost',[AdminYonetim::class,'ayarpost'])->name('ayarpost');
});
