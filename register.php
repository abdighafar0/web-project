<?php
require_once '../includes/config.php';
require_once '../includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = sanitizeInput($_POST['role']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        $_SESSION['error'] = "All fields are required";
        redirect('../pages/register.php');
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match";
        redirect('../pages/register.php');
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['error'] = "Invalid email format";
        redirect('../pages/register.php');
    }

    // Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $_SESSION['error'] = "Email already registered";
        redirect('../pages/register.php');
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert user
    $stmt = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $hashed_password, $role);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Registration successful! Please login";
        redirect('../pages/login.php');
    } else {
        $_SESSION['error'] = "Registration failed. Please try again";
        redirect('../pages/register.php');
    }
} else {
    redirect('../pages/register.php');
}
?>