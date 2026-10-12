<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/ProductController.php';

$controller = new ProductController();

if (isset($_GET['cat']) && filter_var($_GET['cat'], FILTER_VALIDATE_INT)) {
    $products = $controller->getProductsByCategory((int)$_GET['cat']);
} elseif (isset($_GET['brand']) && filter_var($_GET['brand'], FILTER_VALIDATE_INT)) {
    $products = $controller->getProductsByBrand((int)$_GET['brand']);
} else {
    $products = $controller->getFeaturedProducts();
}

require_once __DIR__ . '/layout/header.php';
?>

<div class="container">
    <?php require_once __DIR__ . '/layout/sidebar.php'; ?>

    <section class="content">
        <h1>Welcome to Shoppn</h1>

        <?php if (!empty($products)): ?>
            <div class="product-grid">
                <?php foreach ($products as $product): ?>
                    <div class="product-card">
                        <?php if (!empty($product['product_image'])): ?>
                            <img src="<?php echo BASE_URL; ?>/images/products/<?php echo htmlspecialchars($product['product_image']); ?>"
                                 alt="<?php echo htmlspecialchars($product['product_title']); ?>" style="max-width: 150px;">
                        <?php endif; ?>
                        <h3><?php echo htmlspecialchars($product['product_title']); ?></h3>
                        <p>$<?php echo htmlspecialchars(number_format($product['product_price'], 2)); ?></p>
                        <a href="<?php echo BASE_URL; ?>/views/single_product.php?pro_id=<?php echo $product['product_id']; ?>">Details</a>
                        |
                        <a href="<?php echo BASE_URL; ?>/actions/add_to_cart_action.php?add_cart=<?php echo $product['product_id']; ?>">Add to Cart</a>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <p>No products found.</p>
        <?php endif; ?>
    </section>
</div>

<?php require_once __DIR__ . '/layout/footer.php'; ?>