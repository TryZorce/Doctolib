<?php
require_once __DIR__ . "/User.php";

class UserRepository
{
    public function registerUser($name, $firstname, $email, $password)
    {
        $user = new User();
        return $user->register($name, $firstname, $email, $password);
    }

    public function loginUser($email, $password)
    {
        $user = new User();
        return $user->login($email, $password);
    }

    public function getUser($id)
    {
        $user = new User();
        return $user->getUserById($id);
    }

    public function updateUser($id, $name, $firstname, $email, $password)
    {
        $user = new User();
        $user->update($id, $name, $firstname, $email, $password);
    }

    public function deleteUser($id)
    {
        $user = new User();
        $user->delete($id);
    }
}
