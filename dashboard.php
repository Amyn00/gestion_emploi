<?php
require './config.php';
include './includes/header.php';
include './includes/sidebar.php';

// Récupération des statistiques depuis la base de données
$nb_professeurs = $pdo->query("SELECT COUNT(*) FROM professeurs")->fetchColumn();
$nb_salles = $pdo->query("SELECT COUNT(*) FROM salles")->fetchColumn();
$nb_filere = $pdo->query("SELECT COUNT(*) FROM filiere")->fetchColumn();
?>
<!-- Contenu principal -->
<div class="content p-4 w-100">
    <div class="wrapper">
        <div class="container mt-4">
            <!-- Barre de navigation supérieure -->
            <header class="bg-white shadow-sm py-3 d-flex justify-content-center">
                <img src="./assets/logo.png" alt="ENSAF" class="logo">
            </header>
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
                        <h5 class="mt-3">Filéres</h5>
                        <p class="fs-4"><?= $nb_filere ?></p>
                    </div>
                </div>
            </div>
        </div>

        <?php include './includes/footer.php'; ?>
    </div> <!-- Fin du contenu principal -->

</div> <!-- Fin du wrapper -->