<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;
use App\Models\User;

class UserController
{
    public function __construct()
    {
        // Auth::session();//  à remettre en place pour vérifier la session de l'utilisateur
    }
    public function create()
    {

        return View::render('user/create');
    }

    public function store($data)
    {
        $validator = new Validator();
        $validator->field('nom', $data['nom'])
            ->required()
            ->min(3)
            ->max(50);
        $validator->field('prenom', $data['prenom'])
            ->required()
            ->min(3)
            ->max(50);
        $validator->field('login', $data['login'])
            ->required()
            ->min(3)
            ->max(50)
            ->unique('User');
        $validator->field('motDePasse', $data['motDePasse'])
            ->required()
            ->min(6)
            ->max(20);
        $validator->field('email', $data['email'])
            ->required()
            ->email();

        if ($validator->isSuccess()) {
            $user = new User();
            $data['motDePasse'] = $user->hashPassword($data['motDePasse']);
            $insert = $user->insert($data);
            return View::redirect('login');
        } else {
            $errors = $validator->getErrors();
            return View::render('user/create', [
                'errors' => $errors,
                'user' => $data
            ]);
        }
    }

    public function index()
    {
        if (isset($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $user = new User();
            $userData = $user->selectId($id);
            return View::render('user/index', [
                'user' => $userData
            ]);
        } else {
            return View::redirect('login');
        }
    }

    public function edit()
    {
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            $id = $_SESSION['user_id'];
            $user = new User();
            $userData = $user->selectId($id);
            return View::render('user/edit', [
                'user' => $userData
            ]);
        }
    }

    public function update($data, $get)
    {
        // Auth::session();
        if (isset($get['id']) && $get['id'] != null) {
            $validator = new Validator();
            $validator->field('nom', $data['nom'])
                ->required()
                ->min(3)
                ->max(50);
            $validator->field('prenom', $data['prenom'])
                ->required()
                ->min(3)
                ->max(50);

            $validator->field('email', $data['email'])
                ->required()
                ->email();

            if ($validator->isSuccess()) {
                $user = new User();
                $data['motDePasse'] = $user->hashPassword($data['motDePasse']);
                $update = $user->update($data, $_SESSION['user_id']);
                return View::redirect('user/index');
            } else {
                $errors = $validator->getErrors();
                return View::render('user/edit', [
                    'errors' => $errors,
                    'user' => $data
                ]);
            }
        }
    }


    public function delete()
    {
        if (Auth::session()) {
            $user = new User;
            $delete = $user->delete($_SESSION['user_id']);
            if ($delete) {
                return View::redirect('login');
            } else {
                return View::render('error', ['message' => "La suppression ne s'est pas bien passée, il y a un problème."]);
            }
        }

    }
}

