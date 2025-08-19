<?php
namespace App\Controllers;

use App\Providers\View;
use App\Models\Timbre;
use App\Models\Couleurs;
use App\Models\Pays;
use App\Models\Condition;
use App\Models\Image;
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

        return View::render('enchere/show', ['enchere' => $enchereSelect, 'timbre' => $timbreSelect, 'couleur' => $couleursSelect['nom'], 'pays' => $paysSelect['nom'], 'condition' => $conditionSelect['nom'], 'images' => $imageSelect]);
    }
}
