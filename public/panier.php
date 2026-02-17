<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php'; 
include ROOT_PATH . 'includes/header.php';

if (!isset($_SESSION['panier'])) {
    $_SESSION['panier'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_item'])) {
    $id = intval($_POST['id_item']);
    $_SESSION['panier'][$id] = ($_SESSION['panier'][$id] ?? 0) + 1;
}

if (isset($_GET['remove'])) {
    unset($_SESSION['panier'][intval($_GET['remove'])]);
}
?>

<div class="container mt-5">
    <h2>Votre Panier - Torpedux Store</h2>
    <table class="table mt-4">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            if (!empty($_SESSION['panier'])) {
                foreach ($_SESSION['panier'] as $id => $quantite) {
                    $stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
                    $stmt->execute([$id]);
                    $item = $stmt->fetch();
                    if ($item) {
                        $sous_total = $item['prix'] * $quantite;
                        $total += $sous_total;
                        echo "<tr>";
                            echo "<td>" . htmlspecialchars($item['nom']) . "</td>";
                            echo "<td>" . formatPrice($item['prix']) . "</td>";
                            echo "<td>" . $quantite . "</td>";
                            echo "<td><a href='panier.php?remove=$id' class='btn btn-danger btn-sm'>Supprimer</a></td>";
                        echo "</tr>";
                    }
                }
            }
            ?>
        </tbody>
    </table>
    <h3>Total : <?= formatPrice($total) ?></h3>
    <a href="checkout.php" class="btn btn-success <?= $total == 0 ? 'disabled' : '' ?>">Valider la commande</a>
</div>

<?php include '../includes/footer.php'; ?>