<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Professeur</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4 shadow-lg" style="width: 400px;">
        <h3 class="text-center mb-4">Ajouter un Professeur</h3>
        
        <form action="../actions/add_professeur.php" method="POST">
            <!-- Nom -->
            <div class="mb-3">
                <label class="form-label">Nom</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="nom" class="form-control" placeholder="Entrez le nom" required>
                </div>
            </div>

            <!-- Prénom -->
            <div class="mb-3">
                <label class="form-label">Prénom</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                    <input type="text" name="prenom" class="form-control" placeholder="Entrez le prénom" required>
                </div>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label class="form-label">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="exemple@mail.com" required>
                </div>
            </div>

            <!-- Téléphone -->
            <div class="mb-3">
                <label class="form-label">Téléphone</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                    <input type="text" name="telephone" class="form-control" placeholder="06XXXXXXXX">
                </div>
            </div>

            <!-- Boutons -->
            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Ajouter</button>
                <a href="../pages/professeurs.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Retour</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>