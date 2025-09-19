<?php
include("database/db_connection.php");
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);

    // Fetch product by ID
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        die("❌ Product not found.");
    }
} else {
    die("❌ Invalid product ID.");
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Flower Company - Wild Mix</title>
    <link rel="stylesheet" href="css/wild-mix.css">
    <link rel="icon" href="">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
</head>

<body>

    <?php include 'header.php' ?>

    <main class="product-page">
        <div class="product-image-container">
            <img src="database/<?php echo $product['product_image']; ?>" alt="<?php echo $product['product_name']; ?>" style="width:500px">
            <!-- <img src="images/2.jpg" alt="Wild Mix Classic Cubo" class="product-image"> -->
        </div>
        <div class="product-details-container">
            <h1 class="product-title"><?php echo $product['product_name']; ?></h1>
            <p class="product-price">RS.  <?php echo number_format($product['price'], 2); ?></p>
            <div class="city-selector">
                <label for="city-select">City: Delhi/NCR</label>
                <select id="city-select">
                    <option value="delhi-ncr">Delhi/NCR</option>
                    <option value="mumbai">Mumbai</option>
                    <option value="bangalore">Bangalore</option>
                </select>
            </div>
            <div class="quantity-selector">
                <button id="decrement-btn">-</button>
                <input type="text" id="quantity-input" value="1" readonly>
                <button id="increment-btn">+</button>
            </div>
            <a href="addtocart.php?id=<?php echo $product['id']; ?>">
                 <button id="addToCartBtn" class="add-to-cart-btn">ADD TO CART</button></a>
            <div class="product-description">
                <p><?php echo $product['product_description']; ?></p>
                <p>Cubo Box specification | 7"(h) x 7"(w)</p>
            </div>
            <div class="share-links">
                <a href="#">SHARE</a>
            </div>
            <div class="more-info-toggle">
                <span class="more-info-text">MORE INFORMATION</span>
                <span class="toggle-icon">+</span>
            </div>
        </div>
    </main>

    <div class="chat-widget">
        <i class="fab fa-whatsapp"></i>
        <span>Chat with us</span>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const quantityInput = document.getElementById('quantity-input');
            const incrementBtn = document.getElementById('increment-btn');
            const decrementBtn = document.getElementById('decrement-btn');
            const addToCartBtn = document.getElementById('addToCartBtn');

            // Quantity increase
            incrementBtn.addEventListener('click', () => {
                let currentQuantity = parseInt(quantityInput.value, 10);
                quantityInput.value = currentQuantity + 1;
            });

            // Quantity decrease
            decrementBtn.addEventListener('click', () => {
                let currentQuantity = parseInt(quantityInput.value, 10);
                if (currentQuantity > 1) {
                    quantityInput.value = currentQuantity - 1;
                }
            });

            // Redirect to addtocart.php when button clicked
            addToCartBtn.addEventListener('click', () => {
                window.location.href = "addtocart.php";
            });
        });

    </script>
</body>

</html>