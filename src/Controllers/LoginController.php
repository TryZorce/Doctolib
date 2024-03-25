<?php

class LoginController
{
    public function index()
    {
        require_once __DIR__ . "/../views/login.php";
    }

    public function authenticate()
    {
        $user = new User();
        $authenticatedUser = $user->login($_POST['email'], $_POST['password']);

        if ($authenticatedUser) {
            $_SESSION['user_id'] = $authenticatedUser['id'];
            $_SESSION['name'] = $authenticatedUser['name'];
            $_SESSION['firstname'] = $authenticatedUser['firstname'];
            $_SESSION['email'] = $authenticatedUser['email'];
            header("Location: /profile");
        } else {
            echo "Invalid email or password";
        }
    }
}
