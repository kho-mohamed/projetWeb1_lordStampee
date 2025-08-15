<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Timbre;
use App\Models\Couleurs;
use App\Models\Pays;
use App\Models\Condition;
use App\Models\Image;

class TimbreController
{
    public function index()
    {
        // ajout d'un if user existe sinon on renvoie vers login.
        $timbre = new Timbre;
        $timbres = $timbre->selectWhere('membreId', $_SESSION['user_id']);
        $couleurs = new Couleurs;
        $CouleursList = $couleurs->select();
        $pays = new Pays;
        $PaysList = $pays->select();
        $condition = new Condition;
        $ConditionList = $condition->select();
        return View::render('timbre/index', ['membreId' => $_SESSION['user_id'], 'timbres' => $timbres, 'couleurs' => $CouleursList, 'pays' => $PaysList, 'conditions' => $ConditionList]);
    }

    public function create()
    {
        $membreId = $_SESSION['user_id'];
        $couleurs = new Couleurs;
        $CouleursList = $couleurs->select();
        $pays = new Pays;
        $PaysList = $pays->select();
        $condition = new Condition;
        $ConditionList = $condition->select();

        return View::render('timbre/create', [
            'membreId' => $membreId,
            'couleurs' => $CouleursList,
            'pays' => $PaysList,
            'condition' => $ConditionList
        ]);
    }
    public function store($data, $queryParams = null)
    {
        // if pour session existe?
        $files = $_FILES; // Récupérer les fichiers uploadés

        $validator = new Validator;
        $validator->field('nom', $data['nom'])->min(2)->max(60)->required();
        $validator->field('date_creation', $data['date_creation'])->min(4)->max(4)->required();
        $validator->field('tirage', $data['tirage'])->min(1)->max(8);

        // Vérifier si image1 existe et a été uploadé
        if (isset($files['image1']) && $files['image1']['error'] === UPLOAD_ERR_OK) {
            $validator->field('image1', $files['image1'])->required()->valideExt('webp', $files['image1']['name'])->maxsize(209715200, $files['image1']['size']);
        } else {
            $validator->field('image1', null)->required(); // Image1 est requise
        }

        // Vérifier si image2 existe et a été uploadé (optionnel)
        if (isset($files['image2']) && $files['image2']['error'] === UPLOAD_ERR_OK) {
            $validator->field('image2', $files['image2'])->valideExt(['webp'], $files['image2']['name'])->maxsize(209715200, $files['image2']['size']);
        }

        if ($validator->isSuccess()) {
            $dataTimbre = [
                'nom' => $data['nom'],
                'date_creation' => (int) $data['date_creation'],
                'certifie' => $data['certifie'],
                'tirage' => $data['tirage'],
                'dimension' => $data['dimension'],
                'membreId' => $data['membreId'],
                'couleursId' => $data['couleursId'],
                'paysId' => $data['paysId'],
                'conditionId' => $data['conditionId'],
            ];
            $timbre = new Timbre;
            $insertTimbre = $timbre->insert($dataTimbre);
            if ($insertTimbre) {
                $image = new Image;
                $lien = $image->upload($files['image1']);
                $dataImage = [
                    'lien' => $lien,
                    'principale' => 1,
                    'timbreId' => $insertTimbre
                ];
                $image->insert($dataImage);
                if (isset($files['image2']) && $files['image2']['error'] === UPLOAD_ERR_OK) {
                    $lien2 = $image->upload($files['image2']);
                    $dataImage = [
                        'lien' => $lien2,
                        'principale' => 0,
                        'timbre_id' => $insertTimbre
                    ];
                    $image->insert($dataImage);
                }
                return View::render('timbre/index', ['message' => 'Timbre ajouté avec succès !', 'membreId' => $data['membreId']]);
            } else {
                return View::render('error', ['message' => 'Il y a eu une erreur lors de l\'insertion du timbre.']);
            }
        } else {
            $errors = $validator->getErrors();
            $couleurs = new Couleurs;
            $CouleursList = $couleurs->select();
            $pays = new Pays;
            $PaysList = $pays->select();
            $condition = new Condition;
            $ConditionList = $condition->select();
            return View::render('timbre/create', [
                'membreId' => $data['membreId'],
                'couleurs' => $CouleursList,
                'pays' => $PaysList,
                'condition' => $ConditionList,
                'errors' => $errors
            ]);
        }

    }

}