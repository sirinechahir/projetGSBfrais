<?php

namespace App\Http\Controllers;

use App\Service\MedicamentService;
use Exception;
use Illuminate\Http\Request;

class MedicamentController
{
    public function searchMed()
    {
        try {

            return view('formMedicament');
        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

    public function listMed()
    {
        try {
            $service = new MedicamentService();
            $fiches = $service->getListMedicament();
            return view('listMedicament', compact('fiches'));
        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }

    }

    public function validMedicament(Request $request)
    {
        try {
            $recherche = $request->input('recherchemedicament');
            $service = new MedicamentService();

            $fiches = $service->getMedicamentParNomFamille($recherche);

            return view('listMedicament', compact('fiches'));
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function listForm($id)
    {
        try {
            $service = new MedicamentService();
            $fiches = $service->getListFormulation();
            $med = $service->getMedicament($id);
            return view('listFormulation', compact('fiches', 'med'));
        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }

    }
}
