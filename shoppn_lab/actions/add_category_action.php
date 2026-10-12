<?php
require_once __DIR__ . '/../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/views/admin/category.php');
    exit();
}

$name = trim(strip_tags($_POST['cat_name'] ?? ''));

if ($name === '') {
    $_SESSION['error'] = 'Category name is required.';
    header('Location: ' . BASE_URL . '/views/admin/category.php');
    exit();
}

$controller = new ProductController();
$result = $controller->addCategory($name);

if ($result) {
    $_SESSION['success'] = 'Category added.';
} else {
    $_SESSION['error'] = 'Failed to add category.';
}

header('Location: ' . BASE_URL . '/views/admin/category.php');
exit();

