<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ModulerController;
use App\Http\Controllers\AdminYonetim;


Route::get('/', function ()
{
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/yonetim', [AdminYonetim::class,'home'])->name('home');
Route::get('/yonetim/moduler', [ModulerController::class, "index"])->name('moduler');
Route::post('/yonetim/modul-ekle',[ModulerController::class,"modulekle"])->name('modul-ekle');
Route::get('/yonetim/liste/{modul}', [AdminYonetim::class, "liste"])->name('liste');
Route::get('/yonetim/ekle/{modul}', [AdminYonetim::class, "ekle"])->name('ekle');
Route::post('/yonetim/ekle-post/{modul}', [AdminYonetim::class, "eklePost"])->name('eklePost');