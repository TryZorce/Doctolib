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
?>

<div class="profile_wrapper">

    <h2>Profile</h2>
    <p>Nom : <?php echo $user['last_name']; ?></p>
    <p>Prénom: <?php echo $user['first_name']; ?></p>
    <p>Email: <?php echo $user['email']; ?></p>
    <p>Téléphone: <?php echo $user['phone_number']; ?></p>
    <p>Adresse: <?php echo $user['address']; ?></p>
    <p>Genre: <?php echo $user['gender']; ?></p>

    <?php echo '<a href="' . URL_LOGOUT . '" class="button"> Se Déconnecter</a>' ?>
    <?php echo '<a href="' . URL_PROFILE . "/update" . '" class="button update"> Modifier mon compte</a>' ?>
    <?php echo '<a href="' . URL_DELETE_ACCOUNT . '" class="button delete"> Supprimer son compte</a>' ?>

    <h3>Mes rendez-vous</h3>
    <?php if (empty($appointments)) : ?>
        <p>Aucun rendez-vous pour le moment.</p>
    <?php else : ?>
        <table class="appointment_table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date et heure</th>
                    <th>Médecin</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($appointments as $appointment) : ?>
                    <tr>
                        <td><?= $appointment->getId(); ?></td>
                        <td><?= $appointment->getDateAndTime(); ?></td>
                        <td><?= $appointmentRepository->getDoctorNameById($appointment->getDoctorId()); ?></td>
                        <td>
                            <form method="POST" action="<?= URL_UPDATE_APPOINTMENTS ?>/<?= $appointment->getId() ?>">

                                <button type="submit" class="button update">Modifier</button>
                            </form>
                            <form method="POST" action="<?= URL_DELETE_APPOINTMENTS ?>">
                                <input type="hidden" name="id" value="<?= $appointment->getId() ?>">
                                <button type="submit" class="button delete">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>


    <a href="<?= URL_CREATE_APPOINTMENTS ?>" class="button create">Prendre un rendez-vous</a>
</div>




<?php
displayFooter();
?>