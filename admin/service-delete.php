<?php
require_once __DIR__ . '/../includes/config.php';
require_once ROOT_PATH . 'includes/db.php';
require_once ROOT_PATH . 'includes/middleware-admin.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $stmtImg = $pdo->prepare("SELECT image FROM items WHERE id = ?");
    $stmtImg->execute([$id]);
    $item = $stmtImg->fetch();

    if ($item && $item['image'] !== 'default.jpg') {
        $file_path = ROOT_PATH . 'public/assets/images/' . $item['image'];
        
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    $stmtStock = $pdo->prepare("DELETE FROM stock WHERE id_item = ?");
    $stmtStock->execute([$id]);
    
    $stmtItem = $pdo->prepare("DELETE FROM items WHERE id = ?");
    $stmtItem->execute([$id]);
}

header("Location: services-list.php");
exit();
?>