<?php
require './config.php';

// Récupération des statistiques depuis la base de données
$nb_professeurs = $pdo->query("SELECT COUNT(*) FROM professeurs")->fetchColumn();
$nb_salles = $pdo->query("SELECT COUNT(*) FROM salles")->fetchColumn();
$nb_emplois = $pdo->query("SELECT COUNT(*) FROM emplois_du_temps")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Gestion des Emplois du Temps</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #004a99;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .card {
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Gestion Emplois</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="emplois_du_temps.php">Emplois du Temps</a></li>
                    <li class="nav-item"><a class="nav-link" href="settings.php">Paramètres</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
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
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>