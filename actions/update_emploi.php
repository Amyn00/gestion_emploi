<?php
require '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stmt = $pdo->prepare("UPDATE emplois_du_temps SET 
        prof_id = ?, 
        element_id = ?, 
        salle_id = ?, 
        jour = ?, 
        semaine_debut_id = ?, 
        semaine_fin_id = ?, 
        creneau_id = ? 
        WHERE id = ?");

    $stmt->execute([
        $_POST['prof_id'],
        $_POST['element_id'],
        $_POST['salle_id'],
        $_POST['jour'],
        $_POST['semaine_debut_id'],
        $_POST['semaine_fin_id'],
        $_POST['creneau_id'],
        $_POST['id']
    ]);

    header("Location: ../pages/emplois_du_temps.php");
}
?>
