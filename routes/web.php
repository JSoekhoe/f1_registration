<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// routes/web.php

Route::middleware('auth')->group(function () {
    Route::get('/laps', [\App\Http\Controllers\LapsController::class, 'index'])->name('laps.index');
    Route::get('/laps/create', [\App\Http\Controllers\LapsController::class, 'create'])->name('laps.create');
    Route::post('/laps/store', [\App\Http\Controllers\LapsController::class, 'store'])->name('laps.store');
    Route::get('/laps/edit', [\App\Http\Controllers\LapsController::class, 'edit'])->name('laps.edit');
    Route::put('/laps/update', [\App\Http\Controllers\LapsController::class, 'update'])->name('laps.update');
    Route::delete('/laps/destroy', [\App\Http\Controllers\LapsController::class, 'destroy'])->name('laps.destroy');
});

require __DIR__.'/auth.php';
