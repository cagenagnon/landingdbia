<?php

use App\Http\Controllers\AdminInscriptionController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landing');
Route::get('/admin/inscriptions', [AdminInscriptionController::class, 'dashboard']);
