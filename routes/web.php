<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TareaController;
use App\Http\Controllers\ArchivoController;

Route::get('/', function () {
    return view('landing');
});

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Nuevo

Route::middleware(['auth'])->group(function () {
    Route::resource('tareas', TareaController::class);
    Route::post('/tareas/{tarea}/invitar', [TareaController::class, 'invitar'])->name('tareas.invitar');
});

Route::post('/archivos', [ArchivoController::class, 'store'])->name('archivos.store');
Route::delete('/archivos/{archivo}', [ArchivoController::class, 'destroy'])->name('archivos.destroy');


require __DIR__.'/auth.php';
