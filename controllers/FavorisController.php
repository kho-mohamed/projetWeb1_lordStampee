<?php
namespace App\Controllers;

use App\Providers\Validator;
use App\Providers\View;
use App\Models\Timbre;
use App\Models\Couleurs;
use App\Models\Pays;
use App\Models\Condition;
use App\Models\Image;
use App\Models\Enchere;
use App\Models\Favoris;


class FavorisController
{

    public function insert($data)
    {
        // if pour session existe?

        $validator = new Validator;
        $validator->field('membre_id', $data['membre_id'])->required();
        $validator->field('enchere_id', $data['enchere_id'])->required();

        $enchere = new Enchere;
        $enchereSelect = $enchere->selectId($data['enchere_id']);
        $timbre = new Timbre;
        $timbreSelect = $timbre->selectId($enchereSelect['timbreId']);
        $couleurs = new Couleurs;
        $couleursSelect = $couleurs->selectId($timbreSelect['couleursId']);
        $pays = new Pays;
        $paysSelect = $pays->selectId($timbreSelect['paysId']);
        $condition = new Condition;
        $conditionSelect = $condition->selectId($timbreSelect['conditionId']);
        $image = new Image;
        $imageSelect = $image->selectWhere("timbreId", $timbreSelect['id']);

        if ($validator->isSuccess()) {

            $favoris = new Favoris;
            $insertFavoris = $favoris->insert($data);


            if ($insertFavoris) {
                return View::render('enchere/show', [
                    'message' => 'Favoris ajouté avec succès !',
                    'enchere' => $enchereSelect,
                    'timbre' => $timbreSelect,
                    'couleur' => $couleursSelect['nom'],
                    'pays' => $paysSelect['nom'],
                    'condition' => $conditionSelect['nom'],
                    'images' => $imageSelect,
                    'favoris' => $insertFavoris
                ]);
            } else {
                return View::render('error', ['message' => 'Il y a eu une erreur lors de l\'insertion des favoris.']);
            }
        } else {
            $errors = $validator->getErrors();
            return View::render('enchere/show', [
                'message' => 'Favoris ajouté avec succès !',
                'enchere' => $enchereSelect,
                'timbre' => $timbreSelect,
                'couleur' => $couleursSelect['nom'],
                'pays' => $paysSelect['nom'],
                'condition' => $conditionSelect['nom'],
                'images' => $imageSelect,
                'errors' => $errors
            ]);

        }


    }

    public function delete($data)
    {
        // 1. Vérification de la session utilisateur
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            return View::render('auth/index', ['error' => 'Vous devez être connecté pour supprimer un timbre.']);
        }

        // 2. Vérification que le timbre existe et appartient à l'utilisateur
        $favoris = new Favoris;
        $favorisExistant = $favoris->selectWhere2('enchere_id', $data['enchere_id'], 'membre_id', $data['membre_id']);
        if (!$favorisExistant) {
            return View::render('error', ['message' => 'Opération impossible.']);
        }

        if ($data['membre_id'] != $_SESSION['user_id']) {
            return View::render('error', ['message' => 'Vous n\'êtes pas autorisé à supprimer ce timbre.']);
        }

        // 4. Supprimer le timbre
        $deleteFavoris = $favoris->deleteWhere2("enchere_id", $data['enchere_id'], "membre_id", $data['membre_id']);

        if ($deleteFavoris) {
            // Succès : retourner à l'index avec message
            $enchere = new Enchere;
            $enchereSelect = $enchere->selectId($data['enchere_id']);
            $timbre = new Timbre;
            $timbreSelect = $timbre->selectId($enchereSelect['timbreId']);
            $couleurs = new Couleurs;
            $couleursSelect = $couleurs->selectId($timbreSelect['couleursId']);
            $pays = new Pays;
            $paysSelect = $pays->selectId($timbreSelect['paysId']);
            $condition = new Condition;
            $conditionSelect = $condition->selectId($timbreSelect['conditionId']);
            $image = new Image;
            $imageSelect = $image->selectWhere("timbreId", $timbreSelect['id']);

            return View::render('enchere/show', [
                'message' => 'Favoris ajouté avec succès !',
                'enchere' => $enchereSelect,
                'timbre' => $timbreSelect,
                'couleur' => $couleursSelect['nom'],
                'pays' => $paysSelect['nom'],
                'condition' => $conditionSelect['nom'],
                'images' => $imageSelect,
                'favoris' => false
            ]);
        } else {
            return View::render('error', ['message' => 'Il y a eu une erreur lors de la suppression du favoris.']);
        }
    }

    public function index()
    {
        // ajout d'un if user existe sinon on renvoie vers login.
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            return View::render('auth/index', ['error' => 'Vous devez être connecté pour accéder à vos favoris.']);
        } else {
            $membreId = $_SESSION['user_id'];
            $favoris = new Favoris;
            $favorisList = $favoris->selectWhere("membre_id", $membreId, 'enchere_id', 'asc');
            $encheresList = [];
            if (!empty($favorisList)) {
                foreach ($favorisList as $favori) {
                    print_r($favori);
                    echo "<br>";
                    $enchere = new Enchere;
                    $encheresList = $enchere->selectId($favori['Enchere_id']);
                }
            } else {
                return View::render('favoris/index', ['membreId' => $_SESSION['user_id'], 'encheres' => [], 'timbres' => [], 'couleurs' => [], 'pays' => [], 'conditions' => [], 'images' => []]);
            }
            $timbres = new Timbre;
            $TimbresList = $timbres->select();
            $couleurs = new Couleurs;
            $CouleursList = $couleurs->select();
            $pays = new Pays;
            $PaysList = $pays->select();
            $condition = new Condition;
            $ConditionList = $condition->select();
            $image = new Image;
            $imagesList = $image->select();
            return View::render('favoris/index', ['membreId' => $_SESSION['user_id'], 'encheres' => $encheresList, 'timbres' => $TimbresList, 'couleurs' => $CouleursList, 'pays' => $PaysList, 'conditions' => $ConditionList, 'images' => $imagesList]);
        }
    }



}