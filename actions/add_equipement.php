<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];

    $stmt = $pdo->prepare("INSERT INTO equipements (nom) VALUES (?)");
    $stmt->execute([$nom]);

    header("Location: ../pages/equipements.php");
}
?>
