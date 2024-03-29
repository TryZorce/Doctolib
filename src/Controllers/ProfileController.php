<?php
class ProfileController
{
    use Response;
    public function index()
    {
        $this->render('profile');

    }

    public function update()
    {
        $userModel = new User();
        $user = $userModel->getUserByEmail($_SESSION['email']);

        $errors = [];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $last_name = $_POST["last_name"] ?? "";
            $first_name = $_POST["first_name"] ?? "";
            $email = $_POST["email"] ?? "";
            $phone_number = $_POST["phone_number"] ?? "";
            $address = $_POST["address"] ?? "";
            $gender = $_POST["gender"] ?? "";
            $password = $_POST["password"] ?? "";
            $confirm_password = $_POST["confirm_password"] ?? "";

            if (empty($last_name)) {
                $errors["last_name"] = "Le nom est obligatoire";
            }

            if (empty($first_name)) {
                $errors["first_name"] = "Le prénom est obligatoire";
            }

            if (empty($email)) {
                $errors["email"] = "L'email est obligatoire";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors["email"] = "L'email n'est pas valide";
            }

            if (empty($phone_number)) {
                $errors["phone_number"] = "Le numéro de téléphone est obligatoire";
            }

            if (empty($address)) {
                $errors["address"] = "L'adresse est obligatoire";
            }

            if (empty($gender)) {
                $errors["gender"] = "Le genre est obligatoire";
            }

            if (!empty($password)) {
                if (strlen($password) < 8) {
                    $errors["password"] = "Le mot de passe doit contenir au moins 8 caractères";
                }

                if ($password !== $confirm_password) {
                    $errors["confirm_password"] = "Les mots de passe ne correspondent pas";
                }
            }

            if (empty($errors)) {
                $userModel->update($user["id"], $last_name, $first_name, $email, $phone_number, $address, $gender, $password);
                $this->render("/profile");
            }
        }

        $this->render("profile_update", ["user" => $user, "errors" => $errors]);
    
    }

    public function delete_index()
    {
        $this->render('delete_account');
    }

    public function destroy()
    {
        $userModel = new User();
        $email = $_SESSION['email'];
        $userModel->delete($email);
        unset($_SESSION['email']);
        echo '<meta http-equiv="refresh" content="0;url=' . URL_PROFILE . '">';
    }

    public function logout()
    {
        $this->render('logout');
    }

    public function login_index()
    {
        $this->render('login');
    }



    public function login()
    {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email) || empty($password)) {
            die("Please fill in all required fields.");
        }

        $db = new Db();
        $pdo = $db->getDb();

        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            echo '<meta http-equiv="refresh" content="0;url=' . URL_PROFILE . '">';
        } else {
            $_SESSION['login_error'] = "Error: Invalid email or password.";
            echo '<meta http-equiv="refresh" content="0;url=' . URL_LOGIN . '">';
        }
    }

    public function register_index()
    { 
        $this->render('register');
    }


    public function create()
{
    $last_name = $_POST['last_name'];
    $first_name = $_POST['first_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];

    if (empty($last_name) || empty($first_name) || empty($email) || empty($password) || empty($phone_number) || empty($address) || empty($gender)) {
        die("Please fill in all required fields.");
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $db = new Db();
    $pdo = $db->getDb();

    // Vérifier si l'adresse e-mail existe déjà
    $checkSql = "SELECT * FROM users WHERE email = :email";
    $checkStmt = $pdo->prepare($checkSql);
    $checkStmt->bindParam(':email', $email);
    $checkStmt->execute();

    if ($checkStmt->rowCount() > 0) {
        $_SESSION['email_exist'] = "Erreur , Cette adresse mail possède déjà un compte";
        // Rediriger vers la page d'inscription ou afficher un message d'erreur
        echo '<meta http-equiv="refresh" content="0;url=' . URL_REGISTER . '">';
    } else {
        $sql = "INSERT INTO users (last_name, first_name, email, password, phone_number, address, gender) VALUES (:last_name, :first_name, :email, :password, :phone_number, :address, :gender)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':phone_number', $phone_number);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':gender', $gender);

        if ($stmt->execute()) {
            $_SESSION['email'] = $email;
            echo '<meta http-equiv="refresh" content="0;url=' . URL_PROFILE . '">';
        } else {
            echo "Error: " . $sql . "<br>" . $pdo->errorInfo()[2];
        }
    }
}
}