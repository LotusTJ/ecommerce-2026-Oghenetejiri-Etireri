<?php
require_once __DIR__ . '/../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/views/admin/brand.php');
    exit();
}

$name = trim(strip_tags($_POST['brand_name'] ?? ''));

if ($name === '') {
    $_SESSION['error'] = 'Brand name is required.';
    header('Location: ' . BASE_URL . '/views/admin/brand.php');
    exit();
}

$controller = new ProductController();
$result = $controller->addBrand($name);

if ($result) {
    $_SESSION['success'] = 'Brand added.';
} else {
    $_SESSION['error'] = 'Failed to add brand.';
}

header('Location: ' . BASE_URL . '/views/admin/brand.php');
exit();