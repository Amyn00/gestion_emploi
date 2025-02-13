<?php
require '../config.php';
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Salles</title>
</head>
<body>
    <h2>Liste des Salles</h2>
    <table border="1">
        <tr>
            <th>Nom</th><th>Capacité</th>
        </tr>
        <?php foreach ($salles as $salle) : ?>
        <tr>
            <td><?= $salle['nom'] ?></td>
            <td><?= $salle['capacite'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../templates/form_salle.php">Ajouter une Salle</a>
</body>
</html>
