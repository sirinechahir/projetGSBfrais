<?php

namespace App\Http\Controllers;
use App\Exceptions\UserException;
use App\Models\Etat;
use App\Models\Frais;
use App\Service\FraisService;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FraisController extends Controller
{
    public function listFrais()
    {
        try {
        $service = new FraisService();
        $id_visiteur = session('id_visiteur');
        $fiches = $service->getListFrais($id_visiteur);
        return view('listFrais', compact('fiches'));
        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }

    }

    public function addFrais()
    {
        try{
            //$service = new FraisService();
            $frais = new Frais();
            $frais->anneemois = date("Y-m");
            $etats= [new Etat()];
            $etats[0]->lib_etat="Création en cours";
        return view('formFrais', compact('frais', 'etats'));}
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }


    }

    public function validFrais(Request $request)
    {
        try {
            $id_frais = $request->input('id');
            if ($id_frais) {
                $service = new FraisService();
                $frais = $service->getFrais($id_frais);
                $frais->id_etat=$request->input('etat');
            } else {
                $frais = new Frais();
                $frais->id_etat=2;
            }
            $frais->id_visiteur = session('id_visiteur');
            $frais->anneemois = $request->input('mois');
            $frais->titre=$request->input('titre');
            $frais->nbjustificatifs = $request->input('nbjustif');
            $frais->montantvalide = $request->input('valide');
            $frais->datemodification = date('Y-m-d');
            $service = new FraisService();
            $service->saveFrais($frais);

            return redirect(url('/listerFrais'));}
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }


    public function editFrais($id)
    {
        try{
            $erreur = Session::get('erreur');
            Session::remove('erreur');
        $service = new FraisService();
        $etats=$service ->getListEtats();
        $frais = $service->getFrais($id);

        return view('formFrais', compact('frais', 'etats', 'erreur'));

        }
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }


    public function removeFrais($id){
        try{
            $service = new FraisService();
            $service->deleteFrais($id);
            return redirect(url('/listerFrais'));
        }
        catch(Exception $exception) {
            if ($exception->getCode() == 23000) {
                Session::put('erreur', $exception->getUserMessage());
                return redirect(url('/editerFrais/'.$id));
            }else{
                return view ('error',compact('exception'));
            }
        }
    }

}


