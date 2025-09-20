<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout - The Flower Company</title>
  <link rel="stylesheet" href="css/checkout.css">
  <link rel="icon" href="">
    <link rel="stylesheet" href="css/header.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <style>
    .upi-details {
      display: none;
      margin-top: 10px;
      padding: 10px;
      border: 1px solid #ddd;
      border-radius: 6px;
      background: #f9f9f9;
    }

    .upi-details label {
      display: block;
      margin-bottom: 5px;
    }

    .upi-details input {
      width: 100%;
      padding: 8px;
      margin-bottom: 10px;
    }
  </style>
</head>

<body>
  <?php include 'header.php' ?>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $errors = [];

    // Collect & validate inputs
    $fullname = trim($_POST['fullname'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');
    $payment = $_POST['payment'] ?? '';
    $upi_id = trim($_POST['upi_id'] ?? '');

    // Validation rules
    if (empty($fullname))
      $errors[] = "Full name is required.";
    if (empty($phone) || !preg_match("/^[0-9]{10}$/", $phone)) {
      $errors[] = "Valid 10-digit phone number is required.";
    }
    if (empty($address))
      $errors[] = "Address is required.";
    if (empty($city))
      $errors[] = "City is required.";
    if (empty($pincode) || !preg_match("/^[0-9]{6}$/", $pincode)) {
      $errors[] = "Valid 6-digit pincode is required.";
    }
    if (empty($payment))
      $errors[] = "Please select a payment method.";

    // Extra check: If UPI selected, UPI ID must be filled
    if ($payment === "upi" && empty($upi_id)) {
      $errors[] = "UPI ID is required for UPI payments.";
    }

    // If errors, show them
    if (!empty($errors)) {
      echo "<h3 style='color:red;'>Please fix the following errors:</h3><ul>";
      foreach ($errors as $err) {
        echo "<li>$err</li>";
      }
      echo "</ul><a href='checkout.php'>Go Back</a>";
      exit;
    }

    // ✅ If no errors, process order
    echo "<h2 style='color:green;'>Order placed successfully!</h2>";
    echo "<p>Thank you, <strong>$fullname</strong>. Your order will be delivered to $address, $city - $pincode.</p>";
  }
  ?>


  <main class="checkout-container">
    <h2>Checkout</h2>

    <!-- Address Section -->
    <div class="address-section">
      <h3>Delivery Address</h3>
      <form action="order_confirm.php" method="POST" >
        <label>Full Name</label>
        <input type="text" name="fullname" required>

        <label>Phone Number</label>
        <input type="tel" name="phone" required>

        <label>Address</label>
        <textarea name="address" rows="3" required></textarea>

        <label>City</label>
        <input type="text" name="city" required>

        <label>Pincode</label>
        <input type="text" name="pincode" required>

        <!-- Payment Method -->
        <h3>Payment Method</h3>
        <div class="payment-options">
          <label><input type="radio" name="payment" value="cod" required> Cash on Delivery</label><br>
          <label><input type="radio" name="payment" value="upi"> UPI / Paytm / GPay</label><br>
          <!-- UPI Extra Input -->
          <div class="upi-details" id="upi-details">
            <label>Enter UPI ID (e.g., yourname@upi)</label>
            <input type="text" name="upi_id" placeholder="example@upi">
          </div>
          <label><input type="radio" name="payment" value="card"> Credit / Debit Card</label>
        </div>


        <!-- Place Order Button -->
        <button type="submit" class="place-order-btn">Place Order</button>
      </form>
    </div>
  </main>

  <script>
    // Show UPI input when UPI option selected
    const paymentOptions = document.querySelectorAll('input[name="payment"]');
    const upiDetails = document.getElementById('upi-details');

    paymentOptions.forEach(option => {
      option.addEventListener('change', function () {
        if (this.value === 'upi') {
          upiDetails.style.display = 'block';
        } else {
          upiDetails.style.display = 'none';
        }
      });
    });
  </script>
</body>

</html>