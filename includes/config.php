<?php
session_start();
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('BASE_URL', 'http://localhost/E-Commerce/public/');

function formatPrice($price) {
    return number_format($price, 2, ',', ' ') . ' €';
}
?>