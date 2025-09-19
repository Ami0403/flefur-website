<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart - The Flower Company</title>
    <link rel="stylesheet" href="css/addtocart.css">
    <link rel="icon" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include 'header.php' ?>

  <main class="cart-container">
    <div class="cart-header">
        <span class="column-title">PRODUCT</span>
        <span class="column-title quantity-title">QUANTITY</span>
        <span class="column-title total-title">TOTAL</span>
    </div>

    <?php
    include("database/db_connection.php");

    // Get product id from URL
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // convert to int for safety

        // Fetch only the clicked product
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
    ?>
    <div class="cart-item" data-id="<?php echo $row['id']; ?>">
        <div class="product-info">
            <img src="database/<?php echo $row['product_image']; ?>" 
                 alt="<?php echo $row['product_name']; ?>" 
                 class="product-image">

            <div class="product-details">
                <h3 class="product-name"><?php echo $row['product_name']; ?></h3>
                <p class="product-location">DELHI/NCR</p>
                <p class="product-price" data-price="<?php echo $row['price']; ?>">
                    RS. <?php echo number_format($row['price'], 2); ?>
                </p>
            </div>
        </div>

        <!-- Quantity controls -->
        <div class="quantity-controls">
            <button class="decrement-btn">-</button>
            <input type="text" class="quantity-input" value="1" readonly>
            <button class="increment-btn">+</button>
        </div>

        <!-- Total for this product -->
        <div class="product-total-price" data-total="<?php echo $row['price']; ?>">
            RS. <?php echo number_format($row['price'], 2); ?>
        </div>
    </div>
    <?php
            }
        } else {
            echo "<p>Product not found.</p>";
        }
    } else {
        echo "<p>No product selected.</p>";
    }
    ?>

    <!-- Footer -->
    <div class="cart-footer">
        <div class="delivery-section">
            <div class="section-title">Pick a Delivery Date</div>
            <div class="delivery-date-input">
                <input type="text" placeholder="Select delivery date">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>

        <div class="message-section">
            <div class="message-box">
                <div class="section-title">Message for your loved one</div>
                <textarea placeholder="Type your message"></textarea>
            </div>

            <div class="special-instructions">
                <div class="section-title">Special instructions</div>
                <input type="text" class="special-instructions-input">
            </div>

            <div class="occasion-select">
                <div class="section-title">Select Occasion</div>
                <select>
                    <option>Others</option>
                    <option>Birthday</option>
                    <option>Anniversary</option>
                </select>
            </div>
        </div>

        <div class="summary-section">
            <span class="total-label">TOTAL:</span>
            <span class="grand-total-price">RS. 2,500</span>
            <button class="checkout-btn" onclick="window.location.href='checkout.php'">
                CHECKOUT
            </button>
        </div>
    </div>
</main>


    <div class="chat-widget">
        <i class="fab fa-whatsapp"></i>
        <span>Chat with us</span>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const cartItems = document.querySelectorAll('.cart-item');
            const grandTotalPriceElement = document.querySelector('.grand-total-price');

            function updateGrandTotal() {
                let grandTotal = 0;
                document.querySelectorAll('.product-total-price').forEach(item => {
                    grandTotal += parseFloat(item.dataset.total);
                });
                grandTotalPriceElement.textContent = `RS. ${grandTotal.toLocaleString()}`;
            }

            cartItems.forEach(item => {
                const decrementBtn = item.querySelector('.decrement-btn');
                const incrementBtn = item.querySelector('.increment-btn');
                const quantityInput = item.querySelector('.quantity-input');
                const productPriceElement = item.querySelector('.product-price');
                const productTotalPriceElement = item.querySelector('.product-total-price');

                const productPrice = parseFloat(productPriceElement.dataset.price);

                incrementBtn.addEventListener('click', () => {
                    let currentQuantity = parseInt(quantityInput.value, 10);
                    currentQuantity++;
                    quantityInput.value = currentQuantity;

                    const newTotalPrice = currentQuantity * productPrice;
                    productTotalPriceElement.textContent = `RS. ${newTotalPrice.toLocaleString()}`;
                    productTotalPriceElement.dataset.total = newTotalPrice;
                    updateGrandTotal();
                });

                decrementBtn.addEventListener('click', () => {
                    let currentQuantity = parseInt(quantityInput.value, 10);
                    if (currentQuantity > 1) {
                        currentQuantity--;
                        quantityInput.value = currentQuantity;

                        const newTotalPrice = currentQuantity * productPrice;
                        productTotalPriceElement.textContent = `RS. ${newTotalPrice.toLocaleString()}`;
                        productTotalPriceElement.dataset.total = newTotalPrice;
                        updateGrandTotal();
                    }
                });
            });

            updateGrandTotal();
        }); 
    </script>
</body>

</html>