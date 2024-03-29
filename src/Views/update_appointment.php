<!DOCTYPE html>
<html>
<head>
    <title>Modifier un rendez-vous</title>
</head>
<body>
    <h1>Modifier un rendez-vous</h1>
    <form method="POST" action="<?= URL_UPDATE_APPOINTMENTS ?>">
        <input type="hidden" name="id" value="<?= $appointment->getId() ?>">
        <label for="date_and_time">Date et heure :</label>
        <input type="datetime-local" name="date_and_time" id="date_and_time" value="<?= $appointment->getDateAndTime() ?>" required>
        <br>
        <label for="doctor_id">Médecin :</label>
        <select name="doctor_id" id="doctor_id" required>
            <?php foreach ($doctors as $doctor): ?>
                <option value="<?= $doctor->getId() ?>" <?= $doctor->getId() == $appointment->getDoctorId() ? 'selected' : '' ?>><?= $doctor->getFullName() ?></option>
            <?php endforeach; ?>
        </select>
        <br>
        <button type="submit">Mettre à jour le rendez-vous</button>
    </form>
</body>
</html>
