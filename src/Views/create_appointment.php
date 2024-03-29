<?php


$db = new Db();
$doctorRepository = new DoctorRepository($db->getDb());
$doctors = $doctorRepository->getAllDoctors();

?>

<!DOCTYPE html>
<html>

<head>
    <title>Créer un rendez-vous</title>
</head>

<body>
    <h1>Créer un rendez-vous</h1>
    <form method="POST" action="<?= URL_CREATE_APPOINTMENTS ?>">
        <label for="date_and_time">Date et heure :</label>
        <input type="datetime-local" name="date_and_time" id="date_and_time" required>
        <br>
        <label for="doctor_id">Médecin :</label>
        <select name="doctor_id">
            <option value="" required disabled selected>Sélectionnez un médecin</option>
            <?php foreach ($doctors as $doctor) : ?>
                <option value="<?= $doctor->getId() ?>"><?= $doctor->getName() ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Créer le rendez-vous</button>
    </form>
</body>

</html>
