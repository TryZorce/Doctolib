<?php
class ProfileController
{
    public function index()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL_LOGIN);
            return;
        }

        $user = new User();
        $userData = $user->getUserById($_SESSION['user_id']);

        require_once __DIR__ . "/../views/profile.php";
    }

    public function update()
    {
        if (!isset($_SESSION['user_id'])) {
            header("Location: " . URL_LOGIN);
            return;
        }

        $user = new User();
        $user->update(
            $_SESSION['user_id'],
            $_POST['name'],
            $_POST['firstname'],
            $_POST['email'],
            $_POST['password']
        );

        header("Location: " . URL_PROFILE);
    }
}
