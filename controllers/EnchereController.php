<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Timbre;
use App\Models\Couleurs;
use App\Models\Pays;
use App\Models\Condition;
use App\Models\Image;
use App\Models\Favoris;
use App\Models\Enchere;

class EnchereController
{
    public function index()
    {
        // ajout d'un if user existe sinon on renvoie vers login.
        $enchere = new Enchere;
        $encheresList = $enchere->select();
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
        return View::render('enchere/index', ['membreId' => $_SESSION['user_id'], 'encheres' => $encheresList, 'timbres' => $TimbresList, 'couleurs' => $CouleursList, 'pays' => $PaysList, 'conditions' => $ConditionList, 'images' => $imagesList]);
    }
    public function show($data)
    {
        if (isset($data['id']) && !empty($data['id'])) {
            $id = $data['id'];
        } else {
            return View::render('errors/404');
        }
        $enchere = new Enchere;
        $enchereSelect = $enchere->selectId($id);
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

        $favoris = new Favoris;
        $favorisSelect = $favoris->selectWhere2("enchere_id", $enchereSelect['id'], "membre_id", $_SESSION['user_id']);
        if (count($favorisSelect) === 1) {
            $existFavori = true;
        } else {
            $existFavori = false;
        }

        return View::render('enchere/show', ['enchere' => $enchereSelect, 'timbre' => $timbreSelect, 'couleur' => $couleursSelect['nom'], 'pays' => $paysSelect['nom'], 'condition' => $conditionSelect['nom'], 'images' => $imageSelect, 'favoris' => $favorisSelect]);
    }

    public function search($data)
    {
        $timbre = new Timbre;
        $where = 'nom';
        $valueWhere = $data['search'];
        if ($where && $valueWhere) {
            $timbreSelect = $timbre->search($where, $valueWhere);

            if ($timbreSelect) {
                $encheresList = [];
                foreach ($timbreSelect as $timbre) {
                    $encheres = new Enchere;
                    $result = $encheres->selectWhere("timbreId", $timbre['id']);
                    if ($result) {
                        foreach ($result as $enchere) {
                            $encheresList[] = $enchere;
                        }
                    }
                }
                if ($encheresList) {


                    return View::render('enchere/searchIndex', ['encheres' => $encheresList, 'timbres' => $timbreSelect]);
                } else {
                    return View::render('enchere/searchIndex', ['error' => 'Aucune enchère trouvée pour ce timbre.']);
                }
            } else {
                return View::render('enchere/searchIndex', ['error' => 'Aucune enchère trouvée pour ce timbre.']);
            }
        } else {
            return View::render('enchere/searchIndex', ['error' => 'Aucune enchère trouvée pour ce timbre.']);
        }
    }
}
