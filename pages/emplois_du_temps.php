<?php
require '../config.php';

$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();

$filtre_prof = $pdo->query("SELECT * FROM professeurs")->fetchAll();
$filtre_salle = $pdo->query("SELECT * FROM salles")->fetchAll();

$emplois = "SELECT e.id, p.nom AS prof_nom, el.nom AS element_nom, s.nom AS salle_nom, 
e.jour, c.heure_debut, c.heure_fin, 
m.code AS code_module, f.nom AS nom_filiere
FROM emplois_du_temps e
JOIN professeurs p ON e.prof_id = p.id
JOIN elements el ON e.element_id = el.id
JOIN salles s ON e.salle_id = s.id
JOIN creneaux c ON e.creneau_id = c.id
JOIN modules m ON e.module_id = m.id
JOIN filiere f ON e.filiere_id = f.id";
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Emplois du Temps</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
</head>

<body>
    <div class="container mt-4">
        <h2 class="text-center mb-4">Filtrer les emplois du temps</h2>
        <form method="GET" class="row g-3" data-aos="fade-up">
            <div class="col-md-4">
                <label class="form-label">Professeur :</label>
                <select name="prof_id" class="form-select">
                    <option value="">-- Tous --</option>
                    <?php foreach ($professeurs as $prof): ?>
                        <option value="<?= $prof['id'] ?>" <?= ($filtre_prof == $prof['id']) ? 'selected' : '' ?>>
                            <?= $prof['nom'] ," ", $prof['prenom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Jour :</label>
                <select name="jour" class="form-select">
                    <option value="">-- Tous --</option>
                    <?php foreach ($jours as $jour): ?>
                        <option value="<?= $jour ?>" <?= ($filtre_jour == $jour) ? 'selected' : '' ?>>
                            <?= $jour ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-4">
                <label class="form-label">Salle :</label>
                <select name="salle_id" class="form-select">
                    <option value="">-- Toutes --</option>
                    <?php foreach ($salles as $salle): ?>
                        <option value="<?= $salle['id'] ?>" <?= ($filtre_salle == $salle['id']) ? 'selected' : '' ?>>
                            <?= $salle['nom'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i> Rechercher
                </button>
                <a href="emplois_du_temps.php" class="btn btn-secondary">Réinitialiser</a>
            </div>
        </form>

        <h2 class="text-center mt-4" data-aos="fade-up">Liste des emplois du temps</h2>
        <div class="table-responsive" data-aos="fade-up" data-aos-delay="200">
            <table class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>Professeur</th>
                        <th>Filière</th>
                        <th>Module</th>
                        <th>Élément</th>
                        <th>Salle</th>
                        <th>Jour</th>
                        <th>Créneau</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $emplois = [];
                    foreach ($emplois as $emploi): ?>
                        <tr>
                            <td><?= $emploi['prof_nom'] ?></td>
                            <td><?= $emploi['nom_filiere'] ?></td>
                            <td><?= $emploi['code_module'] ?></td>
                            <td><?= $emploi['element_nom'] ?></td>
                            <td><?= $emploi['salle_nom'] ?></td>
                            <td><?= $emploi['jour'] ?></td>
                            <td><?= $emploi['heure_debut'] ?> - <?= $emploi['heure_fin'] ?></td>
                            <td>
                                <a href="edit_emploi.php?id=<?= $emploi['id'] ?>" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="../actions/delete_emploi.php?id=<?= $emploi['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Supprimer cet emploi ?')">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="400">
            <a href="../templates/form_emploi.php" class="btn btn-success">
                <i class="fas fa-plus"></i> Ajouter un emploi du temps
            </a>
            <a href="../actions/export_pdf.php" class="btn btn-info">
                <i class="fas fa-file-pdf"></i> Exporter en PDF
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>