<?php
class DeleteAccountController
{
    public function index()
    {
        require_once __DIR__ . "/../views/delete_account.php";
    }

    public function destroy()
    {
        $user = new User();
        $user->delete($_SESSION['user_id']);
        unset($_SESSION['user_id']);
        unset($_SESSION['name']);
        unset($_SESSION['firstname']);
        unset($_SESSION['email']);
        header("Location: /register");
    }
}
