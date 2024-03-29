<?php
require_once __DIR__ . "/../Classes/Db.php";

class User
{
    private $Db;

    public function __construct()
    {
        $this->Db = new Db();
        $this->Db = $this->Db->getDb();
    }

    public function register($last_name, $first_name, $email, $password)
    {
        $stmt = $this->Db->prepare("INSERT INTO users (last_name, first_name, email, password) VALUES (:last_name, :first_name, :email, :password)");
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);

        return $stmt->execute();
    }

    public function login($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $this->Db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    public function getUserById($id)
    {
        $stmt = $this->Db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getUserByEmail($email)
    {
        $stmt = $this->Db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $last_name, $first_name, $email, $phone_number, $address, $gender, $password)
    {
        if (!empty($password)) {
            $password = password_hash($password, PASSWORD_DEFAULT);
        } else {
            $password = $this->getUserById($id)['password'];
        }

        $stmt = $this->Db->prepare("UPDATE users SET last_name = :last_name, first_name = :first_name, email = :email, password = :password WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindParam(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function delete($email)
    {
        $stmt = $this->Db->prepare("DELETE FROM appointments WHERE user_id = (SELECT id FROM users WHERE email = :email)");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    
        $stmt = $this->Db->prepare("DELETE FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
    }

    public function getAppointmentsByUserId($user_id)
{
    $sql = "SELECT * FROM appointments WHERE user_id = :user_id";
    $stmt = $this->Db->prepare($sql);
    $stmt->bindParam(':user_id', $user_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

}
