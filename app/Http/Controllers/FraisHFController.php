<?php

namespace App\Http\Controllers;

use App\Models\Etat;
use App\Models\Frais;
use App\Models\FraisHorsForfait;
use App\Service\FraisHFService;
use App\Service\FraisService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FraisHFController extends Controller
{
    public function listFraisHF($id)
    {
        try {
            $service = new FraisService();
            $frais = $service->getFrais($id);

            $serviceHF = new FraisHFService();
            $listeHF = $serviceHF->getListFraisHF($id);
            $totalHF=$serviceHF->getTotalHF($id);

            return view('listFraisHF', compact('frais', 'listeHF', 'totalHF'));
        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }

    }

    public function addFraisHF($id)
    {
        try{
            $fraisHF = new FraisHorsForfait();
            $fraisHF->id_frais=$id;
            return view('formFraisHF', compact('fraisHF'));}
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

    public function validFraisHF(Request $request)
    {
        try {
            $id = $request->input('id');
            $idHF = $request->input('idHF');
            $serviceHF = new FraisHFService();
            if ($idHF) {
                $fraisHF = $serviceHF->getFraisHF($idHF);
            } else {
                $fraisHF = new FraisHorsForfait();
                $fraisHF->id_frais = $id;
            }

            $fraisHF->date_fraishorsforfait = $request->input('date');
            $fraisHF->lib_fraishorsforfait = $request->input('titre');
            $fraisHF->montant_fraishorsforfait = $request->input('montant');

            if ($request->has('etat')) {
                $fraisHF->id_etat = $request->input('etat');
            }
            $serviceHF->saveFraisHF($fraisHF);

            return redirect()->route('listerFraisHF', ['id' => $id]);
        } catch (Exception $exception) {
            return view('error', compact('exception'));
        }
    }

    public function editFraisHF($idHF)
    {
        try{
            //$erreur = Session::get('erreur');
            //Session::remove('erreur');
            $service = new FraisHFService();
            //$etats=$service ->getListEtats();
            $fraisHF = $service->getFraisHF($idHF);

            return view('formFraisHF', compact('fraisHF'));

        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

}
