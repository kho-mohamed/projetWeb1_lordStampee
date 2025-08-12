<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Models\User;

class AuthController
{

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            session_destroy();
            return View::redirect('login');
        }
        return View::render('auth/index');
    }
    public function store($data)
    {
        $validator = new Validator;
        $validator->field('login', $data['login'])->min(2)->max(50);
        $validator->field('motDePasse', $data['motDePasse'])->min(6)->max(20);

        if ($validator->isSuccess()) {
            $user = new User;
            $checkuser = $user->checkUser($data['login'], $data['motDePasse']);
            if ($checkuser) {
                return View::redirect('user/index'); // rediriger vers page catalogue quand elle sera disponible
            } else {
                $errors['message'] = "Les données saisies sont incorrectes!";
                return View::render('auth/index', ['errors' => $errors]);
            }

        } else {
            $errors = $validator->getErrors();
            return View::render('auth/index', ['errors' => $errors]);
        }


    }
    public function delete()
    {
        session_destroy();
        return View::redirect('login');
    }
}

?>