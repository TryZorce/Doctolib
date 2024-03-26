<?php
class ProfileController
{
    use Response;
    public function index()
    { 
        $this->render('profile');
        if (!isset($_SESSION['id'])) {
            header("Location: " . URL_LOGIN);
            return;
        }

    }

    public function update()
    {
        if (!isset($_SESSION['id'])) {
            header("Location: " . URL_LOGIN);
            return;
        }

        $user = new User();
        $user->update(
            $_SESSION['id'],
            $_POST['name'],
            $_POST['firstname'],
            $_POST['email'],
            $_POST['password']
        );

        header("Location: " . URL_PROFILE);
    }
}
