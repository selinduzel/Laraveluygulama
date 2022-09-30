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

Route::get('/yonetim', [AdminYonetim::class,'home']);
Route::get('/yonetim/moduler', [App\Http\Controllers\ModulerController::class, "index"])->name('moduler');
Route::post('/yonetim/modul-ekle',[ModulerController::class,"modulekle"])->name('modul-ekle');