<?php
require '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $pdo->prepare("DELETE FROM filiere WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: ../templates/filieres.php");
    exit();
}
?>