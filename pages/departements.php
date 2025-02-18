<?php
require '../config.php';

// Récupérer la liste des départements
$departements = $pdo->query("SELECT * FROM departement")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion des Départements</title>
</head>
<body>
    <h2>Liste des Départements</h2>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($departements as $departement) : ?>
            <tr>
                <td><?= $departement['nom'] ?></td>
                <td>
                    <a href="edit_departement.php?id=<?= $departement['id'] ?>">Modifier</a> | 
                    <a href="../actions/delete_departement.php?id=<?= $departement['id'] ?>" onclick="return confirm('Supprimer ce département ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter un Département</h2>
    <form action="../actions/insert_departement.php" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        <button type="submit">Ajouter</button>
    </form>

    <a href="../index.php">🏠 Retour à l'accueil</a>
</body>
</html>