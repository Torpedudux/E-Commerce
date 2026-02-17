<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Torpedux Store</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Torpedux Store</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>index.php">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>services.php">Articles</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>qui-sommes-nous.php">Qui sommes-nous ?</a></li>
    
                <?php if(isset($_SESSION['user_id'])): ?>
                    <?php if($_SESSION['user_role'] === 'admin'): ?>
                        <li class="nav-item"><a class="nav-link fw-bold text-warning" href="<?= BASE_URL ?>../admin/index.php">⚙️ Gestion Admin</a></li>
                    <?php endif; ?>
        
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>panier.php">Panier</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>deconnexion.php">Déconnexion</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>connexion.php">Connexion</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= BASE_URL ?>inscription.php">Inscription</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<body class="d-flex flex-column min-vh-100">
    <main class="flex-grow-1 container mt-4">