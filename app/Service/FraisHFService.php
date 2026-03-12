<?php

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Frais;
use App\Models\FraisHorsForfait;
use Illuminate\Database\QueryException;


use App\Models\Etat;
use function Laravel\Prompts\select;

class FraisHFService
{
    public function getListFraisHF($id)
    {
        try {
            $liste = FraisHorsForfait::query()
                ->select('fraishorsforfait.*', 'frais.id_frais')
                ->join('frais', 'fraishorsforfait.id_frais', '=', 'frais.id_frais')
                ->where('frais.id_frais', '=', $id)
                ->orderBy('date_fraishorsforfait', 'asc')
                ->get();

            //$liste=Frais::query()->where('id_visiteur','=', $id_visiteur)->get();
        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
        return $liste;
    }

    public function getTotalHF($id)
    {
        try {
            $total = FraisHorsForfait::query()->where('id_frais', '=', $id)->sum('montant_fraishorsforfait');
        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
        return $total;
    }

    public function saveFraisHF(FraisHorsForfait $fraisHF)
    {
        $fraisHF->save();
        try {
            $fraisHF = FraisHorsForfait::query()->find($fraisHF);
        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
        return $fraisHF;
    }

    public function getFraisHF($idHF)
    {
        try {
            $fraisHF = Frais::query()->find($idHF);
        } catch (QueryException $exception) {
            $userMessage = "Impossible de lire la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }

        return $fraisHF;
    }
}
