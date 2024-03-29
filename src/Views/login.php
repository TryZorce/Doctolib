<?php

include_once __DIR__ . "/../Components/header.php";
include_once __DIR__ . "/../Components/footer.php";


if (isset($_SESSION['email'])) {
    echo '<meta http-equiv="refresh" content="0;url=' . URL_PROFILE . '">';
    return;
}





displayHeader(); ?>

<div class="form_wrapper">
    <h2>Login</h2>



    <?php if (isset($_SESSION['login_error'])) {
        echo '<p class="error">' . $_SESSION['login_error'] . '</p>';
        unset($_SESSION['login_error']);
    }



    ?>
    <form method="POST" action="<?php echo (URL_LOGIN . '/traitement') ?>" class="form">
        <label>Email: <input type="email" name="email" required></label>
        <label>Password: <input type="password" name="password" required></label>
        <button type="submit">Login</button>
    </form>
    <?php echo '<a href="' . URL_REGISTER . '" class="button"> S&#39inscrire</a>' ?>
</div>
<?php displayFooter(); ?>