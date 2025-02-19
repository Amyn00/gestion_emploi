<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Salle</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-light">

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-lg p-4 w-50">
        <h3 class="text-center mb-4">Ajouter une Salle</h3>
        
        <form action="../actions/add_salle.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Nom de la salle</label>
                <input type="text" name="nom" class="form-control" placeholder="Nom de la salle" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Capacité</label>
                <input type="number" name="capacite" class="form-control" placeholder="Capacité" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Ajouter
                </button>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>