<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/CustomerController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/login.php');
    exit();
}

$email = trim(strip_tags($_POST['customer_email'] ?? ''));
$pass  = trim($_POST['customer_pass'] ?? '');

if ($email === '' || $pass === '') {
    $_SESSION['error'] = 'Please enter both email and password.';
    header('Location: ../views/login.php');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format.';
    header('Location: ../views/login.php');
    exit();
}

$controller = new CustomerController();
$result = $controller->login($email, $pass);

if ($result['success']) {
    $_SESSION['customer_id']    = $result['customer']['customer_id'];
    $_SESSION['customer_name']  = $result['customer']['customer_name'];
    $_SESSION['customer_email'] = $result['customer']['customer_email'];
    $_SESSION['user_role']      = $result['customer']['user_role'];

    header('Location: ' . BASE_URL . '/views/account/my_account.php');
    exit();
} else {
    $_SESSION['error'] = $result['error'] ?? 'Invalid email or password.';
    header('Location: ../views/login.php');
    exit();
}

