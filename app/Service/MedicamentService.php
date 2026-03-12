<?php

//use App\Exceptions\UserException;
//use Illuminate\Database\QueryException;
//use App\Models\Medicament;

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Medicament;
use Illuminate\Database\QueryException;

class MedicamentService
{
    public function getListMedicament()
    {
        try {
            $liste = Medicament::query()
                ->select('medicament.*', 'famille.lib_famille','formuler.qte_formuler', 'presentation.lib_presentation' )
                ->join('famille', 'famille.id_famille', '=', 'medicament.id_famille')
                ->join('formuler', 'formuler.id_medicament', '=', 'medicament.id_medicament')
                ->join('presentation',  'formuler.id_presentation', '=', 'presentation.id_presentation')
                ->distinct()
                ->get();

        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
        return $liste;
    }

    public function getMedicamentParNomFamille($recherche)
    {
        try {
            $recherche = Medicament::query()
                ->select('depot_legal', 'nom_commercial', 'effets', 'contre_indication', 'prix_echantillon', 'famille.lib_famille', 'formuler.qte_formuler',
                'presentation.lib_presentation')
                ->join('famille', 'medicament.id_famille', '=', 'famille.id_famille')
                ->join('formuler', 'formuler.id_medicament', '=', 'medicament.id_medicament')
                ->join('presentation',  'formuler.id_presentation', '=', 'presentation.id_presentation')
                ->where('famille.lib_famille', 'like', '%' . $recherche . '%')
                ->orwhere('medicament.nom_commercial', 'like', '%' . $recherche . '%')
                ->get();
            return $recherche;
        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de données.";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function getListFormulation()
    {
        try {
            $liste = Medicament::query()
                ->select('medicament.nom_commercial', 'famille.lib_famille','formuler.qte_formuler', 'presentation.lib_presentation' )
                ->join('famille', 'famille.id_famille', '=', 'medicament.id_famille')
                ->join('formuler', 'formuler.id_medicament', '=', 'medicament.id_medicament')
                ->join('presentation',  'formuler.id_presentation', '=', 'presentation.id_presentation')
                ->distinct()
                ->get();

        } catch (QueryException $exception) {
            $userMessage = "Impossible d'accéder à la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
        return $liste;
    }

    public function getMedicament($id)
    {
        try {
            $med = Medicament::query()->find($id);
        } catch (QueryException $exception) {
            $userMessage = "Impossible de lire la base de donnée";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }

        return $med;
    }
}
