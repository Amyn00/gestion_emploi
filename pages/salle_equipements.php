<?php
require '../config.php';
$query = "
    SELECT s.nom AS salle, e.nom AS equipement, se.quantite 
    FROM salle_equipements se
    JOIN salles s ON se.salle_id = s.id
    JOIN equipements e ON se.equipement_id = e.id
";
$salle_equipements = $pdo->query($query)->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Équipements des Salles</title>
</head>
<body>
    <h2>Équipements des Salles</h2>
    <table border="1">
        <tr>
            <th>Salle</th><th>Équipement</th><th>Quantité</th>
        </tr>
        <?php foreach ($salle_equipements as $se) : ?>
        <tr>
            <td><?= $se['salle'] ?></td>
            <td><?= $se['equipement'] ?></td>
            <td><?= $se['quantite'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../templates/form_salle_equipement.php">Associer un Équipement à une Salle</a>
</body>
</html>
