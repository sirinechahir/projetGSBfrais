<?php

use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\VisiteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/visiteur/initpwd', [VisiteurController::class, "initPasswordAPI"]);

Route::post('/visiteur/auth', [VisiteurController::class, "authAPI"]);

Route::get('/visiteur/logout', [VisiteurController::class, "logoutAPI"])->middleware('auth:sanctum');

Route::get('/visiteur/unauthorized', [VisiteurController::class, "unauthorizedAPI"])->middleware('auth:sanctum');

Route::get('/listerMedicament', [MedicamentController::class, 'apiListMed']);

Route::get('/rechercherMedicament', [MedicamentController::class, 'apiSearchMed']);


Route::get('/listerFormulations/{id}', [MedicamentController::class, 'apiListForm']);
Route::post('/validerFormulation', [MedicamentController::class, 'apiSaveForm']);
Route::delete('/supprimerFormulation/{id_med}/{id_pres}', [MedicamentController::class, 'apiDeleteForm']);
