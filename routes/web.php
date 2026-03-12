<?php

use App\Http\Controllers\FraisHFController;
use App\Http\Controllers\MedicamentController;
use App\Http\Controllers\VisiteurController;
use App\Http\Controllers\FraisController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('home');
});



Route::get('/connecter', [VisiteurController::class, 'login']);
Route::post('/authentifier', [VisiteurController::class, 'auth']);
Route::get('/deconnecter', [VisiteurController::class, 'logout']);


Route::get('/listerFrais', [FraisController::class, 'listFrais']);
Route::get('/ajouterFrais', [FraisController::class, 'addFrais']);
Route::post('/validerFrais', [FraisController::class, 'validFrais']);
Route::get('/editerFrais/{id}', [FraisController::class, 'editFrais']);
Route::get('/supprimerFrais/{id}', [FraisController::class, 'removeFrais']);

Route::get('/listerFraisHF/{id}', [FraisHFController::class, 'listFraisHF'])->name('listerFraisHF');
Route::get('/ajouterFraisHF/{id}', [FraisHFController::class, 'addFraisHF'])->name('addFraisHF');
Route::post('/validerFraisHF', [FraisHFController::class, 'validFraisHF'])->name('validFraisHF');
Route::get('/editerFraisHF/{idHF}', [FraisHFController::class, 'editFraisHF'])->name('editFraisHF');

//Mission
Route::get('/listerMedicament', [MedicamentController::class, 'listMed'])->name('listerMedicament');


Route::get('/rechercherMedoc', [MedicamentController::class, 'searchMed']);//->name('rechercherMedoc');
Route::post('/validerMedicament', [MedicamentController::class, 'validMedicament'])->name('validerMedicament');

Route::get('/listerFormulation/{id}', [MedicamentController::class, 'listForm'])->name('listerFormulation');







