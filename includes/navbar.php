<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <style>
        body {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #004080;
            color: white;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            padding: 15px;
            display: block;
            text-decoration: none;
        }
        .sidebar a:hover {
            background: #003366;
        }
        .content {
            flex: 1;
            padding: 20px;
        }
        .header {
            background: white;
            padding: 10px;
            text-align: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        .header img {
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <a href="#">🏠 Tableau de bord</a>
        <a href="#">📅 Emplois du temps</a>
        <a href="#">👨‍🏫 Professeurs</a>
        <a href="#">🏢 Salles</a>
        <a href="#">📚 Modules</a>
        <a href="#">📂 Filières</a>
        <a href="#">⚙️ Paramètres</a>
    </div>
    <div class="content">
        <div class="header">
            <img src="../assets/logo.png" alt="ENSAF Logo">
        </div>
        <h2 data-aos="fade-up">Bienvenue sur le tableau de bord</h2>
        <p data-aos="fade-up" data-aos-delay="200">Gérez facilement vos emplois du temps et ressources académiques.</p>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>
</html>