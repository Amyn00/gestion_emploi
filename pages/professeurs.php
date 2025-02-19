<?php
require '../config.php';

// Récupération des professeurs
$professeurs = $pdo->query("SELECT * FROM professeurs")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Professeurs</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4 text-center">Liste des Professeurs</h2>

    <!-- Bouton pour ajouter un professeur -->
    <div class="d-flex justify-content-end mb-3">
        <a href="../templates/form_professeur.php" class="btn btn-primary">
            <i class="fas fa-user-plus"></i> Ajouter un Professeur
        </a>
    </div>

    <!-- Tableau des professeurs -->
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($professeurs as $prof) : ?>
                <tr>
                    <td><?= htmlspecialchars($prof['nom']) ?></td>
                    <td><?= htmlspecialchars($prof['prenom']) ?></td>
                    <td><?= htmlspecialchars($prof['email']) ?></td>
                    <td><?= htmlspecialchars($prof['telephone']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>