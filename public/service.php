<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php'; 
include ROOT_PATH . 'includes/header.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$stmt = $pdo->prepare("
    SELECT items.*, stock.quantite 
    FROM items 
    LEFT JOIN stock ON items.id = stock.id_item 
    WHERE items.id = ?
");
$stmt->execute([$id]);
$item = $stmt->fetch();

if (!$item) {
    echo "<div class='container mt-5'><p class='alert alert-danger'>Produit introuvable.</p></div>";
} else {
?>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-6">
            <img src="<?= BASE_URL ?>assets/images/<?= htmlspecialchars($item['image']) ?>" 
                 class="img-fluid rounded shadow-sm" 
                 alt="<?= htmlspecialchars($item['nom']) ?>">
        </div>
        <div class="col-md-6">
            <h2 class="fw-bolder"><?= htmlspecialchars($item['nom']) ?></h2>
            <p class="h4 my-3"><?= number_format($item['prix'], 2) ?> €</p>
            <p class="text-muted"><?= nl2br(htmlspecialchars($item['description'])) ?></p>
            <p><strong>Stock disponible :</strong> <?= $item['quantite'] ?></p>
            
            <form action="panier.php" method="POST">
                <input type="hidden" name="id_item" value="<?= $item['id'] ?>">
                <button type="submit" class="btn btn-dark btn-lg mt-3" <?= $item['quantite'] <= 0 ? 'disabled' : '' ?>>
                    <?= $item['quantite'] > 0 ? 'Ajouter au panier' : 'Rupture de stock' ?>
                </button>
            </form>
        </div>
    </div>
</div>
<?php } include '../includes/footer.php'; ?>