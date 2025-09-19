<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == "signup") {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $terms = isset($_POST['terms']);

    $errors = [];

    // Validation
    if (empty($fname) || !preg_match("/^[a-zA-Z]{2,}$/", $fname)) {
        $errors['fname_error'] = "First name must be letters only (min 2)";
    }

    if (empty($lname) || !preg_match("/^[a-zA-Z]{2,}$/", $lname)) {
        $errors['lname_error'] = "Last name must be letters only (min 2)";
    }

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email_error'] = "Invalid email format";
    }

    if (empty($password) || strlen($password) < 6) {
        $errors['password_error'] = "Password must be at least 6 characters";
    }

    if (!$terms) {
        $errors['terms_error'] = "Accept Terms & Conditions";
    }

    if (!empty($errors)) {
        // Keep old values
        $errors['old_fname'] = $fname;
        $errors['old_lname'] = $lname;
        $errors['old_email'] = $email;
        if ($terms) $errors['old_terms'] = 1;

        // Redirect back with errors
        $query = http_build_query($errors);
        header("Location: signup_login.php?signup=1&$query"); 
        exit();
    }

    // ✅ Signup successful → Save to session
    $_SESSION['fname'] = $fname;
    $_SESSION['lname'] = $lname;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password; // ⚠️ use password_hash in real life

    // Redirect with success flag → login form will show
    header("Location: signup_login.php?signup_success=1");
    exit();
}
