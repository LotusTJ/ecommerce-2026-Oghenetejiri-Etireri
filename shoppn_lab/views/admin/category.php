<?php
require_once __DIR__ . '/../../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../../controllers/ProductController.php';
$controller = new ProductController();

$categories = $controller->getAllCategories();

require_once __DIR__ . '/../layout/header.php';
?>

<div class="container">
    <section class="content">
        <h1>Add Category</h1>

        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>/actions/add_category_action.php" method="POST">
            <label for="cat_name">Category Name</label><br>
            <input type="text" id="cat_name" name="cat_name" required><br><br>
            <button type="submit">Add Category</button>
        </form>

        <h2>Categories</h2>
        <table border="1" cellpadding="5">
            <tr><th>ID</th><th>Name</th></tr>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($cat['cat_id']); ?></td>
                        <td><?php echo htmlspecialchars($cat['cat_name']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="2">No categories .</td></tr>
            <?php endif; ?>
        </table>
    </section>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>