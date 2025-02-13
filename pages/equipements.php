<?php
require '../config.php';
$equipements = $pdo->query("SELECT * FROM equipements")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Liste des Équipements</title>
</head>
<body>
    <h2>Liste des Équipements</h2>
    <table border="1">
        <tr>
            <th>Nom</th>
        </tr>
        <?php foreach ($equipements as $equip) : ?>
        <tr>
            <td><?= $equip['nom'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../templates/form_equipement.php">Ajouter un Équipement</a>
</body>
</html>
