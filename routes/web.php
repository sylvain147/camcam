<?php

use App\Http\Controllers\appController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('/',[appController::class,'songs']);
    Route::get('songs',[appController::class,'songs'])->name('song');
    Route::get('songslist',[appController::class,'songslist'])->name('songlist');
    Route::get('/import',[appController::class,'import'] )->name('import');
    Route::post('/import-file',[appController::class,'importFile'] )->name('import.file');
    Route::post('/save-song/{song}',[appController::class,'saveSong'])->name('save-song');
    Route::post('/remove-song/{song}',[appController::class,'removeSong'])->name('remove-song');
    Route::get('/my-songs',[appController::class,'mySongs'])->name('my-songs');
});
