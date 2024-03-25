<?php

class RegisterController
{


    public function index()
    {
        define('BASE_PATH', realpath(dirname(__FILE__) . '/../../'));
        $path = BASE_PATH . '/Views/register.php';

        if (file_exists($path)) {
            require_once $path;
        } else {
            echo "Erreur : Le fichier de vue n'existe pas.";
        }
    }


    public function store()
    {
        $user = new User();
        $user->register($_POST['name'], $_POST['firstname'], $_POST['email'], $_POST['password']);
        header("Location: /login");
    }
}
