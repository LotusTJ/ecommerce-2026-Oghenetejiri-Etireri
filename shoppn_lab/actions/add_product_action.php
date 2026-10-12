<?php
require_once __DIR__ . '/../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../controllers/ProductController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ' . BASE_URL . '/views/admin/product.php');
    exit();
}

$cat      = filter_var($_POST['product_cat'] ?? '', FILTER_VALIDATE_INT);
$brand    = filter_var($_POST['product_brand'] ?? '', FILTER_VALIDATE_INT);
$title    = trim(strip_tags($_POST['product_title'] ?? ''));
$price    = filter_var($_POST['product_price'] ?? '', FILTER_VALIDATE_FLOAT);
$desc     = trim(strip_tags($_POST['product_desc'] ?? ''));
$keywords = trim(strip_tags($_POST['product_keywords'] ?? ''));

if (!$cat || !$brand || $title === '' || !$price) {
    $_SESSION['error'] = 'Please fill in all required fields correctly.';
    header('Location: ' . BASE_URL . '/views/admin/product.php');
    exit();
}

//Handle image upload (optional.product can be added without one)
$filename = null;

if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
    $allowed = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (in_array($_FILES['product_image']['type'], $allowed)) {
        $maxSize = 5 * 1024 * 1024; // 5MB

        if ($_FILES['product_image']['size'] <= $maxSize) {
            $candidateFilename = uniqid() . '_' . basename($_FILES['product_image']['name']);
            $destination = __DIR__ . '/../images/products/' . $candidateFilename;

            // Only keep the filename if the move actually succeeds.
            // If it fails (e.g. server folder permissions), the product
            // still gets added — just without an image for now.
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $destination)) {
                $filename = $candidateFilename;
            }
        }
    }
}

$controller = new ProductController();
$result = $controller->addProduct($cat, $brand, $title, $price, $desc, $filename, $keywords);

if ($result) {
    $_SESSION['success'] = 'Product added.';
} else {
    $_SESSION['error'] = 'Failed to add product.';
}

header('Location: ' . BASE_URL . '/views/admin/product.php');
exit();