<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php';
require_once ROOT_PATH . 'includes/middleware-admin.php';
include ROOT_PATH . 'includes/header.php';

$stmt = $pdo->query("SELECT id, nom, email, role FROM users ORDER BY nom ASC");
$users = $stmt->fetchAll();
?>

<div class="container mt-5">
    <h2 class="mb-4">Gestion des Utilisateurs</h2>
    <table class="table table-hover shadow-sm">
        <thead class="table-dark">
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $u): ?>
            <tr>
                <td><strong><?= htmlspecialchars($u['nom']) ?></strong></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td><span class="badge <?= $u['role'] === 'admin' ? 'bg-danger' : 'bg-secondary' ?>"><?= $u['role'] ?></span></td>
                <td class="text-end">
                    <?php if ($u['id'] != $_SESSION['user_id']): ?>
                        <a href="utilisateur-delete.php?id=<?= $u['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Supprimer cet utilisateur ?')">Supprimer</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>