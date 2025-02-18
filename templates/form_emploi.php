<?php
require '../config.php';
$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
$elements = $pdo->query("SELECT * FROM elements")->fetchAll();
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();
$creneaux = $pdo->query("SELECT * FROM creneaux")->fetchAll();
$semaines = $pdo->query("SELECT * FROM semaines")->fetchAll();
$modules = $pdo->query("SELECT id, code FROM modules")->fetchAll();
$filieres = $pdo->query("SELECT * FROM filiere")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Emploi du Temps</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }
        .form-select, .form-control {
            margin-bottom: 15px;
        }
        button {
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container" data-aos="fade-up">
        <h2 class="text-center mb-4">Ajouter un Emploi du Temps</h2>
        <form action="../actions/add_emploi.php" method="POST">
            <label>Professeur :</label>
            <select name="prof_id" class="form-select">
                <?php foreach ($professeurs as $prof): ?>
                    <option value="<?= $prof['id'] ?>"><?= $prof['nom'] . " " . $prof['prenom'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Filière :</label>
            <select name="filiere_id" class="form-select">
                <option value="">-- Choisir une filière --</option>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?= $filiere['id'] ?>"><?= $filiere['nom'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Module :</label>
            <select name="module_id" class="form-select">
                <option value="">-- Choisir un module --</option>
                <?php foreach ($modules as $module): ?>
                    <option value="<?= $module['id'] ?>"><?= $module['code'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Élément :</label>
            <select name="element_id" class="form-select">
                <?php foreach ($elements as $el): ?>
                    <option value="<?= $el['id'] ?>"><?= $el['nom'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Salle :</label>
            <select name="salle_id" class="form-select">
                <?php foreach ($salles as $salle): ?>
                    <option value="<?= $salle['id'] ?>"><?= $salle['nom'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Jour :</label>
            <select name="jour" class="form-select">
                <option value="Lundi">Lundi</option>
                <option value="Mardi">Mardi</option>
                <option value="Mercredi">Mercredi</option>
                <option value="Jeudi">Jeudi</option>
                <option value="Vendredi">Vendredi</option>
                <option value="Samedi">Samedi</option>
            </select>

            <label>Créneau :</label>
            <select name="creneau_id" class="form-select">
                <?php foreach ($creneaux as $cr): ?>
                    <option value="<?= $cr['id'] ?>"><?= $cr['heure_debut'] . " - " . $cr['heure_fin'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Semaine de début :</label>
            <select name="semaine_debut_id" class="form-select">
                <?php foreach ($semaines as $semaine): ?>
                    <option value="<?= $semaine['id'] ?>">Semaine <?= $semaine['semaine'] ?></option>
                <?php endforeach; ?>
            </select>

            <label>Semaine de fin :</label>
            <select name="semaine_fin_id" class="form-select">
                <?php foreach ($semaines as $semaine): ?>
                    <option value="<?= $semaine['id'] ?>">Semaine <?= $semaine['semaine'] ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>