<?php
require '../config.php';

if (!isset($_GET['id'])) {
    die("ID manquant");
}

$id = $_GET['id'];

// Récupérer les données de l'emploi du temps à modifier
$stmt = $pdo->prepare("SELECT * FROM emplois_du_temps WHERE id = ?");
$stmt->execute([$id]);
$emploi = $stmt->fetch();

if (!$emploi) {
    die("Emploi du temps introuvable");
}

// Récupérer les listes des professeurs, éléments, salles, créneaux et semaines
$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
$elements = $pdo->query("SELECT * FROM elements")->fetchAll();
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();
$creneaux = $pdo->query("SELECT * FROM creneaux")->fetchAll();
$semaines = $pdo->query("SELECT * FROM semaines")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Modifier un Emploi du Temps</title>
</head>
<body>
    <h2>Modifier un Emploi du Temps</h2>
    <form action="../actions/update_emploi.php" method="POST">
        <input type="hidden" name="id" value="<?= $emploi['id'] ?>">

        <label>Professeur :</label>
        <select name="prof_id">
            <?php foreach ($professeurs as $prof) : ?>
                <option value="<?= $prof['id'] ?>" <?= $prof['id'] == $emploi['prof_id'] ? 'selected' : '' ?>>
                    <?= $prof['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Élément :</label>
        <select name="element_id">
            <?php foreach ($elements as $element) : ?>
                <option value="<?= $element['id'] ?>" <?= $element['id'] == $emploi['element_id'] ? 'selected' : '' ?>>
                    <?= $element['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Salle :</label>
        <select name="salle_id">
            <?php foreach ($salles as $salle) : ?>
                <option value="<?= $salle['id'] ?>" <?= $salle['id'] == $emploi['salle_id'] ? 'selected' : '' ?>>
                    <?= $salle['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Jour :</label>
        <select name="jour">
            <?php 
            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            foreach ($jours as $jour) : ?>
                <option value="<?= $jour ?>" <?= $jour == $emploi['jour'] ? 'selected' : '' ?>>
                    <?= $jour ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Créneau :</label>
        <select name="creneau_id">
            <?php foreach ($creneaux as $creneau) : ?>
                <option value="<?= $creneau['id'] ?>" <?= $creneau['id'] == $emploi['creneau_id'] ? 'selected' : '' ?>>
                    <?= $creneau['heure_debut'] ?> - <?= $creneau['heure_fin'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Semaine de début :</label>
        <select name="semaine_debut_id">
            <?php foreach ($semaines as $semaine) : ?>
                <option value="<?= $semaine['id'] ?>" <?= $semaine['id'] == $emploi['semaine_debut_id'] ? 'selected' : '' ?>>
                    Semaine <?= $semaine['semaine'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <label>Semaine de fin :</label>
        <select name="semaine_fin_id">
            <?php foreach ($semaines as $semaine) : ?>
                <option value="<?= $semaine['id'] ?>" <?= $semaine['id'] == $emploi['semaine_fin_id'] ? 'selected' : '' ?>>
                    Semaine <?= $semaine['semaine'] ?>
                </option>
            <?php endforeach; ?>
        </select><br>

        <button type="submit">Modifier</button>
    </form>
</body>
</html>
