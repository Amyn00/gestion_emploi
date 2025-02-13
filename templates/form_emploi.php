<?php
require '../config.php';
$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
$elements = $pdo->query("SELECT * FROM elements")->fetchAll();
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();
$creneaux = $pdo->query("SELECT * FROM creneaux")->fetchAll();
$semaines = $pdo->query("SELECT * FROM semaines")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter un Emploi du Temps</title>
</head>
<body>
    <h2>Ajouter un Emploi du Temps</h2>
    <form action="../actions/add_emploi.php" method="POST">
        <label>Professeur :</label>
        <select name="prof_id">
            <?php foreach ($professeurs as $prof) : ?>
                <option value="<?= $prof['id'] ?>"><?= $prof['nom'] . " " . $prof['prenom'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Élément :</label>
        <select name="element_id">
            <?php foreach ($elements as $el) : ?>
                <option value="<?= $el['id'] ?>"><?= $el['nom'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Salle :</label>
        <select name="salle_id">
            <?php foreach ($salles as $salle) : ?>
                <option value="<?= $salle['id'] ?>"><?= $salle['nom'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Jour :</label>
        <select name="jour">
            <option value="Lundi">Lundi</option>
            <option value="Mardi">Mardi</option>
            <option value="Mercredi">Mercredi</option>
            <option value="Jeudi">Jeudi</option>
            <option value="Vendredi">Vendredi</option>
            <option value="Samedi">Samedi</option>
        </select><br>

        <label>Créneau :</label>
        <select name="creneau_id">
            <?php foreach ($creneaux as $cr) : ?>
                <option value="<?= $cr['id'] ?>"><?= $cr['heure_debut'] . " - " . $cr['heure_fin'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Semaine de début :</label>
        <select name="semaine_debut_id">
            <?php foreach ($semaines as $semaine) : ?>
                <option value="<?= $semaine['id'] ?>">Semaine <?= $semaine['semaine'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Semaine de fin :</label>
        <select name="semaine_fin_id">
            <?php foreach ($semaines as $semaine) : ?>
                <option value="<?= $semaine['id'] ?>">Semaine <?= $semaine['semaine'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
