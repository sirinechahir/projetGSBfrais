<?php

namespace App\Service;

class VisiteurService extends Service
{
    public function signIn($login,$pwd){
        $visiteur=Visiteur::query()->where('login',$login)->first();

        if($visiteur && $visiteur->pwd_visiteur==$pwd){
            Session::put('id_visiteur',$visiteur->id_visiteur);
            return true;
        }
        return false;
    }
}
