<?php
require_once 'auth.php';

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: ../public/connexion.php');
    exit();
}
?>