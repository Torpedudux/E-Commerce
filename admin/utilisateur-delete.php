<?php
require_once __DIR__ . '/../includes/config.php'; 
require_once ROOT_PATH . 'includes/db.php';
require_once ROOT_PATH . 'includes/middleware-admin.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    // On empêche de se supprimer soi-même
    if ($id !== $_SESSION['user_id']) {
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
}

header('Location: utilisateurs-list.php');
exit;