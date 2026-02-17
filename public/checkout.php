<?php
require_once __DIR__ . '/../includes/config.php';
require_once ROOT_PATH . 'includes/db.php';
include ROOT_PATH . 'includes/header.php';

if (empty($_SESSION['panier'])) {
    header('Location: panier.php');
    exit;
}

try {
    $total = 0;
    
    foreach ($_SESSION['panier'] as $id_article => $quantite) {
        $stmtPrice = $pdo->prepare("SELECT prix FROM items WHERE id = ?");
        $stmtPrice->execute([$id_article]);
        $article = $stmtPrice->fetch();
        
        if ($article) {
            $total += (float)$article['prix'] * (int)$quantite;
        }
    }

    $stmt = $pdo->prepare("INSERT INTO invoice (id_user, montant, date_transaction) VALUES (?, ?, NOW())");
    
    $id_user = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
    $stmt->execute([$id_user, $total]);

    unset($_SESSION['panier']); 

    echo "<div class='container mt-5 text-center shadow p-5'>";
    echo "<div class='alert alert-success'><h2>Commande confirmée !</h2></div>";
    echo "<p class='lead'>Le montant de <strong>" . number_format($total, 2) . " €</strong> a été ajouté à l'historique.</p>";
    echo "<a href='index.php' class='btn btn-primary btn-lg'>Continuer mes achats</a>";
    echo "</div>";

} catch (PDOException $e) {
    echo "<div class='container mt-5 alert alert-danger'>";
    echo "Erreur SQL : " . $e->getMessage();
    echo "</div>";
}

include ROOT_PATH . 'includes/footer.php';
?>