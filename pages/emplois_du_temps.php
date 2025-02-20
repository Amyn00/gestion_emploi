<?php
require '../config.php';

// Récupérer les valeurs des filtres
$prof_id = isset($_GET['prof_id']) ? (int)$_GET['prof_id'] : null;
$filiere_id = isset($_GET['filiere_id']) ? (int)$_GET['filiere_id'] : null;
$salle_id = isset($_GET['salle_id']) ? (int)$_GET['salle_id'] : null;

// Définir le nombre d'emplois par page
$limit = 10; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

// Construire la requête SQL avec les filtres
$query = "SELECT 
    e.id, 
    p.nom AS prof_nom, p.prenom AS prof_prenom,
    f.nom AS nom_filiere,
    m.code AS code_module, 
    el.nom AS element_nom,  
    e.jour, 
    c.heure_debut, c.heure_fin,
    e.semaine_debut_id AS semaine_debut,
    e.semaine_fin_id AS semaine_fin,
    s.nom AS salle
FROM emplois_du_temps e
JOIN professeurs p ON e.prof_id = p.id
JOIN elements el ON e.element_id = el.id
JOIN salles s ON e.salle_id = s.id
JOIN creneaux c ON e.creneau_id = c.id
JOIN modules m ON e.module_id = m.id
JOIN filiere f ON e.filiere_id = f.id
ORDER BY nom_filiere AND e.jour"; 

if ($prof_id) $query .= " AND e.prof_id = $prof_id";
if ($filiere_id) $query .= " AND e.filiere_id = $filiere_id";
if ($salle_id) $query .= " AND e.salle_id = $salle_id";

// Récupérer le nombre total d'emplois (pour la pagination)
$count_query = str_replace("SELECT e.id, p.nom AS prof_nom, p.prenom AS prof_prenom, f.nom AS nom_filiere, m.code AS code_module, el.nom AS element_nom, e.jour, c.heure_debut, c.heure_fin, e.semaine_debut_id AS semaine_debut, e.semaine_fin_id AS semaine_fin, s.nom AS salle", "SELECT COUNT(*) AS total", $query);
$total_emplois = $pdo->query($count_query)->fetchColumn();

$query .= " LIMIT $limit OFFSET $offset";
$emplois = $pdo->query($query)->fetchAll();

// Récupérer les filtres
$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
$filieres = $pdo->query("SELECT * FROM filiere")->fetchAll();
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Emplois du Temps</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
<div class="container mt-4">
    <h2 class="text-center mb-4">Filtrer les emplois du temps</h2>

    <form method="GET" class="row g-3">
        <div class="col-md-4">
            <label class="form-label">Professeur :</label>
            <select name="prof_id" class="form-select">
                <option value="">-- Tous --</option>
                <?php foreach ($professeurs as $prof): ?>
                    <option value="<?= $prof['id'] ?>" <?= ($prof_id == $prof['id']) ? 'selected' : '' ?>>
                        <?= $prof['nom'] . " " . $prof['prenom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Filière :</label>
            <select name="filiere_id" class="form-select">
                <option value="">-- Toutes --</option>
                <?php foreach ($filieres as $filiere): ?>
                    <option value="<?= $filiere['id'] ?>" <?= ($filiere_id == $filiere['id']) ? 'selected' : '' ?>>
                        <?= $filiere['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Salle :</label>
            <select name="salle_id" class="form-select">
                <option value="">-- Toutes --</option>
                <?php foreach ($salles as $salle): ?>
                    <option value="<?= $salle['id'] ?>" <?= ($salle_id == $salle['id']) ? 'selected' : '' ?>>
                        <?= $salle['nom'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-12 text-center">
            <button type="submit" class="btn btn-primary">Rechercher</button>
            <a href="emplois_du_temps.php" class="btn btn-secondary">Réinitialiser</a>
        </div>
    </form>

    <h2 class="text-center mt-4">Liste des emplois du temps</h2>

    <div class="text-center mb-3">
        <a href="../templates/form_emploi.php" class="btn btn-success">
            <i class="fa fa-plus"></i> Ajouter un emploi
        </a>
        <a href="../actions/export_pdf.php" class="btn btn-info">
            <i class="fa fa-file-pdf"></i> Exporter en PDF
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Professeur</th>
                    <th>Filière</th>
                    <th>Module</th>
                    <th>Élément</th>
                    <th>Jour</th>
                    <th>Créneau</th>
                    <th>Semaine</th>
                    <th>Salle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($emplois as $emploi): ?>
                    <tr>
                        <td><?= $emploi['prof_nom'] ?> <?= $emploi['prof_prenom'] ?></td>
                        <td><?= $emploi['nom_filiere'] ?></td>
                        <td><?= $emploi['code_module'] ?></td>
                        <td><?= $emploi['element_nom'] ?></td>
                        <td><?= $emploi['jour'] ?></td>
                        <td><?= $emploi['heure_debut'] ?> - <?= $emploi['heure_fin'] ?></td>
                        <td><?= $emploi['semaine_debut'] ?> - <?= $emploi['semaine_fin'] ?></td>
                        <td><?= $emploi['salle'] ?></td>
                        <td>
                            <a href="edit_emploi.php?id=<?= $emploi['id'] ?>" class="btn btn-warning btn-sm">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="../actions/delete_emploi.php?id=<?= $emploi['id'] ?>" class="btn btn-danger btn-sm"
                               onclick="return confirm('Supprimer cet emploi ?')">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php for ($i = 1; $i <= ceil($total_emplois / $limit); $i++): ?>
                <li class="page-item <?= ($page == $i) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
        </ul>
    </nav>
</div>
</body>
</html>