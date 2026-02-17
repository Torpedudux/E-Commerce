<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php';
require_once ROOT_PATH . 'includes/middleware-admin.php';
include ROOT_PATH . 'includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = htmlspecialchars($_POST['nom']);
    $description = htmlspecialchars($_POST['description']);
    $prix = floatval($_POST['prix']);
    $stock = intval($_POST['stock']);

    $image_name = "default.jpg";
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === 0) {
        $upload_dir = ROOT_PATH . 'public/assets/images/';
        
        $extension = pathinfo($_FILES['image_file']['name'], PATHINFO_EXTENSION);
        $image_name = time() . '_' . uniqid() . '.' . $extension;
        $destination = $upload_dir . $image_name;

        move_uploaded_file($_FILES['image_file']['tmp_name'], $destination);
    }

    $stmt = $pdo->prepare("INSERT INTO items (nom, description, prix, image) VALUES (?, ?, ?, ?)");
    $stmt->execute([$nom, $description, $prix, $image_name]);

    $lastId = $pdo->lastInsertId();
    $stmtStock = $pdo->prepare("INSERT INTO stock (id_item, quantite) VALUES (?, ?)");
    $stmtStock->execute([$lastId, $stock]);

    echo "<div class='alert alert-success mt-3'>Produit ajouté avec succès !</div>";
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white text-center">
                    <h3 class="mb-0">Ajouter un nouvel article</h3>
                </div>
                <div class="card-body p-4">
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nom du produit</label>
                            <input type="text" name="nom" class="form-control" placeholder="ex: Clavier Mécanique RGB" required>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Décrivez les caractéristiques de l'objet..."></textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Prix (€)</label>
                                <input type="number" step="0.01" name="prix" class="form-control" placeholder="0.00" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Quantité en stock</label>
                                <input type="number" name="stock" class="form-control" placeholder="ex: 10" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Image du produit</label>
                            <input type="file" name="image_file" class="form-control" accept="image/*" required>
                            <small class="text-muted">Format recommandé : JPG ou PNG (max 2Mo)</small>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Enregistrer l'article
                            </button>
                            <a href="services-list.php" class="btn btn-outline-secondary">Annuler</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>