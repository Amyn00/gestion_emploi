<?php
session_start(); // Démarrer la session

// Inclusion du fichier de connexion à la base de données
require_once __DIR__ . '/db.php';

// Configuration générale
define("SITE_NAME", "Gestion des Emplois du Temps");
define("BASE_URL", "http://localhost/gestion_emploi");

// Définir le fuseau horaire
date_default_timezone_set("Africa/Casablanca");
?>