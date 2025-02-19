<?php
require '../config.php';
$salles = $pdo->query("SELECT * FROM salles")->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Salles</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow p-4">
        <h3 class="text-center mb-4">Liste des Salles</h3>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>Capacité</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($salles as $salle) : ?>
                <tr>
                    <td><?= htmlspecialchars($salle['nom']) ?></td>
                    <td><?= htmlspecialchars($salle['capacite']) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div class="text-center mt-3">
            <a href="../templates/form_salle.php" class="btn btn-primary">
                <i class="fas fa-plus"></i> Ajouter une Salle
            </a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
