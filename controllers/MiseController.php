<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\Timbre;
use App\Models\Mise;
use App\Models\Enchere;

class MiseController
{
    public function index()
    {
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            $timbre = new Timbre;
            $timbres = $timbre->select();
            $mise = new Mise;
            $miseselect = $mise->selectWhere('membreId', $_SESSION['user_id']);
            $enchere = new Enchere;
            $enchereList = $enchere->select();

            return View::render('mise/index', [
                'membreId' => $_SESSION['user_id'],
                'timbres' => $timbres,
                'mises' => $miseselect,
                'encheres' => $enchereList
            ]);
        } else {
            return View::render('user/login');
        }
    }
    public function insert($data)
    {
        $validator = new Validator;
        $validator->field('montant', $data['montant'])->required();
        $validator->field('membreId', $data['membreId'])->required();
        $validator->field('enchereId', $data['enchereId'])->required();
        if ($validator->isSuccess()) {
            // Insérer la mise dans la base de données
            $mise = new Mise();
            $insertMise = $mise->insert($data);
            if ($insertMise) {
                // La mise a été insérée avec succès
                return View::redirect('enchere/show?id=' . $data['enchereId']);
            }
        } else {
            // Gérer les erreurs de validation
            $errors = $validator->getErrors();
            return View::redirect('enchere/show?id=' . $data['enchereId'], ['errors' => $errors]);
        }
    }
}
