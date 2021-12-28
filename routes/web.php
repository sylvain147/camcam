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
    Route::get('/dashboard',[appController::class,'songs']);
    Route::get('songs',[appController::class,'songs'])->name('song');
    Route::get('songslist',[appController::class,'songslist'])->name('songlist');
    Route::get('/import',[appController::class,'import'] )->name('import');
    Route::get('/songs/{user}',[appController::class,'selectedSongs'] )->name('selected-songs');
    Route::post('/import-file',[appController::class,'importFile'] )->name('import.file');
    Route::post('/import-ids',[appController::class,'importIds'] )->name('import.ids');
    Route::post('/save-rank',[appController::class,'saveRank'] )->name('save.rank');
    Route::post('/save-song/{song}',[appController::class,'saveSong'])->name('save-song');
    Route::post('/remove-song/{song}',[appController::class,'removeSong'])->name('remove-song');
    Route::get('/my-songs',[appController::class,'mySongs'])->name('my-songs');
    Route::get('/rank',[appController::class,'rank'])->name('my-rank');
    Route::get('/rank2',[appController::class,'rank2'])->name('my-rank2');
});
