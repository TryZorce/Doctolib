<?php
include_once __DIR__ . "/../Components/header.php";
include_once __DIR__ . "/../Components/footer.php";
require_once __DIR__ . "/../init.php";
displayHeader();

if (!isset($_SESSION['email'])) {
    echo '<meta http-equiv="refresh" content="0;url=' . URL_LOGIN . '">';
    exit();
}

$email = $_SESSION['email'];
$userModel = new User();
$user = $userModel->getUserByEmail($email);

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $last_name = $_POST["last_name"] ?? "";
    $first_name = $_POST["first_name"] ?? "";
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

    if (!preg_match("/^[0-9]{10}$/", $phone_number)) {
        $errors["phone_number"] = "Le numéro de téléphone doit contenir 10 chiffres";
    }

    if (empty($address)) {
        $errors["address"] = "L'adresse est obligatoire";
    }

    if (!in_array($gender, ["homme", "femme", "autre"])) {
        $errors["gender"] = "Le genre n'est pas valide";
    }


    if ($password !== $confirm_password) {
        $errors["confirm_password"] = "Les mots de passe ne correspondent pas";
    }

    if (empty($errors)) {
        $userModel->update($user["id"], $last_name, $first_name, $user["email"], $password ?? $user["password"], $phone_number, $address, $gender);
        echo "<p class='success'>Votre profil a été mis à jour avec succès</p>";
    }
}
?>

<div class="profile_wrapper">
    <h2>Modifier mon profil</h2>
    <form method="POST">
        <div>
            <label for="last_name">Nom :</label>
            <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($user["last_name"]); ?>">
            <?php if (isset($errors["last_name"])) : ?>
                <p class="error"><?php echo htmlspecialchars($errors["last_name"]); ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="first_name">Prénom :</label>
            <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($user["first_name"]); ?>">
            <?php if (isset($errors["first_name"])) : ?>
                <p class="error"><?php echo htmlspecialchars($errors["first_name"]); ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="phone_number">Téléphone :</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user["phone_number"]); ?>">
            <?php if (isset($errors["phone_number"])) : ?>
                <p class="error"><?php echo htmlspecialchars($errors["phone_number"]); ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="address">Adresse :</label>
            <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user["address"]); ?>">
            <?php if (isset($errors["address"])) : ?>
                <p class="error"><?php echo htmlspecialchars($errors["address"]); ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="gender">Genre :</label>
            <select id="gender" name="gender">
                <option value="">-- Choisir --</option>
                <option value="homme" <?php if ($user["gender"] == "homme") : ?>selected<?php endif; ?>>Homme</option>
                <option value="femme" <?php if ($user["gender"] == "femme") : ?>selected<?php endif; ?>>Femme</option>
                <option value="autre" <?php if ($user["gender"] == "autre") : ?>selected<?php endif; ?>>Autre</option>
            </select>
            <?php if (isset($errors["gender"])) : ?>
                <p class="error"><?php echo htmlspecialchars($errors["gender"]); ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="password">Nouveau mot de passe :</label>
            <input type="password" id="password" name="password">
            <?php if (isset($errors["password"])) : ?>
                <p class="error"><?php echo htmlspecialchars($errors["password"]); ?></p>
            <?php endif; ?>
        </div>
        <div>
            <label for="confirm_password">Confirmer le nouveau mot de passe :</label>
            <input type="password" id="confirm_password" name="confirm_password">
            <?php if (isset($errors["confirm_password"])) : ?>
                <p class="error"><?php echo htmlspecialchars($errors["confirm_password"]); ?></p>
            <?php endif; ?>
        </div>
        <button type="submit">Enregistrer les modifications</button>
    </form>
</div>

<?php
displayFooter();
