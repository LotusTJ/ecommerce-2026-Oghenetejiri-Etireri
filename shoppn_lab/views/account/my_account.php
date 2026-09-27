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
    </section>
</div>

<?php require_once __DIR__ . '/../layout/footer.php'; ?>