<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JuegoController;

Route::get('/juego', [JuegoController::class, 'inicio'])->name('juego.inicio');
Route::post('/juego/guardar', [JuegoController::class, 'guardarResultado']);
Route::get('/historial', [JuegoController::class, 'mostrarHistorial']);

Route::redirect('/', '/juego');