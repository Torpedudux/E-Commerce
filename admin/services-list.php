<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php';
require_once ROOT_PATH . 'includes/middleware-admin.php';
include ROOT_PATH . 'includes/header.php';

$stmt = $pdo->query("SELECT items.*, stock.quantite FROM items LEFT JOIN stock ON items.id = stock.id_item");
$items = $stmt->fetchAll();
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Gestion du Catalogue</h2>
        <a href="service-ajout.php" class="btn btn-primary">Ajouter un produit</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                <th>Nom</th>
                <th>Description</th> <th>Prix</th>
                <th>Stock</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = $pdo->query("SELECT items.*, stock.quantite 
                                  FROM items 
                                  LEFT JOIN stock ON items.id = stock.id_item 
                                  ORDER BY items.id DESC");

            while ($product = $query->fetch()): ?>
                <tr>
                    <td class="align-middle">
                        <img src="<?= BASE_URL ?>assets/images/<?= htmlspecialchars($product['image']) ?>" 
                            alt="Produit" 
                            style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                    </td>
                    <td class="align-middle fw-bold"><?= htmlspecialchars($product['nom']) ?></td>
                    <td class="align-middle text-muted" style="max-width: 250px; font-size: 0.9em;">
                        <?= htmlspecialchars($product['description']) ?>
                    </td>
                    <td class="align-middle"><?= formatPrice($product['prix']) ?></td>
                    <td class="align-middle">
                        <span class="badge <?= $product['quantite'] > 0 ? 'bg-success' : 'bg-danger' ?>">
                            <?= $product['quantite'] ?> en stock
                    </span>
                    </td>
                    <td class="align-middle">
                        <div class="btn-group" role="group">
                            <a href="service-edit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-warning">
                                Modifier
                            </a>
        
                            <a href="service-delete.php?id=<?= $product['id'] ?>" 
                               class="btn btn-sm btn-danger" 
                               onclick="return confirm('Es-tu sûre de vouloir supprimer cet article et son image ?')">
                                Supprimer
                            </a>
                        </div>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>