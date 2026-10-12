<?php
require_once __DIR__ . '/../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/views/admin/brand.php');
    exit();
}

$id   = filter_var($_POST['brand_id'] ?? '', FILTER_VALIDATE_INT);
$name = trim(strip_tags($_POST['brand_name'] ?? ''));

if (!$id || $id <= 0 || $name === '') {
    $_SESSION['error'] = 'Invalid brand data.';
    header('Location: ' . BASE_URL . '/views/admin/brand.php');
    exit();
}

$controller = new ProductController();
$result = $controller->updateBrand($id, $name);

if ($result) {
    $_SESSION['success'] = 'Brand updated.';
} else {
    $_SESSION['error'] = 'Failed to update brand.';
}

header('Location: ' . BASE_URL . '/views/admin/brand.php');
exit();