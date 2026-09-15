<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ClinicSettingController;
use App\Http\Controllers\AgendaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'site.home')->name('site.home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->group(function () {
    Route::get('/painel', [DashboardController::class, 'index'])->name('painel.index');
    Route::resource('pacientes', PatientController::class)->except(['show']);
    Route::get('/contatos', [ContactController::class, 'index'])->name('contatos.index');
    Route::patch('/contatos/{contact}/responder', [ContactController::class, 'toggle'])->name('contatos.toggle');
    Route::get('/configuracoes', [ClinicSettingController::class, 'edit'])->name('configuracoes.edit');
    Route::put('/configuracoes', [ClinicSettingController::class, 'update'])->name('configuracoes.update');
    Route::get('/agenda', [AgendaController::class, 'index'])->name('agenda.index');
});

require __DIR__ . '/auth.php';
