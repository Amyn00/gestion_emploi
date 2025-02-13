<?php
require '../config.php';

// Récupérer les listes des professeurs et des salles pour les filtres
$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();

// Récupérer les paramètres de filtrage
$filtre_prof = isset($_GET['prof_id']) ? $_GET['prof_id'] : '';
$filtre_jour = isset($_GET['jour']) ? $_GET['jour'] : '';
$filtre_salle = isset($_GET['salle_id']) ? $_GET['salle_id'] : '';

// Construire la requête avec les filtres
$query = "SELECT e.id, p.nom AS prof_nom, el.nom AS element_nom, s.nom AS salle_nom, e.jour, c.heure_debut, c.heure_fin 
          FROM emplois_du_temps e
          JOIN professeurs p ON e.prof_id = p.id
          JOIN elements el ON e.element_id = el.id
          JOIN salles s ON e.salle_id = s.id
          JOIN creneaux c ON e.creneau_id = c.id
          WHERE 1=1";

$params = [];
if ($filtre_prof) {
    $query .= " AND e.prof_id = ?";
    $params[] = $filtre_prof;
}
if ($filtre_jour) {
    $query .= " AND e.jour = ?";
    $params[] = $filtre_jour;
}
if ($filtre_salle) {
    $query .= " AND e.salle_id = ?";
    $params[] = $filtre_salle;
}

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$emplois = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Gestion des Emplois du Temps</title>
</head>
<body>
    <h2>Filtrer les emplois du temps</h2>
    <form method="GET">
        <label>Professeur :</label>
        <select name="prof_id">
            <option value="">-- Tous --</option>
            <?php foreach ($professeurs as $prof) : ?>
                <option value="<?= $prof['id'] ?>" <?= ($filtre_prof == $prof['id']) ? 'selected' : '' ?>>
                    <?= $prof['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Jour :</label>
        <select name="jour">
            <option value="">-- Tous --</option>
            <?php 
            $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'];
            foreach ($jours as $jour) : ?>
                <option value="<?= $jour ?>" <?= ($filtre_jour == $jour) ? 'selected' : '' ?>>
                    <?= $jour ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Salle :</label>
        <select name="salle_id">
            <option value="">-- Toutes --</option>
            <?php foreach ($salles as $salle) : ?>
                <option value="<?= $salle['id'] ?>" <?= ($filtre_salle == $salle['id']) ? 'selected' : '' ?>>
                    <?= $salle['nom'] ?>
                </option>
            <?php endforeach; ?>
        </select>

        <button type="submit">Rechercher</button>
    </form>

    <h2>Liste des emplois du temps</h2>
    <table border="1">
        <tr>
            <th>Professeur</th>
            <th>Élément</th>
            <th>Salle</th>
            <th>Jour</th>
            <th>Créneau</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($emplois as $emploi) : ?>
            <tr>
                <td><?= $emploi['prof_nom'] ?></td>
                <td><?= $emploi['element_nom'] ?></td>
                <td><?= $emploi['salle_nom'] ?></td>
                <td><?= $emploi['jour'] ?></td>
                <td><?= $emploi['heure_debut'] ?> - <?= $emploi['heure_fin'] ?></td>
                <td>
                    <a href="edit_emploi.php?id=<?= $emploi['id'] ?>">Modifier</a> | 
                    <a href="../actions/delete_emploi.php?id=<?= $emploi['id'] ?>" onclick="return confirm('Supprimer cet emploi ?')">Supprimer</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    
    <a href="../templates/form_emploi.php">➕ Ajouter un emploi du temps</a>
    <a href="../actions/export_pdf.php" target="_blank">📄 Exporter en PDF</a>
</body>
</html>
