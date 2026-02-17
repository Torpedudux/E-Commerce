<?php
require_once __DIR__ . '/../includes/config.php';
require_once ROOT_PATH . 'includes/db.php';
include ROOT_PATH . 'includes/header.php';
?>

<div class="container mt-5">
    <h1>Tableau de bord Torpedux</h1>
    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card bg-primary text-white p-3 shadow-sm">
                <h3>Produits</h3>
                <a href="services-list.php" class="text-white">Gérer le catalogue</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-success text-white p-3 shadow-sm">
                <h3>Commandes</h3>
                <a href="commandes-list.php" class="text-white">Voir les ventes</a>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-dark text-white p-3 shadow-sm">
                <h3>Utilisateurs</h3>
                <a href="utilisateurs-list.php" class="text-white">Gérer les membres</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>