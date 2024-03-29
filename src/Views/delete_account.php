<?php
include_once __DIR__ . "/../Components/header.php";
include_once __DIR__ . "/../Components/footer.php";
displayHeader();
?>

<div class="form_wrapper">
    <h2>Supprimer le compte</h2>
    <p>Vous êtes sûr de vouloir supprimer votre compte ?</p>
    <form action="<?php echo(URL_DELETE_ACCOUNT . "/traitement")?>" method="POST">
        <button type="submit">Supprimer mon compte</button>
    </form>
</div>

<?php
displayFooter();
