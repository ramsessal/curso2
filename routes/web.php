<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('avisos.index'))->name('home');

Route::get('/avisos', [PostController::class, 'index'])->name('avisos.index');

Route::get('/contacto', fn () => view('contacto'));

Route::get('/avisos/crear', [PostController::class, 'create'])->name('avisos.create');
Route::post('/avisos', [PostController::class, 'store'])->name('avisos.store');

Route::get('/avisos/{post}/editar', [PostController::class, 'edit'])->name('avisos.edit');
Route::put('/avisos/{post}', [PostController::class, 'update'])->name('avisos.update');

Route::get('/contacto', fn () => view('contacto'))->name('contacto');
Route::post('/contacto', fn () => redirect()->route('contacto')->with('ok', 'Mensaje enviado'))->name('contacto.store');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'entrar'])->name('login.entrar');
Route::post('/logout', [LoginController::class, 'salir'])->name('logout');
