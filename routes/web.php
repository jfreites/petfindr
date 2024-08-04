<?php

use App\Http\Controllers\PetController;
use Illuminate\Support\Facades\Route;

Route::get('/example', function () {
    return view('example');
});

Route::get('/', function () {
    return view('home');
});

Route::get('/perdi-mi-mascota', function () {
    return view('pet.report-lost');
})->name('pet.report.lost');

Route::get('/encontre-una-mascota', function () {
    return view('pet.report-found');
})->name('pet.report.found');

Route::get('/pet/search', [PetController::class, 'index'])->name('pet.search');
Route::post('/pet/report', [PetController::class, 'store'])->name('pet.report.store');
Route::post('/pet/report/found', [PetController::class, 'storeFound'])->name('pet.report.found.store');
Route::get('/pet/{pet}/details', [PetController::class, 'reportDetails'])->name('pet.report.details');
