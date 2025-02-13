<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $capacite = $_POST['capacite'];

    $stmt = $pdo->prepare("INSERT INTO salles (nom, capacite) VALUES (?, ?)");
    $stmt->execute([$nom, $capacite]);

    header("Location: ../pages/salles.php");
}
?>
