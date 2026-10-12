<?php
require_once __DIR__ . '/../../core/core.php';
require_login(); // per spec: protects this page if not logged in

require_once __DIR__ . '/../layout/header.php';
?>

<div class="container">
    <section class="content">
        <h1>My Account</h1>
        <p>You are logged in.</p>
        <p>Customer ID: <?php echo htmlspecialchars($_SESSION['customer_id']); ?></p>

        <?php if (isset($_SESSION['user_role']) && (int)$_SESSION['user_role'] === 1): ?>
            <div class="admin-links" style="margin-top: 20px;">
                <h3>Admin Management</h3>
                <ul>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/views/admin/brand.php">Manage Brands</a>
                    </li>
                    <li>
                        <a href="<?php echo BASE_URL; ?>/views/admin/category.php">Manage Categories</a>


                    </li>

                    <li>
                        <a href="<?php echo BASE_URL; ?>/views/admin/product.php">Manage Products</a>
                </ul>
            </div>
        <?php endif; ?>
    </section>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>