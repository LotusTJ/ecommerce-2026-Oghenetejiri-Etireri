<?php
require_once __DIR__ . '/../core/core.php';
require_once __DIR__ . '/../controllers/CustomerController.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../views/register.php');
    exit();
}

$name    = trim(strip_tags($_POST['customer_name'] ?? ''));
$email   = trim(strip_tags($_POST['customer_email'] ?? ''));
$pass    = trim($_POST['customer_pass'] ?? '');
$country = trim(strip_tags($_POST['customer_country'] ?? ''));
$city    = trim(strip_tags($_POST['customer_city'] ?? ''));
$contact = trim(strip_tags($_POST['customer_contact'] ?? ''));
$image   = trim(strip_tags($_POST['customer_image'] ?? ''));
$role    = 2;

if ($name === '' || $email === '' || $pass === '' || $country === '' || $city === '' || $contact === '') {
    $_SESSION['error'] = 'All required fields must be filled.';
    header('Location: ../views/register.php');
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['error'] = 'Invalid email format.';
    header('Location: ../views/register.php');
    exit();
}

if (
    strlen($name) > 100 ||
    strlen($email) > 100 ||
    strlen($country) > 30 ||
    strlen($city) > 30 ||
    strlen($contact) > 15 ||
    strlen($image) > 255
) {
    $_SESSION['error'] = 'A field is exceeded maximum allowed characters.';
    header('Location: ../views/register.php');
    exit();
}

$data = [
    'name'    => $name,
    'email'   => $email,
    'pass'    => $pass,
    'country' => $country,
    'city'    => $city,
    'contact' => $contact,
    'image'   => $image,
    'role'    => $role
];

$controller = new CustomerController();
$result = $controller->register($data);

if ($result['success']) {
    $registeredCustomer = $controller->findByEmail($email);
    
    if ($registeredCustomer && isset($registeredCustomer['customer_id'])) {
        $_SESSION['customer_id'] = $registeredCustomer['customer_id'];
    }
    
    $_SESSION['user_role'] = $role;
    header('Location: ../views/account/my_account.php');
    exit();
} else {
    $_SESSION['error'] = $result['error'] ?? 'Registration failed. Please try again.';
    header('Location: ../views/register.php');
    exit();
}