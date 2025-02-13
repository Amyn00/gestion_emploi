<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Ajouter un Professeur</title>
</head>
<body>
    <h2>Ajouter un Professeur</h2>
    <form action="../actions/add_professeur.php" method="POST">
        <input type="text" name="nom" placeholder="Nom" required><br>
        <input type="text" name="prenom" placeholder="Prénom" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="telephone" placeholder="Téléphone"><br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>
