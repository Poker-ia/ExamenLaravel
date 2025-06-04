<?php

use App\Http\Controllers\CursosController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\PlataformasController;
use Illuminate\Support\Facades\Route;

Route::get('/',[InicioController::class, 'index'])->name('inicio.index');

//cursos

Route::get('/cursos',[CursosController::class, 'index'])->name('cursos.index');
Route::post('/cursos',[CursosController::class, 'store'])->name('cursos.store');
Route::delete('/cursos/{cursos}',[CursosController::class, 'destroy'])->name('cursos.destroy');

Route::put('/cursos/{curso}',[CursosController::class, 'update'])->name('cursos.update');


//plataformas
Route::get('/plataformas',[PlataformasController::class, 'index'])->name('plataformas.index');
Route::post('/plataformas',[PlataformasController::class, 'store'])->name('plataformas.store');
Route::delete('/plataformas/{plataformas}',[PlataformasController::class, 'destroy'])->name('plataformas.destroy');
Route::put('/plataformas/{plataforma}',[PlataformasController::class, 'update'])->name('plataformas.update');