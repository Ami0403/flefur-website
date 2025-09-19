<?php
// order_confirm.php (quick fix)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['fullname']) ? trim($_POST['fullname']) : '';
    $payment = isset($_POST['payment']) ? trim($_POST['payment']) : '';
} else {
    // No POST data — send user back to checkout
    header('Location: checkout.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Order Confirmed</title>
  <style>
    /* same centered CSS as earlier */
    body {
      margin: 0;
      padding: 0;
      font-family: "Poppins", sans-serif;
      background: #f8f8f8;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .confirmation-box {
      background: #fff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.1);
      text-align: center;
      max-width: 450px;
      width: 100%;
    }
    .confirmation-box h2 { color: #28a745; font-size: 28px; margin-bottom: 15px; }
    .confirmation-box p { font-size: 16px; margin: 8px 0; color: #555; }
    .confirmation-box strong { color: #ff4d6d; }
    .back-btn {
      margin-top: 20px;
      display: inline-block;
      padding: 12px 25px;
      background: #ff4d6d;
      color: #fff;
      text-decoration: none;
      border-radius: 8px;
      font-weight: 500;
      transition: 0.3s ease;
    }
    .back-btn:hover { background: #e03c5b; }
  </style>
</head>
<body>
  <div class="confirmation-box">
    <h2>Thank you, <?php echo htmlspecialchars($name); ?>!</h2>
    <p>Your order has been placed successfully.</p>
    <p>Payment Method: <strong><?php echo htmlspecialchars($payment); ?></strong></p>
    <a href="index.php" class="back-btn">Continue Shopping</a>
  </div>
</body>
</html>
