<?php
require '../config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $departement_id = $_POST['departement_id'];

    $stmt = $pdo->prepare("INSERT INTO filiere (nom, departement_id) VALUES (?, ?)");
    $stmt->execute([$nom, $departement_id]);

    header("Location: ../templates/filieres.php");
    exit();
}
?>