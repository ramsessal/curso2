<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/avisos', [PostController::class, 'index'])->name('avisos.index');
Route::get('/avisos/create', [PostController::class, 'create'])->name('avisos.create');
Route::get('/avisos/crear', [PostController::class, 'create']);
Route::post('/avisos', [PostController::class, 'store'])->name('avisos.store');
Route::get('/avisos/{post}/editar', [PostController::class, 'edit'])->name('avisos.edit');
Route::put('/avisos/{post}', [PostController::class, 'update'])->name('avisos.update');

Route::get('/contacto', fn () => view('contacto'));
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'entrar'])->name('login.entrar');
Route::post('/logout', [LoginController::class, 'salir'])->name('logout');
