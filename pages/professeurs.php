<?php
require '../config.php';
$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Professeurs</title>
</head>
<body>
    <h2>Liste des Professeurs</h2>
    <table border="1">
        <tr>
            <th>Nom</th><th>Prénom</th><th>Email</th><th>Téléphone</th>
        </tr>
        <?php foreach ($professeurs as $prof) : ?>
        <tr>
            <td><?= $prof['nom'] ?></td>
            <td><?= $prof['prenom'] ?></td>
            <td><?= $prof['email'] ?></td>
            <td><?= $prof['telephone'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="../templates/form_professeur.php">Ajouter un Professeur</a>
</body>
</html>
