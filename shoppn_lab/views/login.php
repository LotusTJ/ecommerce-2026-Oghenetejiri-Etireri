<?php require_once __DIR__ . '/layout/header.php'; ?>

<div class="container">
    <section class="content">
        <h1>Login</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
            </p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="../actions/login_action.php" method="POST">
            <label for="customer_email">Email</label><br>
            <input type="email" id="customer_email" name="customer_email" required><br><br>

            <label for="customer_pass">Password</label><br>
            <input type="password" id="customer_pass" name="customer_pass" required><br><br>

            <button type="submit">Login</button>
        </form>

        <p>To make account register (will redirect to register.php)? <a href="register.php">Register here</a>.</p>
    </section>
</div>

