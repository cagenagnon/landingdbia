<?php

use App\Http\Controllers\AdminInscriptionController;
use App\Http\Controllers\AdminAccessController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
Route::get('/admin/login', [AdminAccessController::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AdminAccessController::class, 'store'])
	->middleware('throttle:admin-login')
	->name('admin.login.store');
Route::post('/admin/logout', [AdminAccessController::class, 'destroy'])
	->middleware('admin.access')
	->name('admin.logout');
Route::get('/admin/inscriptions', [AdminInscriptionController::class, 'dashboard'])
	->middleware('admin.access')
	->name('admin.dashboard');
