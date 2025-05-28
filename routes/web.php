<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Galeri
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri.show');
    Route::get('/galeri/form', [GaleriController::class, 'form'])->name('galeri.form');
    Route::post('/galeri/save', [GaleriController::class, 'save'])->name('galeri.store');
    Route::post('/galeri/save/{galeri}', [GaleriController::class, 'save'])->name('galeri.update');
    Route::post('/galeri/delete', [GaleriController::class, 'destroyMultiple'])->name('galeri.delete');
    // Berita
    Route::get('/berita', [BeritaController::class, 'index'])->name('berita.show');
    Route::get('/berita/form', [BeritaController::class, 'form'])->name('berita.form');
    Route::post('/berita/save', [BeritaController::class, 'save'])->name('berita.store');
    Route::post('/berita/save/{berita}', [BeritaController::class, 'save'])->name('berita.update');
    Route::post('/berita/delete', [BeritaController::class, 'destroy'])->name('berita.delete');

});

require __DIR__.'/auth.php';
