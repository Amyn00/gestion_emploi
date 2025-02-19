<?php
require './config.php';
include './includes/header.php';
include './includes/sidebar.php';

// Récupération des statistiques depuis la base de données
$nb_professeurs = $pdo->query("SELECT COUNT(*) FROM professeurs")->fetchColumn();
$nb_salles = $pdo->query("SELECT COUNT(*) FROM salles")->fetchColumn();
$nb_emplois = $pdo->query("SELECT COUNT(*) FROM emplois_du_temps")->fetchColumn();
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-4" data-aos="fade-up">
            <div class="card shadow-sm text-center p-4">
                <i class="fas fa-chalkboard-teacher fa-3x text-primary"></i>
                <h5 class="mt-3">Professeurs</h5>
                <p class="fs-4"><?= $nb_professeurs ?></p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
            <div class="card shadow-sm text-center p-4">
                <i class="fas fa-building fa-3x text-success"></i>
                <h5 class="mt-3">Salles</h5>
                <p class="fs-4"><?= $nb_salles ?></p>
            </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="400">
            <div class="card shadow-sm text-center p-4">
                <i class="fas fa-calendar-alt fa-3x text-danger"></i>
                <h5 class="mt-3">Emplois du Temps</h5>
                <p class="fs-4"><?= $nb_emplois ?></p>
            </div>
        </div>
    </div>
</div>

<?php include './includes/footer.php'; ?>