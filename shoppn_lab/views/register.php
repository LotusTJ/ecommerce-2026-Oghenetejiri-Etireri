<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/layout/header.php';
?>

<div class="container">
    <section class="content">
        <h1>Customer Registration</h1>

        <?php if (isset($_SESSION['error'])): ?>
            <p style="color: red;">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
            </p>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <form action="../actions/register_action.php" method="POST" id="registerForm">
            <label for="customer_name">Full Name</label><br>
            <input type="text" id="customer_name" name="customer_name" required><br><br>

            <label for="customer_email">Email</label><br>
            <input type="email" id="customer_email" name="customer_email" required><br><br>

            <label for="customer_pass">Password</label><br>
            <input type="password" id="customer_pass" name="customer_pass" required><br><br>

            <label for="customer_country">Country</label><br>
            <input type="text" id="customer_country" name="customer_country" required><br><br>

            <label for="customer_city">City</label><br>
            <input type="text" id="customer_city" name="customer_city" required><br><br>

            <label for="customer_contact">Contact Number</label><br>
            <input type="text" id="customer_contact" name="customer_contact" required><br><br>

            <label for="customer_image">Image (optional)</label><br>
            <input type="text" id="customer_image" name="customer_image"><br><br>

            <button type="submit">Register</button>
        </form>

        <p>Already have an account? <a href="login.php">Login here</a>.</p>
    </section>
</div>
<script src="../js/validate.js"></script>
<?php require_once __DIR__ . '/layout/footer.php'; ?>