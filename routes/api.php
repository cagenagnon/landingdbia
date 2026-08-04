<?php

use App\Http\Controllers\AdminInscriptionController;
use App\Http\Controllers\BootcampCandidatureController;
use App\Http\Controllers\WebinaireInscriptionController;
use Illuminate\Support\Facades\Route;

Route::post('/webinaire/inscriptions', [WebinaireInscriptionController::class, 'store']);
Route::post('/bootcamp/candidatures', [BootcampCandidatureController::class, 'store']);

Route::prefix('/admin/inscriptions')->group(function (): void {
	Route::get('/webinaire', [AdminInscriptionController::class, 'webinaire']);
	Route::get('/bootcamp', [AdminInscriptionController::class, 'bootcamp']);
	Route::get('/webinaire/export', [AdminInscriptionController::class, 'exportWebinaireCsv']);
	Route::get('/bootcamp/export', [AdminInscriptionController::class, 'exportBootcampCsv']);
});
