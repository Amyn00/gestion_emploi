<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter une Salle</title>
</head>
<body>
    <h2>Ajouter une Salle</h2>
    <form action="../actions/add_salle.php" method="POST">
        <input type="text" name="nom" placeholder="Nom de la salle" required><br>
        <input type="number" name="capacite" placeholder="Capacité" required><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
