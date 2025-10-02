<?php

namespace App\Http\Controllers;
use App\Exceptions\UserException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Service\VisiteurService;

class VisiteurController extends Controller
{
    public function login()
    {
        try{
            return view('connecter');

        } catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

    public function logout()
    {
        try {
        $visiteur = new VisiteurService();
        $visiteur->signOut();
        return view('home');}
        catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }

    public function auth(Request $request){
        try {
        $login = $request->input('login');
        $pwd = $request->input('pwd');

        $service =new VisiteurService();
        if ($service->signIn($login,$pwd)){
            return view('home');
        } else {
            $erreur = "Idenfiant ou mot de passe incorrect";
            return view('connecter',compact('erreur'));
        }
        } catch(Exception $exception) {
            return view ('error',compact('exception'));
        }
    }
}
