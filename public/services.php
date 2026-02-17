<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php'; 
include ROOT_PATH . 'includes/header.php'; 

$stmt = $pdo->query("SELECT * FROM items");
$items = $stmt->fetchAll();
?>

<h2 class="my-4">Notre Catalogue</h2>
<div class="row">
    <?php foreach ($items as $item): ?>
    <div class="col-md-4 mb-4">
        <div class="card h-100">
            <img src="<?= BASE_URL ?>assets/images/<?= htmlspecialchars($item['image']) ?>" 
                 class="card-img-top" 
                 alt="<?= htmlspecialchars($item['nom']) ?>">
            <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($item['nom']) ?></h5>
                <p class="card-text text-truncate"><?= htmlspecialchars($item['description']) ?></p>
                <p class="fw-bold"><?= $item['prix'] ?> €</p>
                <a href="service.php?id=<?= $item['id'] ?>" class="btn btn-info text-white">Détails</a>
                <form action="panier.php" method="POST" class="d-inline">
                    <input type="hidden" name="id_item" value="<?= $item['id'] ?>">
                    <button type="submit" name="ajouter" class="btn btn-success">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
</div>

<?php include '../includes/footer.php'; ?>