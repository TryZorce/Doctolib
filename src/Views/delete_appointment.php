<!DOCTYPE html>
<html>
<head>
    <title>Supprimer un rendez-vous</title>
</head>
<body>
    <h1>Supprimer un rendez-vous</h1>
    <p>Êtes-vous sûr de vouloir supprimer le rendez-vous avec <?= $appointment->getDoctor()->getFullName() ?> le <?= $appointment->getDateAndTime()->format('d/m/Y à H:i') ?> ?</p>
    <form method="POST" action="<?= URL_DELETE_APPOINTMENTS ?>">
        <input type="hidden" name="id" value="<?= $appointment->getId() ?>">
        <button type="submit">Supprimer le rendez-vous</button>
    </form>
    <a href="<?= URL_APPOINTMENTS ?>">Annuler</a>
</body>
</html>
