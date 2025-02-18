<?php
require '../config.php';

$id = $_GET['id'];
$filiere = $pdo->prepare("SELECT * FROM filiere WHERE id = ?");
$filiere->execute([$id]);
$filiere = $filiere->fetch();

$departements = $pdo->query("SELECT * FROM departement")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $departement_id = $_POST['departement_id'];
    
    $stmt = $pdo->prepare("UPDATE filiere SET nom = ?, departement_id = ? WHERE id = ?");
    $stmt->execute([$nom, $departement_id, $id]);

    header("Location: filieres.php");
    exit();
}
?>

<form method="POST">
    <label>Nom :</label>
    <input type="text" name="nom" value="<?= $filiere['nom'] ?>" required>

    <label>Département :</label>
    <select name="departement_id">
        <?php foreach ($departements as $departement) : ?>
            <option value="<?= $departement['id'] ?>" <?= ($filiere['departement_id'] == $departement['id']) ? 'selected' : '' ?>>
                <?= $departement['nom'] ?>
            </option>
        <?php endforeach; ?>
    </select>
    
    <button type="submit">Modifier</button>
</form>