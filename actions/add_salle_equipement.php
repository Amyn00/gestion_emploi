<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salle_id = $_POST['salle_id'];
    $equipement_id = $_POST['equipement_id'];
    $quantite = $_POST['quantite'];

    $stmt = $pdo->prepare("INSERT INTO salle_equipements (salle_id, equipement_id, quantite) VALUES (?, ?, ?)");
    $stmt->execute([$salle_id, $equipement_id, $quantite]);

    header("Location: ../pages/salle_equipements.php");
}
?>
