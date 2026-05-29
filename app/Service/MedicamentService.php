<?php

//use App\Exceptions\UserException;
//use Illuminate\Database\QueryException;
//use App\Models\Medicament;

namespace App\Service;

use App\Exceptions\UserException;
use App\Models\Formuler;
use App\Models\Medicament;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Session;

//,'formuler.qte_formuler', 'presentation.lib_presentation'

class MedicamentService
{
    public function getListMedicament()
    {
        try {
            $liste = Medicament::query()
                ->select('medicament.*', 'famille.lib_famille' )
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

    public function getListFormulation($id)
    {
        try {
//            $liste = Medicament::query()
            $liste = Formuler::query()

                ->select(
                    'formuler.id_medicament',
                    'formuler.id_presentation',
                    'formuler.qte_formuler',
                    'presentation.lib_presentation',
                    'medicament.nom_commercial'
                )
                ->join('presentation', 'formuler.id_presentation', '=', 'presentation.id_presentation')
                ->join('medicament', 'formuler.id_medicament', '=', 'medicament.id_medicament')
                ->where('formuler.id_medicament', '=', $id)
                ->get();

//                ->select('medicament.nom_commercial', 'famille.lib_famille','formuler.qte_formuler', 'presentation.lib_presentation' )
//                ->join('famille', 'famille.id_famille', '=', 'medicament.id_famille')
//                ->join('formuler', 'formuler.id_medicament', '=', 'medicament.id_medicament')
//                ->join('presentation',  'formuler.id_presentation', '=', 'presentation.id_presentation')
//                ->where('medicament.id_medicament', '=', $id)
//                ->distinct()
//                ->get();

            return $liste;

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

    public function getOneFormulation($id_med, $id_pres)
    {
        try {
            $form = Formuler::where('id_medicament', $id_med)
                ->where('id_presentation', $id_pres)
                ->first();

            return $form;
        } catch (QueryException $exception) {
            throw new UserException("Impossible de charger la formulation", $exception->getMessage(), $exception->getCode());
        }
    }


    public function saveForm($request)
    {
        try {
            $id_med = $request->input('id_medicament');
            $id_pres_nouveau = $request->input('presentation');
            $qte = $request->input('qteformuler');

            $id_pres_ancien = $request->input('id_presentation_old');

            if ($id_pres_ancien) {
                // --- BLOC MODIFICATION ---

                // Si l'utilisateur change de présentation (ex: il passe de 5 à 6)
                if ($id_pres_ancien != $id_pres_nouveau) {
                    // On vérifie si la nouvelle présentation (le 6) existe déjà pour ce médicament
                    $existeDeja = Formuler::where('id_medicament', $id_med)
                        ->where('id_presentation', $id_pres_nouveau)
                        ->exists();

                    if ($existeDeja) {
                        throw new UserException(
                            "Impossible de modifier : cette présentation est déjà associée à ce médicament.",
                            "Duplicate entry detected on update",
                            23000
                        );
                    }
                }

                // Si ce n'est pas un doublon (ou s'il modifie juste la quantité sans changer d'ID), on met à jour
                return Formuler::where('id_medicament', $id_med)
                    ->where('id_presentation', $id_pres_ancien)
                    ->update([
                        'id_presentation' => $id_pres_nouveau,
                        'qte_formuler'    => $qte,
                    ]);

            } else {
                // --- BLOC AJOUT ---
                $existeDeja = Formuler::where('id_medicament', $id_med)
                    ->where('id_presentation', $id_pres_nouveau)
                    ->exists();

                if ($existeDeja) {
                    throw new UserException(
                        "Cette présentation est déjà associée à ce médicament.",
                        "Duplicate entry detected on insert",
                        23000
                    );
                }

                return Formuler::insert([
                    'id_medicament'   => $id_med,
                    'id_presentation' => $id_pres_nouveau,
                    'qte_formuler'    => $qte,
                ]);
            }
        } catch (QueryException $exception) {
            $userMessage = "Erreur lors de l'accès à la base de données";
            throw new UserException($userMessage, $exception->getMessage(), $exception->getCode());
        }
    }

    public function deleteForm($id_medicament, $id_presentation)
    {
        try {

            $deleted = Formuler::where('id_medicament', $id_medicament)
                ->where('id_presentation', $id_presentation)
                ->delete();

            if ($deleted === 0) {
                throw new Exception("Aucune formulation trouvée pour ces identifiants.");
            }
        }
        catch (QueryException $exception) {

            if ($exception->getCode() == 23000) {
                $userMessage = "Impossible de supprimer une fiche avec des frais saisis";
            } else {
                $userMessage = "Erreur de suppression dans la base de données";
            }

            throw new UserException(
                $userMessage,
                $exception->getMessage(),
                $exception->getCode()
            );
        }
    }

}
