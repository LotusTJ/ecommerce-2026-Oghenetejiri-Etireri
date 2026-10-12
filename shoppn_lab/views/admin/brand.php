<?php
require_once __DIR__ . '/../../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../../controllers/ProductController.php';
$controller = new ProductController();

// Edit mode: pre-fill form if ?edit_id=N is present
$editing = false;
$editId = filter_var($_GET['edit_id'] ?? '', FILTER_VALIDATE_INT);
$editBrand = null;

if ($editId) {
    $editBrand = $controller->getBrandById($editId);
    if ($editBrand) {
        $editing = true;
    }
}

$brands = $controller->getAllBrands();

require_once __DIR__ . '/../layout/header.php';
?>

<div class="container">
    <section class="content">
        <h1><?php echo $editing ? 'Edit Brand' : 'Add Brand'; ?></h1>

        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <?php if ($editing): ?>
            <form action="<?php echo BASE_URL; ?>/actions/update_brand_action.php" method="POST">
                <input type="hidden" name="brand_id" value="<?php echo htmlspecialchars($editBrand['brand_id']); ?>">
                <label for="brand_name">Brand Name</label><br>
                <input type="text" id="brand_name" name="brand_name"
                       value="<?php echo htmlspecialchars($editBrand['brand_name']); ?>" required><br><br>
                <button type="submit">Update Brand</button>
                <a href="<?php echo BASE_URL; ?>/views/admin/brand.php">Cancel</a>
            </form>
        <?php else: ?>
            <form action="<?php echo BASE_URL; ?>/actions/add_brand_action.php" method="POST">
                <label for="brand_name">Brand Name</label><br>
                <input type="text" id="brand_name" name="brand_name" required><br><br>
                <button type="submit">Add Brand</button>
            </form>
        <?php endif; ?>

        <h2>Existing Brands</h2>
        <table border="1" cellpadding="5">
            <tr><th>ID</th><th>Name</th><th>Action</th></tr>
            <?php if (!empty($brands)): ?>
                <?php foreach ($brands as $brand): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($brand['brand_id']); ?></td>
                        <td><?php echo htmlspecialchars($brand['brand_name']); ?></td>
                        <td><a href="?edit_id=<?php echo $brand['brand_id']; ?>">Edit</a></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3">No brands yet.</td></tr>
            <?php endif; ?>
        </table>
    </section>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>