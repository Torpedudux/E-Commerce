<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php';
require_once ROOT_PATH . 'includes/middleware-admin.php';
include ROOT_PATH . 'includes/header.php';

$stmt = $pdo->query("SELECT invoice.*, users.nom, users.email 
                     FROM invoice 
                     JOIN users ON invoice.id_user = users.id 
                     ORDER BY date_transaction DESC");
$commandes = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2>Historique des Ventes</h2>

    <?php if (empty($commandes)): ?>
        <div class="alert alert-info">
            Aucune vente n'a été enregistrée pour le moment.
            <br><br>
            <a href="services-list.php" class="btn btn-primary">Retour à la liste des articles</a>
        </div>
    <?php else: ?>
        <table class="table table-hover shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Date</th>
                    <th>Client</th>
                    <th>Email</th> <th>Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($commandes as $c): ?>
                <tr>
                    <td><?= $c['date_transaction'] ?></td>
                    <td><strong><?= htmlspecialchars($c['nom']) ?></strong></td>
                    <td><?= htmlspecialchars($c['email']) ?></td> <td><?= number_format($c['montant'], 2) ?> €</td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include ROOT_PATH . 'includes/footer.php'; ?>