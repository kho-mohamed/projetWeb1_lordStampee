<?php
namespace App\Controllers;

use App\Providers\View;
use App\Providers\Validator;
use App\Providers\Auth;
use App\Models\Privilege;
use App\Models\User;

class UserController
{
    public function __construct()
    {
        Auth::session();
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
            ->unique('user');
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
}