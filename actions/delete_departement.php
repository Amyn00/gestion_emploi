<?php
require '../config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Vérifier s'il y a des filières associées avant suppression
    $check = $pdo->prepare("SELECT COUNT(*) FROM filiere WHERE departement_id = ?");
    $check->execute([$id]);
    if ($check->fetchColumn() > 0) {
        echo "Impossible de supprimer ce département : des filières y sont encore associées.";
        exit();
    }

    $stmt = $pdo->prepare("DELETE FROM departement WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: ../templates/departements.php");
    exit();
}
?>