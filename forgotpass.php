<?php
session_start();

// Example: email stored in session after verification
// $_SESSION['email'] = "user@example.com";

$error = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = trim($_POST["email"]);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Empty fields check
    if (empty($gmail) || empty($password) || empty($confirm_password)) {
        $error = "All fields are required.";
    }
    // Email validation
    elseif (!isset($_SESSION['email']) || $_SESSION['email'] !== $gmail) {
        $error = "Email not found.";
    }
    // Password match validation
    elseif ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    }
    else {
        // ✅ All validations passed -> Update password in DB here
        // Example: update_password_in_db($_SESSION['email'], password_hash($password, PASSWORD_BCRYPT));

        // Redirect to login after success
            $_SESSION['password'] = $password; // ⚠️ use password_hash in real life

        header("Location: signup_login.php?reset=success");

        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Reset Password</title>
  <link rel="stylesheet" href="css/forgotpass.css">
  <style>
    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
      text-align: left;
    }
  </style>
</head>
<body>
  <div class="reset-container">
    <h2>Reset Password</h2>
    <p>Enter your new password below.</p>
    <form method="POST" action="" novalidate>
      <!-- Email input, filled from session -->
      <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email'] ?? ''); ?>" readonly>
      
      <input type="password" name="password" placeholder="New Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>

      <!-- PHP error output -->
      <?php if (!empty($error)) : ?>
        <div class="error"><?php echo $error; ?></div>
      <?php endif; ?>

      <button type="submit">Update Password</button>
    </form>
    <a href="signup_login.php" class="back-link">← Back to Login</a>
  </div>

  <!-- Client-side validation -->
  <script>
    document.querySelector("form").addEventListener("submit", function(e) {
      let pass = document.querySelector("input[name='password']").value.trim();
      let confirm = document.querySelector("input[name='confirm_password']").value.trim();
      let errorBox = document.querySelector(".error");

      if (pass !== confirm) {
        e.preventDefault();
        if (!errorBox) {
          errorBox = document.createElement("div");
          errorBox.className = "error";
          this.insertBefore(errorBox, this.querySelector("button"));
        }
        errorBox.textContent = "Passwords do not match!";
      }
    });
  </script>
</body>
</html>
