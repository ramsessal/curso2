<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

Route::get('/login', [AuthController::class, 'mostrar'])->name('login');
Route::post('/login', [AuthController::class, 'entrar'])->name('auth.entrar');
Route::post('/logout', [AuthController::class, 'salir'])->name('logout');



Route::get('/', [PostController::class, 'index'])->name('avisos.index');

Route::middleware('auth')->group(function () {
    Route::get('/avisos/crear', [PostController::class, 'create'])->name('avisos.create');
    Route::post('/avisos', [PostController::class, 'store'])->name('avisos.store');
    Route::get('/avisos/{post}/editar', [PostController::class, 'edit'])->name('avisos.edit')->can('update', 'post');
    Route::put('/avisos/{post}', [PostController::class, 'update'])->name('avisos.update')->can('update', 'post');
    Route::delete('/avisos/{post}', [PostController::class, 'destroy'])->name('avisos.destroy')->can('delete', 'post');
});

Route::get('/contacto', fn () => view('contacto'));

