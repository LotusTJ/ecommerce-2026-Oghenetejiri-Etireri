<?php
require_once __DIR__ . '/../../core/core.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shoppn</title>
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>/css/style.css">
</head>
<body>

<?php if (is_admin()): ?>
    <div class="admin-nav">
        <a href="<?php echo BASE_URL; ?>/views/admin/brand.php">Brand</a>
        <a href="<?php echo BASE_URL; ?>/views/admin/category.php">Category</a>
    </div>
<?php endif; ?>

<header>
    <div class="header-content">
        <h1>Welcome to Shoppn</h1>
    </div>

    <div class="register-login">
      <a href="<?php echo BASE_URL; ?>/views/register.php">Register</a> |
      <a href="<?php echo BASE_URL; ?>/views/login.php">Login</a>
    </div>
</header>

<form action="<?php echo BASE_URL; ?>/views/search_results.php" method="GET">
    <input type="text" name="user_query" placeholder="Search products...">
    <button type="submit">Search</button>
</form>