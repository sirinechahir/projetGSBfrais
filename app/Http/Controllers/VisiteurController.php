<?php

namespace App\Http\Controllers;

class VisiteurController extends Controller
{
    public function login()
    {
        return view('connecter');
    }


    public function auth(Request $request){
        $login = $request->input('login');
        $pwd = $request->input('pwd');

        $service =new VisiteurService();
        if ($service->signIn($login,$pwd)){
            return redirect(route('homme'));
        } else {
            $erreur = "Idenfiant ou mot de passe incorrect";
            return view('connecter',compact('erreur'));
        }
    }
}
