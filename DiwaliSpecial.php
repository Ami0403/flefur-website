<?php
include("database/db_connection.php");

// Correct SQL query
$newproduct = "SELECT * FROM products WHERE product_category = 'DiwaliSpecial'";
$result = $conn->query($newproduct);

// Check if query succeeded
if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // echo $row['product_name'] . " - RS. " . number_format($row['price'], 2) . "<br>";
        }
    } else {
        echo "No products found in FLOWER IN A VASH.";
    }
} else {
    echo "Query failed: " . $conn->error;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diwali Special</title>
    <link rel="stylesheet" href="css/new-collection.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
                                  <!---------------------MENUBAR----------------------------->

<?php include 'header.php' ?>

  <section class="new-collections">
    <div class="text">
      <h1>Diwali Special </h1>
    </div>
    <div class="new-grid">
      
       <?php
include("database/db_connection.php");

// Fetch products in "NEW COLLECTION"
$newproduct = "SELECT * FROM products WHERE product_category = 'DiwaliSpecial'";
$result = $conn->query($newproduct);

if ($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            ?>
            <div class="new-collection">
                <a href="product_details.php?id=<?php echo $row['id']; ?>" class="link">
                    <img src="database/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                </a>
                <h3><?php echo $row['product_name']; ?></h3>
                <p>RS. <?php echo number_format($row['price'], 2); ?></p>
            </div>
            <?php
        }
    } else {
        echo "<p>No products found in FLOWER IN A VASH.</p>";
    }
} else {
    echo "<p>Query failed: " . $conn->error . "</p>";
}
?>
    </div>
  </section>

  <?php include 'footer.php' ?>

</body>
</html>
