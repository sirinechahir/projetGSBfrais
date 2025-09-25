<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Service\VisiteurService;

class VisiteurController extends Controller
{
    public function login()
    {
        return view('connecter');
    }

    public function logout()
    {
        $visiteur = new VisiteurService();
        $visiteur->signOut();
        return view('home');
    }

    public function auth(Request $request){
        $login = $request->input('login');
        $pwd = $request->input('pwd');

        $service =new VisiteurService();
        if ($service->signIn($login,$pwd)){
            return view('home');
        } else {
            $erreur = "Idenfiant ou mot de passe incorrect";
            return view('connecter',compact('erreur'));
        }
    }
}
