<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("INSERT INTO professeurs (nom, prenom, email, telephone) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $prenom, $email, $telephone]);

    header("Location: ../pages/professeurs.php");
}
?>
