<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];

    $stmt = $pdo->prepare("INSERT INTO departement (nom) VALUES (?)");
    $stmt->execute([$nom]);

    header("Location: ../templates/departements.php");
    exit();
}
?>