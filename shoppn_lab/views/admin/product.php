<?php
require_once __DIR__ . '/../../core/core.php';
require_login();
require_admin();

require_once __DIR__ . '/../../controllers/ProductController.php';
$controller = new ProductController();

$editing = false;
$editId = filter_var($_GET['edit_id'] ?? '', FILTER_VALIDATE_INT);
$editProduct = null;

if ($editId) {
    $editProduct = $controller->getProductById($editId);
    if ($editProduct) {
        $editing = true;
    }
}

$categories = $controller->getAllCategories();
$brands = $controller->getAllBrands();

require_once __DIR__ . '/../layout/header.php';
?>

<div class="container">
    <section class="content">
        <h1><?php echo $editing ? 'Edit Product' : 'Add Product'; ?></h1>

        <?php if (isset($_SESSION['success'])): ?>
            <p style="color: green;"><?php echo htmlspecialchars($_SESSION['success']); unset($_SESSION['success']); ?></p>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_SESSION['error']); unset($_SESSION['error']); ?></p>
        <?php endif; ?>

        <form action="<?php echo BASE_URL; ?>/actions/<?php echo $editing ? 'update_product_action.php' : 'add_product_action.php'; ?>"
              method="POST" enctype="multipart/form-data">

            <?php if ($editing): ?>
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($editProduct['product_id']); ?>">
                <input type="hidden" name="existing_image" value="<?php echo htmlspecialchars($editProduct['product_image'] ?? ''); ?>">
            <?php endif; ?>

            <label for="product_title">Title</label><br>
            <input type="text" id="product_title" name="product_title" required
                   value="<?php echo $editing ? htmlspecialchars($editProduct['product_title']) : ''; ?>"><br><br>

            <label for="product_price">Price</label><br>
            <input type="number" step="0.01" id="product_price" name="product_price" required
                   value="<?php echo $editing ? htmlspecialchars($editProduct['product_price']) : ''; ?>"><br><br>

            <label for="product_desc">Description</label><br>
            <textarea id="product_desc" name="product_desc"><?php echo $editing ? htmlspecialchars($editProduct['product_desc']) : ''; ?></textarea><br><br>

            <label for="product_keywords">Keywords</label><br>
            <input type="text" id="product_keywords" name="product_keywords"
                   value="<?php echo $editing ? htmlspecialchars($editProduct['product_keywords']) : ''; ?>"><br><br>

            <label for="product_cat">Category</label><br>
            <select id="product_cat" name="product_cat" required>
                <option value="">-- Select Category --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?php echo $cat['cat_id']; ?>"
                        <?php echo ($editing && $editProduct['product_cat'] == $cat['cat_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($cat['cat_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <label for="product_brand">Brand</label><br>
            <select id="product_brand" name="product_brand" required>
                <option value="">-- Select Brand --</option>
                <?php foreach ($brands as $brand): ?>
                    <option value="<?php echo $brand['brand_id']; ?>"
                        <?php echo ($editing && $editProduct['product_brand'] == $brand['brand_id']) ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($brand['brand_name']); ?>
                    </option>
                <?php endforeach; ?>
            </select><br><br>

            <?php if ($editing && !empty($editProduct['product_image'])): ?>
                <p>Current image:</p>
                <img src="<?php echo BASE_URL; ?>/images/products/<?php echo htmlspecialchars($editProduct['product_image']); ?>"
                     alt="Current product image" style="max-width: 150px;"><br><br>
            <?php endif; ?>

            <label for="product_image">Image<?php echo $editing ? ' (leave blank to keep current)' : ''; ?></label><br>
            <input type="file" id="product_image" name="product_image" accept="image/jpeg,image/png,image/gif,image/webp"><br><br>

            <button type="submit"><?php echo $editing ? 'Update Product' : 'Add Product'; ?></button>
            <?php if ($editing): ?>
                <a href="<?php echo BASE_URL; ?>/views/admin/product.php">Cancel</a>
            <?php endif; ?>
        </form>
    </section>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>