<?php

include_once __DIR__ . "/../Components/header.php";
include_once __DIR__ . "/../Components/footer.php";


if (isset($_SESSION['email'])) {
    echo '<meta http-equiv="refresh" content="0;url=' . URL_PROFILE . '">';
    return;
}

displayHeader(); ?>

<div class="form_wrapper">
    <h2>Register</h2>
    <?php if (isset($_SESSION['email_exist'])) {
        echo '<p class="error">' . $_SESSION['email_exist'] . '</p>';
        unset($_SESSION['email_exist']);
    }
    ?>
    <form name="registerForm" action="<?php echo(URL_REGISTER . '/traitement') ?>" method="post" onsubmit="return validateForm()" class="form">
        <label>Name: <input type="text" name="last_name" required></label>
        <label>Firstname: <input type="text" name="first_name" required></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Password: <input type="password" name="password" required></label>
        <label>Confirm Password: <input type="password" name="confirm_password" required></label>
        <label>Phone Number: <input type="tel" name="phone_number" required></label>
        <label>Address: <input type="text" name="address" required></label>
        <label>Gender:
            <select name="gender" required>
                <option value="">Select</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
                <option value="other">Other</option>
            </select>
        </label>
        <button type="submit">Register</button>
    </form>
</div>


<script>
    function validateForm() {
        var lastName = document.forms["registerForm"]["last_name"].value;
        var firstName = document.forms["registerForm"]["first_name"].value;
        var email = document.forms["registerForm"]["email"].value;
        var password = document.forms["registerForm"]["password"].value;
        var confirmPassword = document.forms["registerForm"]["confirm_password"].value;
        var phoneNumber = document.forms["registerForm"]["phone_number"].value;
        var address = document.forms["registerForm"]["address"].value;
        var gender = document.forms["registerForm"]["gender"].value;
        var errorMessage = "";

        if (lastName.length < 3 || lastName.length > 50) {
            errorMessage += "Le nom doit comporter entre 3 et 50 caractères.\n";
        }
        if (firstName.length < 3 || firstName.length > 50) {
            errorMessage += "Le prénom doit comporter entre 3 et 50 caractères.\n";
        }
        if (email.length < 3 || email.length > 80 || !email.includes('@')) {
            errorMessage += "L'email n'est pas valide.\n";
        }
        if (password.length < 7) {
            errorMessage += "Le mot de passe doit comporter au moins 7 caractères.\n";
        }
        if (password != confirmPassword) {
            errorMessage += "Les mots de passe ne correspondent pas.\n";
        }
        if (phoneNumber.length < 10 || phoneNumber.length > 15) {
            errorMessage += "Le numéro de téléphone doit comporter entre 10 et 15 caractères.\n";
        }
        if (address.length < 5 || address.length > 100) {
            errorMessage += "L'adresse doit comporter entre 5 et 100 caractères.\n";
        }
        if (gender == "") {
            errorMessage += "Le genre est requis.\n";
        }

        if (errorMessage != "") {
            alert(errorMessage);
            return false;
        }
    }
</script>
<?php
displayFooter(); ?>