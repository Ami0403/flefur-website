<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "login") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $errors = [];

    // Check if user session exists
    if (!isset($_SESSION['email']) || !isset($_SESSION['password'])) {
        $errors['login_email_error'] = "No user registered yet. Please sign up first.";
    } else {
        // Validate Email
        if ($email !== $_SESSION['email']) {
            $errors['login_email_error'] = "Email not found";
        }

        // Validate Password
        if ($password !== $_SESSION['password']) { // ⚠️ use password_verify if hashed
            $errors['login_password_error'] = "Incorrect password";
        }
    }

    if (!empty($errors)) {
        // Keep old email
        $errors['old_email'] = $email;
        $query = http_build_query($errors);
        header("Location: signup_login.php?$query"); 
        exit();
    }

    // ✅ Login success → store login flag
    $_SESSION['logged_in'] = true;
    $_SESSION['Login_user'] = true;
    header("Location: index.php");
    exit();
}
