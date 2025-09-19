<?php
include("database/db_connection.php");

$productQuery = "SELECT * FROM products WHERE product_category = 'BEST SELLER'";
$result = $conn->query($productQuery);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>FLEUR</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
  <?php include 'header.php' ?>

  <!---------------------OFFERS----------------------------->

  <div class="offer-slider stagger">
    <div class="offer-slide active" style="background-image: url('images/offer_!.png');">
      <div class="content">
        <h1>FATHER'S DAY COLLECTION</h1>
        <button>SHOP NOW</button>
      </div>
    </div>

    <div class="offer-slide" style="background-image: url('images/offer_2.png');">
      <div class="content">
        <h1>NEW COLLECTION</h1>
        <button>SHOP NOW</button>
      </div>
    </div>
  </div>

  <!---------------------BEST-SELLER----------------------------->

  <section class="best-sellers stagger">
    <div class="section-header">
      <h2 class="tab-btn active" data-target="best-sellers">BEST SELLERS</h2>
      <h2 class="tab-btn" data-target="add-ons">ADD ONS</h2>
    </div>

    <div class="tab-content" id="best-sellers">
      <div class="product-grid">
        <!-- Product 1 -->
        <?php
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product-card">
              <a href="product_details.php?id=<?php echo $row['id']; ?>" class="link">
                <img src="database/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
              </a>
              <h3><?php echo $row['product_name']; ?></h3>
              <p>RS. <?php echo number_format($row['price'], 2); ?></p>
            </div>
            <?php
          }
        } else {
          echo "<p>No products available.</p>";
        } ?>
      </div>

      <!-- ADD ONS -->
      <div class="tab-content hidden" id="add-ons">
        <div class="product-grid">
          <div class="product-card">
            <img src="images/add_ons/Chocolate-Box.jpg" alt="Chocolate Box">
            <h3>Chocolate Box</h3>
            <p>RS. 800</p>
          </div>
          <div class="product-card">
            <img src="images/add_ons/Soft-Teddy.jpg" alt="Soft Teddy">
            <h3>Soft Teddy</h3>
            <p>RS. 1,200</p>
          </div>
          <div class="product-card">
            <img src="images/add_ons/Scented-Candle.jpg" alt="Soft Teddy">
            <h3>Scented Candle</h3>
            <p>RS. 1,200</p>
          </div>
          <div class="product-card">
            <img src="images/add_ons/reeting-Card.jpg" alt="Soft Teddy">
            <h3>Greeting Card</h3>
            <p>RS. 1,200</p>
          </div>
          <div class="product-card">
            <img src="images/add_ons/Mini-Cake.jpg" alt="Soft Teddy">
            <h3>Mini Cake</h3>
            <p>RS. 1,200</p>
          </div>
          <div class="product-card">
            <img src="images/add_ons/Colorful-Balloons.jpg" alt="Soft Teddy">
            <h3>Colorful Balloons</h3>
            <p>RS. 1,200</p>
          </div>
        </div>
      </div>
  </section>

  <!---------------------OFFER-GALLERY----------------------------->

  <section class="product-gallery stagger">
    <div class="produc-img" style="background-image: url('images/classic_cubo.png');">
      <div class="content">
        <h1>CLASSIC CUBO</h1>
        <a href="ClassicCubo.php">
          <button>SHOP NOW</button></a>
      </div>
    </div>
    <div class="produc-img" style="background-image: url('images/classic.png');">
      <div class="content">
        <h1>CLASSIC RONDE</h1>
        <a href="ClassicRonde.php">
          <button>SHOP NOW</button></a>
      </div>
    </div>
    <div class="produc-img" style="background-image: url('images/crysital.png');">
      <div class="content">
       <h1>CRYSTAL GRANDE</h1> 
       <a href=" CrystalGrande.php">
        <button>SHOP NOW</button></a>
      </div>
    </div>
  </section>
  <!---------------------ABOUT-US----------------------------->
  <section class="about-us stagger">
    <div class="about-img">
      <img src="images/VALENTINE'S DAY.jpg" alt="">+
    </div>
    <div class="content">
      <h1>FLEUR ABOUT</h1>
      <P>Each milestone, each relationship, every kind of bond
        calls for a unique celebration. A celebration
        of moments and emotions that are just blooming,
        even celebrating those that have already blossomed.
        For such moments, there are luxury flower arrangements
        by The Flower Company.</P>
      <p>Aesthetically appealing to the eye, these flower
        arrangements mark the strength of a bond, bring out the
        butterfly-blushed smile of an 18-year-old girl, highlight
        the rouge on a mother’s face when she hears from her
        distant son. These flowers laden this moment with beauty
        , luxury and panache and evoke a part of you that only
        poetry can do justice to.</p>
    </div>
  </section>

  <section class="about-sellers">
    <div class="about-header">
      <h2>ABOUT US</h2>
      <p>Poetry in a box</p>
    </div>
    <hr>

    <section class="featured-products stagger">
      <h2>FEATURED PRODUCTS</h2>

      <div class="product-container">
        <!-- Product 1 -->
        <div class="product">
          <img src="images/1.jpg" alt="Lilies Classic Cubo">
        </div>

        <?php

        include("database/db_connection.php");

        $productQuery = "SELECT * FROM products WHERE product_category = 'Featured Products'";
        $result = $conn->query($productQuery);

        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            ?>
            <div class="product-card">
              <a href="product_details.php?id=<?php echo $row['id']; ?>" class="link">
                <img src="database/<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
              </a>
              <h3><?php echo $row['product_name']; ?></h3>
              <p>RS. <?php echo number_format($row['price'], 2); ?></p>
            </div>
            <?php
          }
        } else {
          echo "<p>No products available.</p>";
        } ?>

      </div>
    </section>

    <?php include 'footer.php' ?>

    <script src="js/script.js"></script>
</body>

</html>