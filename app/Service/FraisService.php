<?php

namespace App\Service;
use App\Exceptions\UserException;
use App\Models\Frais;
use Illuminate\Database\QueryException;

class FraisService
{
    public function getListFrais($id_visiteur){
        try{
            $liste=Frais::query()->where('id_visiteur','=', $id_visiteur)->get();
        } catch(QueryException $exception) {
            $userMessage="Impossible d'accéder à la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
        return $liste;
    }

    public function saveFrais($frais){
        $frais->save();
        try {
            $frais=Frais::query()->find($frais);
        }catch(QueryException $exception) {
            $userMessage="Impossible d'accéder à la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
        return $frais;
    }

    public function getFrais($id){
        try{
        $frais=Frais::query()->find($id);}
        catch(QueryException $exception) {
            $userMessage="Impossible de lire la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }

        return $frais;
    }


    public function getListEtats(){
        return Frais::query()->get();
    }

}
