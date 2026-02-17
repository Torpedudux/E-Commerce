<?php
require_once __DIR__ . '/../includes/config.php';
require_once ROOT_PATH . 'includes/db.php';
require_once ROOT_PATH . 'includes/middleware-admin.php';
include ROOT_PATH . 'includes/header.php';

$id = intval($_GET['id']);
$stmt = $pdo->prepare("SELECT items.*, stock.quantite FROM items 
                       LEFT JOIN stock ON items.id = stock.id_item 
                       WHERE items.id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $desc = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);
    $stock = intval($_POST['stock']);
    $image_name = $item['image'];

    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        $upload_dir = ROOT_PATH . 'public/assets/images/';
        $extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '_' . uniqid() . '.' . $extension;
        $destination = $upload_dir . $image_name;

        move_uploaded_file($_FILES['image_file']['tmp_name'], $destination);
    }

    $stmt = $pdo->prepare("UPDATE items SET nom = ?, description = ?, prix = ?, image = ? WHERE id = ?");
    $stmt->execute([$nom, $desc, $prix, $image_name, $id]);

    $stmtStock = $pdo->prepare("UPDATE stock SET quantite = ? WHERE id_item = ?");
    $stmtStock->execute([$stock, $id]);

    header('Location: services-list.php');
}
?>

<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8 card shadow p-4">
            <h2 class="text-center mb-4">Modifier : <?= htmlspecialchars($item['nom']) ?></h2>
            
            <form method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Nom du produit</label>
                        <input type="text" name="nom" class="form-control" value="<?= htmlspecialchars($item['nom']) ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Prix (€)</label>
                        <input type="number" step="0.01" name="prix" class="form-control" value="<?= $item['prix'] ?>" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="description" class="form-control" rows="3"><?= htmlspecialchars($item['description']) ?></textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Quantité en stock</label>
                        <input type="number" name="stock" class="form-control" value="<?= $item['quantite'] ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Changer l'image (Optionnel)</label>
                        <input type="file" name="image_file" class="form-control">
                        <small class="text-muted">Image actuelle : <?= $item['image'] ?></small>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-warning btn-lg">Enregistrer les modifications</button>
                    <a href="services-list.php" class="btn btn-outline-secondary">Annuler et revenir</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include ROOT_PATH . 'includes/footer.php'; ?>