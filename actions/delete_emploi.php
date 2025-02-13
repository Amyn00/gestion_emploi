<?php
require '../config.php';

if (isset($_GET['id'])) {
    $stmt = $pdo->prepare("DELETE FROM emplois_du_temps WHERE id = ?");
    $stmt->execute([$_GET['id']]);
}

header("Location: ../pages/emplois_du_temps.php");
?>
