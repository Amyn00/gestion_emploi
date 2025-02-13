<?php
require '../config.php';

// Récupérer les statistiques
$nb_profs = $pdo->query("SELECT COUNT(*) FROM professeurs")->fetchColumn();
$nb_salles = $pdo->query("SELECT COUNT(*) FROM salles")->fetchColumn();
$nb_elements = $pdo->query("SELECT COUNT(*) FROM elements")->fetchColumn();
$nb_emplois = $pdo->query("SELECT COUNT(*) FROM emplois_du_temps")->fetchColumn();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
    <h2>Tableau de bord</h2>
    
    <div>
        <h3>Statistiques</h3>
        <ul>
            <li>📚 Nombre de professeurs : <strong><?= $nb_profs ?></strong></li>
            <li>🏫 Nombre de salles : <strong><?= $nb_salles ?></strong></li>
            <li>📖 Nombre d'éléments : <strong><?= $nb_elements ?></strong></li>
            <li>📅 Nombre d'emplois du temps : <strong><?= $nb_emplois ?></strong></li>
        </ul>
    </div>

    <div>
        <h3>Accès rapide</h3>
        <ul>
            <li><a href="emplois_du_temps.php">📅 Gérer les emplois du temps</a></li>
            <li><a href="form_emploi.php">➕ Ajouter un emploi du temps</a></li>
            <li><a href="professeurs.php">👨‍🏫 Voir les professeurs</a></li>
            <li><a href="salles.php">🏫 Voir les salles</a></li>
        </ul>
    </div>

</body>
</html>
