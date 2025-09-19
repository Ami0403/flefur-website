<?php
$signupMode = false;  // default → login visible

// If there were signup errors → keep signup form open
if (isset($_GET['signup'])) {
  $signupMode = true;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login / Sign Up</title>
  <link rel="stylesheet" href="css/sign_up.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <div class="container" id="container">
    <!-- Left Section -->
    <div class="left">
      <h2 id="leftTitle">Welcome Back!</h2>
      <p id="leftDesc">Login to continue exploring and sharing your work.</p>
    </div>

    <!-- Right Section -->
    <div class="right">
      <!-- Show PHP message -->

      <!-- Login Form -->
      <div id="loginForm">
        <h2>Login</h2>
        <form method="POST" action="login.php" novalidate>
          <input type="hidden" name="action" value="login">

          <div class="form-group">
            <div class="input-wrapper">
              <input type="email" name="email" placeholder="Email address" required
                value="<?= htmlspecialchars($_GET['old_email'] ?? '') ?>">
              <?php if (isset($_GET['login_email_error'])): ?>
                <span class="error"><?= htmlspecialchars($_GET['login_email_error']); ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group">
            <div class="input-wrapper">
              <input type="password" name="password" placeholder="Password" required>
              <?php if (isset($_GET['login_password_error'])): ?>
                <span class="error"><?= htmlspecialchars($_GET['login_password_error']); ?></span>
              <?php endif; ?>
              <a href="forgotpass.php" class="forgot-link">Forgot Password ?</a>
            </div>
          </div>
           <div class="g-recaptcha" data-sitekey="6LdHjcwrAAAAAHiqMO1-jNVhbmv-hY5rBnkGMS1k"></div>

          <button type="submit" class="btn-primary">Login →</button>
        </form>

        <div class="divider">or</div>
        <button type="button" class="btn-google"><i class="fa-brands fa-google"></i> Login with Google</button>
        <div class="toggle-link" onclick="switchToSignUp()">Don’t have an account? Sign Up</div>
      </div>


      <!-- Signup Form -->
      <div id="signupForm">
        <h2>Sign Up</h2>
        <form method="POST" action="signup.php" novalidate>
          <input type="hidden" name="action" value="signup">

          <div class="form-group">
            <div class="input-wrapper">
              <input type="text" name="fname" placeholder="First name" required
                value="<?= htmlspecialchars($_GET['old_fname'] ?? '') ?>">
              <?php if (isset($_GET['fname_error'])): ?>
                <span class="error"><?= htmlspecialchars($_GET['fname_error']); ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group">
            <div class="input-wrapper">
              <input type="text" name="lname" placeholder="Last name" required
                value="<?= htmlspecialchars($_GET['old_lname'] ?? '') ?>">
              <?php if (isset($_GET['lname_error'])): ?>
                <span class="error"><?= htmlspecialchars($_GET['lname_error']); ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group">
            <div class="input-wrapper">
              <input type="email" name="email" placeholder="Email address" required
                value="<?= htmlspecialchars($_GET['old_email'] ?? '') ?>">
              <?php if (isset($_GET['email_error'])): ?>
                <span class="error"><?= htmlspecialchars($_GET['email_error']); ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group">
            <div class="input-wrapper">
              <input type="password" name="password" placeholder="Password" required>
              <?php if (isset($_GET['password_error'])): ?>
                <span class="error"><?= htmlspecialchars($_GET['password_error']); ?></span>
              <?php endif; ?>
            </div>
          </div>

          <div class="form-group">
            <div class="input-wrapper">
              <input type="checkbox" name="terms" id="terms" required <?= isset($_GET['old_terms']) ? 'checked' : '' ?>>
              <label for="terms">Accept Terms & Conditions</label>
              <?php if (isset($_GET['terms_error'])): ?>
                <span class="error"><?= htmlspecialchars($_GET['terms_error']); ?></span>
              <?php endif; ?>
            </div>
          </div>
          <div class="g-recaptcha" data-sitekey="6LdHjcwrAAAAAHiqMO1-jNVhbmv-hY5rBnkGMS1k
"></div>
<br>

          <button type="submit" class="btn-primary">Join us →</button>
        </form>

        <div class="divider">or</div>
        <button type="button" class="btn-google"><i class="fa-brands fa-google"></i> Sign up with Google</button>
        <div class="toggle-link" onclick="switchToLogin()">Already have an account? Login</div>
      </div>
    </div>
  </div>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

  <script>
    const container = document.getElementById('container');
    const loginForm = document.getElementById('loginForm');
    const signupForm = document.getElementById('signupForm');
    const leftTitle = document.getElementById('leftTitle');
    const leftDesc = document.getElementById('leftDesc');

    function switchToSignUp() {
      container.classList.add("signup-mode");
      loginForm.style.display = "none";
      signupForm.style.display = "block";
      leftTitle.innerHTML = "Create your <br><span>Account</span>";
      leftDesc.innerHTML = "Share your artwork <br>and Get projects!";
    }

    function switchToLogin() {
      container.classList.remove("signup-mode");
      signupForm.style.display = "none";
      loginForm.style.display = "block";
      leftTitle.innerHTML = "Welcome Back!";
      leftDesc.innerHTML = "Login to continue exploring and sharing your work.";
    }

    // Auto-switch based on PHP
    <?php if ($signupMode): ?>
      switchToSignUp();
    <?php else: ?>
      switchToLogin();
      <?php if (isset($_GET['signup_success'])): ?>
        alert("Signup successful! Please login now.");
      <?php endif; ?>
    <?php endif; ?>
  </script>

</body>

</html>