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
        return View::render('enchere/index', ['membreId' => $_SESSION['user_id'], 'encheres' => $encheresList, 'timbres' => $TimbresList, 'couleurs' => $CouleursList, 'pays' => $PaysList, 'conditions' => $ConditionList]);
    }
}