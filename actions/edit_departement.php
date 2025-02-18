<?php
require '../config.php';

$id = $_GET['id'];
$departement = $pdo->prepare("SELECT * FROM departement WHERE id = ?");
$departement->execute([$id]);
$departement = $departement->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $stmt = $pdo->prepare("UPDATE departement SET nom = ? WHERE id = ?");
    $stmt->execute([$nom, $id]);

    header("Location: departements.php");
    exit();
}
?>

<form method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= $departement['nom'] ?>" required>
    <button type="submit">Modifier</button>
</form>