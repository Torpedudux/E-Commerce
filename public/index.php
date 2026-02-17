<?php
require_once __DIR__ . '/../includes/config.php';
require_once ROOT_PATH . 'includes/db.php';
include ROOT_PATH . 'includes/header.php';
?>

<header class="bg-dark py-5 mb-5" style="background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('assets/img/banner.jpg'); background-size: cover;">
    <div class="container px-4 px-lg-5 my-5">
        <div class="text-center text-white">
            <h1 class="display-4 fw-bolder">Bienvenue chez Torpedux</h1>
            <p class="lead fw-normal text-white-50 mb-0">Découvrez notre collection exclusive</p>
            <a class="btn btn-outline-light btn-lg mt-3" href="services.php">Voir le catalogue</a>
        </div>
    </div>
</header>

<div class="container">
    <h2 class="pb-2 border-bottom mb-4">Quelques produits en avant</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php
        try {
            $stmt = $pdo->query("SELECT * FROM items ORDER BY date_publication DESC LIMIT 3");
            while ($item = $stmt->fetch()) {
                ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= BASE_URL ?>assets/images/<?= htmlspecialchars($item['image']) ?>" 
                             class="card-img-top" 
                             alt="<?= htmlspecialchars($item['nom']) ?>">
    
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['nom']) ?></h5>
                            <p class="card-text text-muted"><?= substr(htmlspecialchars($item['description']), 0, 100) ?>...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0"><?= number_format($item['prix'], 2) ?> €</span>
                                <a href="service.php?id=<?= $item['id'] ?>" class="btn btn-sm btn-outline-primary">Détails</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        } catch (PDOException $e) {
            echo "<p class='alert alert-warning'>Ajoutez des produits dans le back-office pour les voir ici !</p>";
        }
        ?>
    </div>
</div>

<?php 
include '../includes/footer.php'; 
?>