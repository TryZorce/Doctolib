<?php
class DeleteAccountController
{ Use Response;
    public function index()
    {
        $this->render('delete_account');
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
