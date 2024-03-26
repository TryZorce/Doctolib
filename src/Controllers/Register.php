<?php
require_once __DIR__ . "/../config.php";
require_once __DIR__ . "/../Classes/Db.php";

$last_name = $_POST['last_name'];
$first_name = $_POST['first_name'];
$email = $_POST['email'];
$password = $_POST['password'];

if (empty($last_name) || empty($first_name) || empty($email) || empty($password)) {
  die("Please fill in all required fields.");
}

$password = password_hash($password, PASSWORD_DEFAULT);

$db = new Db();
$pdo = $db->getDb();

$sql = "INSERT INTO users (last_name, first_name, email, password) VALUES (:last_name, :first_name, :email, :password)";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':last_name', $last_name);
$stmt->bindParam(':first_name', $first_name);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':password', $password);

if ($stmt->execute()) {
  header("Location:" . URL_PROFILE);
} else {
  echo "Error: " . $sql . "<br>" . $pdo->errorInfo()[2];
}