<?php
//placeholder data until ProductController is here
$categories = [];
$brands = [];
?>

<aside class="sidebar">
    <div class="sidebar-section">
        <h3>Categories</h3>
        <ul>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="category.php?id=<?php echo $category['cat_id']; ?>">
                            <?php echo htmlspecialchars($category['cat_name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No categories found</li>
            <?php endif; ?>
        </ul>
    </div>

    <div class="sidebar-section">
        <h3>Brands</h3>
        <ul>
            <?php if (!empty($brands)): ?>
                <?php foreach ($brands as $brand): ?>
                    <li>
                        <a href="brand.php?id=<?php echo $brand['brand_id']; ?>">
                            <?php echo htmlspecialchars($brand['brand_name']); ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No brands found</li>
            <?php endif; ?>
        </ul>
    </div>
</aside>