<?php
require '../config.php';
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();
$equipements = $pdo->query("SELECT * FROM equipements")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Associer un Équipement</title>
</head>
<body>
    <h2>Associer un Équipement à une Salle</h2>
    <form action="../actions/add_salle_equipement.php" method="POST">
        <label>Salle :</label>
        <select name="salle_id">
            <?php foreach ($salles as $salle) : ?>
                <option value="<?= $salle['id'] ?>"><?= $salle['nom'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Équipement :</label>
        <select name="equipement_id">
            <?php foreach ($equipements as $equip) : ?>
                <option value="<?= $equip['id'] ?>"><?= $equip['nom'] ?></option>
            <?php endforeach; ?>
        </select><br>

        <label>Quantité :</label>
        <input type="number" name="quantite" min="1" required><br>

        <button type="submit">Associer</button>
    </form>
</body>
</html>
