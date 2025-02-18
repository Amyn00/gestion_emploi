<?php
require '../config.php';

// Récupérer la liste des filières avec leur département associé
$filieres = $pdo->query("SELECT f.id, f.nom, d.nom AS departement_nom 
                         FROM filiere f
                         JOIN departement d ON f.departement_id = d.id")->fetchAll();

// Récupérer la liste des départements pour le formulaire d'ajout
$departements = $pdo->query("SELECT * FROM departement")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion des Filières</title>
</head>
<body>
    <h2>Liste des Filières</h2>
    <table border="1">
        <tr>
            <th>Nom</th>
            <th>Département</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($filieres as $filiere) : ?>
            <tr>
                <td><?= $filiere['nom'] ?></td>
                <td><?= $filiere['departement_nom'] ?></td>
                <td>
                    <a href="edit_filiere.php?id=<?= $filiere['id'] ?>">Modifier</a> | 
                    <a href="../actions/delete_filiere.php?id=<?= $filiere['id'] ?>" onclick="return confirm('Supprimer cette filière ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Ajouter une Filière</h2>
    <form action="../actions/insert_filiere.php" method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" required>
        
        <label>Département :</label>
        <select name="departement_id" required>
            <option value="">-- Choisir un département --</option>
            <?php foreach ($departements as $departement) : ?>
                <option value="<?= $departement['id'] ?>"><?= $departement['nom'] ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Ajouter</button>
    </form>

    <a href="../index.php">🏠 Retour à l'accueil</a>
</body>
</html>