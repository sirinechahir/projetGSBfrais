<?php

namespace App\Http\Controllers;

use App\Exceptions\UserException;
use App\Models\Formuler;
use App\Models\Medicament;
use App\Service\MedicamentService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
            $fiches = $service->getListFormulation($id);
            $med = $service->getMedicament($id);
            return view('listFormulation', compact('fiches', 'med'));
        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

    public function addForm($id)
    {
        try{
            $form = new Medicament();
            $form->id_medicament=$id;
            return view('formFormulation', compact('form'));}
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

//    public function validForm(Request $request)
//    {
//        try {
//            $service = new MedicamentService();
//
//            $id_med = $request->input('id_medicament');
//            $form = new Formuler();
//
//            $form->id_medicament = $request->input('id_medicament');
//            $form->id_presentation = $request->input('presentation');
//            $form->qte_formuler = $request->input('qteformuler');
//
//            $service->saveForm($form);
//
//            return redirect()->route('listerFormulation', ['id' => $id_med]);
//        } catch (Exception $exception) {
//            return view('error', compact('exception'));
//        }
//    }

    public function validForm(Request $request)
    {
        try {
            $service = new MedicamentService();

            $id_med = $request->input('id_medicament');

            $service->saveForm($request);

            return redirect()->route('listerFormulation', ['id' => $id_med]);
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function editForm($id_medicament, $id_presentation)
    {
        try{
            $erreur = Session::get('erreur');
            Session::remove('erreur');
            $service = new MedicamentService();
            $form =$service ->getOneFormulation($id_medicament, $id_presentation);
            $med = $service->getMedicament($id_medicament);

            return view('formFormulation', compact('form', 'med', 'erreur'));

        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

    public function removeForm($id_medicament, $id_presentation)
    {
        try {
            $service = new MedicamentService();
            $service->deleteForm($id_medicament, $id_presentation);

            return redirect('/listerFormulation/'.$id_medicament);
        }
        catch(Exception $exception) {

            if ($exception->getCode() == 23000) {
                Session::put('erreur', $exception->getUserMessage());
            }

            return redirect('/listerFormulation/'.$id_medicament);
        }
    }




}
