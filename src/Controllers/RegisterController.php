<?php

class RegisterController
{use Response;


    public function index()
    { 
        $this->render('register');
    }


    public function store()
    {
        $user = new User();
        $user->register($_POST['name'], $_POST['firstname'], $_POST['email'], $_POST['password']);
        header("Location: /login");
    }
}
