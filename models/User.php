<?php
namespace App\Models;
use App\Models\CRUD;

class User extends CRUD
{
    protected $table = "membre";
    protected $primaryKey = "id";
    protected $fillable = ['login', 'nom', 'prenom', 'email', 'motDePasse'];

    public function hashPassword($motDePasse, $cost = 10)
    {
        $options = [
            'cost' => $cost
        ];
        return password_hash($motDePasse, PASSWORD_BCRYPT, $options);
    }

    public function checkUser($login, $motDePasse)
    {
        $user = $this->unique('login', $login);
        if ($user) {
            if (password_verify($motDePasse, $user['motDePasse'])) {
                session_regenerate_id();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['login'];
                $_SESSION['fingerPrint'] = md5($_SERVER['HTTP_USER_AGENT'] . $_SERVER['REMOTE_ADDR']);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
