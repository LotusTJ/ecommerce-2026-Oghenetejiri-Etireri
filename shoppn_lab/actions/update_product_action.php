<?php
require_once __DIR__ . '/../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/views/admin/product.php');
    exit();
}

$id       = filter_var($_POST['product_id'] ?? '', FILTER_VALIDATE_INT);
$cat      = filter_var($_POST['product_cat'] ?? '', FILTER_VALIDATE_INT);
$brand    = filter_var($_POST['product_brand'] ?? '', FILTER_VALIDATE_INT);
$title    = trim(strip_tags($_POST['product_title'] ?? ''));
$price    = filter_var($_POST['product_price'] ?? '', FILTER_VALIDATE_FLOAT);
$desc     = trim(strip_tags($_POST['product_desc'] ?? ''));
$keywords = trim(strip_tags($_POST['product_keywords'] ?? ''));

//Keep the existing image unless a new one is uploaded
$filename = $_POST['existing_image'] ?? null;

if (!$id || !$cat || !$brand || $title === '' || !$price) {
    $_SESSION['error'] = 'Please fill in all required fields correctly.';
    header('Location: ' . BASE_URL . '/views/admin/product.php');
    exit();
}

if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (!in_array($_FILES['product_image']['type'], $allowed)) {
        $_SESSION['error'] = 'Invalid image type.';
        header('Location: ' . BASE_URL . '/views/admin/product.php?edit_id=' . $id);
        exit();
    }

    $filename = uniqid() . '_' . basename($_FILES['product_image']['name']);
    $destination = __DIR__ . '/../images/products/' . $filename;
    move_uploaded_file($_FILES['product_image']['tmp_name'], $destination);
}

$controller = new ProductController();
$result = $controller->updateProduct($id, $cat, $brand, $title, $price, $desc, $filename, $keywords);

if ($result) {
    $_SESSION['success'] = 'Product updated.';
} else {
    $_SESSION['error'] = 'Failed to update product.';
}

header('Location: ' . BASE_URL . '/views/admin/product.php');
exit();