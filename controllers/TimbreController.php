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
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            $timbre = new Timbre;
            $timbres = $timbre->selectWhere('membreId', $_SESSION['user_id']);
            $couleurs = new Couleurs;
            $CouleursList = $couleurs->select();
            $pays = new Pays;
            $PaysList = $pays->select();
            $condition = new Condition;
            $ConditionList = $condition->select();

            return View::render('timbre/index', [
                'membreId' => $_SESSION['user_id'],
                'timbres' => $timbres,
                'couleurs' => $CouleursList,
                'pays' => $PaysList,
                'conditions' => $ConditionList
            ]);
        } else {
            return View::render('user/login');
        }
    }

    public function create()
    {
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
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
        } else {
            return View::render('user/login');
        }
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
            $validator->field('image2', $files['image2'])->valideExt('webp', $files['image2']['name'])->maxsize(209715200, $files['image2']['size']);
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
                    $dataImage2 = [
                        'lien' => $lien2,
                        'principale' => 0,
                        'timbreId' => $insertTimbre
                    ];
                    $image->insert($dataImage2);
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

    public function edit($data)
    {
        // Vérification de la session utilisateur
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            return View::render('auth/index', ['error' => 'Vous devez être connecté pour modifier un timbre.']);
        }

        $timbre = new Timbre;
        $timbreData = $timbre->selectId($data['id']);

        if (!$timbreData) {
            return View::render('error', ['message' => 'Timbre non trouvé.']);
        }

        // Vérification que l'utilisateur est propriétaire du timbre
        if ($timbreData['membreId'] != $_SESSION['user_id']) {
            return View::render('error', ['message' => 'Vous n\'êtes pas autorisé à modifier ce timbre.']);
        }

        $membreId = $_SESSION['user_id'];
        $couleurs = new Couleurs;
        $CouleursList = $couleurs->select();
        $pays = new Pays;
        $PaysList = $pays->select();
        $condition = new Condition;
        $ConditionList = $condition->select();

        return View::render('timbre/edit', [
            'timbre' => $timbreData,
            'membreId' => $membreId,
            'couleurs' => $CouleursList,
            'pays' => $PaysList,
            'condition' => $ConditionList
        ]);
    }

    public function update($data)
    {
        // 1. Vérification de la session utilisateur
        if (!isset($_SESSION['user_id']) || empty($_SESSION['user_id'])) {
            return View::render('auth/index', ['error' => 'Vous devez être connecté pour modifier un timbre.']);
        }

        // 2. Vérification que le timbre existe et appartient à l'utilisateur
        $timbre = new Timbre;
        $timbreExistant = $timbre->selectId($data['id']);

        if (!$timbreExistant) {
            return View::render('error', ['message' => 'Timbre non trouvé.']);
        }

        if ($timbreExistant['membreId'] != $_SESSION['user_id']) {
            return View::render('error', ['message' => 'Vous n\'êtes pas autorisé à modifier ce timbre.']);
        }

        // 3. Validation des données
        $validator = new Validator;
        $validator->field('nom', $data['nom'])->min(2)->max(60)->required();
        $validator->field('date_creation', $data['date_creation'])->min(4)->max(4)->required();
        $validator->field('tirage', $data['tirage'])->min(1)->max(8);

        // 4. Traitement si validation réussie
        if ($validator->isSuccess()) {
            // Préparation des données pour la mise à jour
            $dataTimbre = [
                'nom' => $data['nom'],
                'date_creation' => (int) $data['date_creation'],
                'certifie' => $data['certifie'],
                'tirage' => $data['tirage'],
                'dimension' => $data['dimension'],
                'membreId' => $_SESSION['user_id'], // Utiliser l'ID de session pour sécurité
                'couleursId' => $data['couleursId'],
                'paysId' => $data['paysId'],
                'conditionId' => $data['conditionId'],
            ];

            // Tentative de mise à jour
            $updateTimbre = $timbre->update($dataTimbre, $data['id']);

            if ($updateTimbre) {
                // Succès : récupérer les données pour l'affichage
                $timbre = new Timbre;
                $timbres = $timbre->selectWhere('membreId', $_SESSION['user_id']);
                $couleurs = new Couleurs;
                $CouleursList = $couleurs->select();
                $pays = new Pays;
                $PaysList = $pays->select();
                $condition = new Condition;
                $ConditionList = $condition->select();

                return View::render('timbre/index', [
                    'message' => 'Timbre modifié avec succès !',
                    'membreId' => $_SESSION['user_id'],
                    'timbres' => $timbres,
                    'couleurs' => $CouleursList,
                    'pays' => $PaysList,
                    'conditions' => $ConditionList
                ]);
            } else {
                return View::render('error', ['message' => 'Il y a eu une erreur lors de la modification du timbre.']);
            }
        } else {
            // 5. Traitement en cas d'erreurs de validation
            $errors = $validator->getErrors();
            $couleurs = new Couleurs;
            $CouleursList = $couleurs->select();
            $pays = new Pays;
            $PaysList = $pays->select();
            $condition = new Condition;
            $ConditionList = $condition->select();

            return View::render('timbre/edit', [
                'timbre' => $data, // Réutiliser les données saisies
                'membreId' => $_SESSION['user_id'],
                'couleurs' => $CouleursList,
                'pays' => $PaysList,
                'condition' => $ConditionList,
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
        $timbre = new Timbre;
        $timbreExistant = $timbre->selectId($data['id']);

        if (!$timbreExistant) {
            return View::render('error', ['message' => 'Timbre non trouvé.']);
        }

        if ($timbreExistant['membreId'] != $_SESSION['user_id']) {
            return View::render('error', ['message' => 'Vous n\'êtes pas autorisé à supprimer ce timbre.']);
        }

        // 3. Supprimer les images associées d'abord
        $image = new Image;
        $images = $image->selectWhere('timbreId', $data['id']);
        if ($images) {
            foreach ($images as $img) {
                // Supprimer le fichier physique si nécessaire
                if (file_exists('public/image_produit/' . $img['lien'])) {
                    unlink('public/image_produit/' . $img['lien']);
                }
                // Supprimer l'enregistrement de l'image
                $image->delete($img['id']);
            }
        }

        // 4. Supprimer le timbre
        $deleteTimbre = $timbre->delete($data['id']);

        if ($deleteTimbre) {
            // Succès : retourner à l'index avec message
            $timbres = $timbre->selectWhere('membreId', $_SESSION['user_id']);
            $couleurs = new Couleurs;
            $CouleursList = $couleurs->select();
            $pays = new Pays;
            $PaysList = $pays->select();
            $condition = new Condition;
            $ConditionList = $condition->select();

            return View::render('timbre/index', [
                'message' => 'Timbre supprimé avec succès !',
                'membreId' => $_SESSION['user_id'],
                'timbres' => $timbres,
                'couleurs' => $CouleursList,
                'pays' => $PaysList,
                'conditions' => $ConditionList
            ]);
        } else {
            return View::render('error', ['message' => 'Il y a eu une erreur lors de la suppression du timbre.']);
        }
    }
}