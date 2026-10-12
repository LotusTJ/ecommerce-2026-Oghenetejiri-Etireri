<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$proId = filter_var($_GET['pro_id'] ?? '', FILTER_VALIDATE_INT);

if (!$proId) {
    redirect(BASE_URL . '/index.php');
}

$controller = new ProductController();
$product = $controller->getProductById($proId);

if (!$product) {
    redirect(BASE_URL . '/index.php');
}

require_once __DIR__ . '/layout/header.php';
?>

<div class="container">
    <?php require_once __DIR__ . '/layout/sidebar.php'; ?>

    <section class="content">
        <h1><?php echo htmlspecialchars($product['product_title']); ?></h1>

        <?php if (!empty($product['product_image'])): ?>
            <img src="<?php echo BASE_URL; ?>/images/products/<?php echo htmlspecialchars($product['product_image']); ?>"
                 alt="<?php echo htmlspecialchars($product['product_title']); ?>" style="max-width: 300px;">
        <?php endif; ?>

        <p><strong>Category:</strong> <?php echo htmlspecialchars($product['cat_name']); ?></p>
        <p><strong>Brand:</strong> <?php echo htmlspecialchars($product['brand_name']); ?></p>
        <p><strong>Price:</strong> $<?php echo htmlspecialchars(number_format($product['product_price'], 2)); ?></p>
        <p><strong>Description:</strong> <?php echo htmlspecialchars($product['product_desc']); ?></p>
        <p><strong>Keywords:</strong> <?php echo htmlspecialchars($product['product_keywords']); ?></p>

        <a href="<?php echo BASE_URL; ?>/actions/add_to_cart_action.php?add_cart=<?php echo $product['product_id']; ?>">Add to Cart</a>
    </section>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>