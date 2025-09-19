<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FLOWER IN A BOX</title>
    <link rel="stylesheet" href="css/about.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
                                  <!---------------------MENUBAR----------------------------->

  <nav class="navbar">
    <!-- Logo -->
    <div class="logo">FLEUR</div>

    <!-- Menu -->
    <div class="menu">
      <a href="index.php" class="hov">HOME</a>
      <a href="#" class="hov">ABOUT US</a>

      <!-- Dropdown -->
      <div class="dropdown">
        <a href="#" class="hov">COLLECTIONS</a>
        <div class="dropdown-content">
          <a href="new-collection.php">NEW COLLECTION</a>
          <a href="flower_in_a_box.php">FLOWER IN A BOX</a>
          <a href="flower_in_a_vash.php">FLOWER IN A VASE</a>
          <a href="#">LUXURY</a>
        </div>
      </div>
      <div class="dropdown">
         <a href="#" class="hov">OCCASIONS</a>
        <div class="dropdown-content">
          <a href="#">DIWALI COLLECTION</a>
          <a href="#">BIRTHDAY COLLECTION</a>
          <a href="#">ANNIVERSARY COLLECTION</a>
          <a href="#">LOVE</a>
          <a href="#">FATHER'S DAY COLLECTION</a>
        </div>
      </div>  
    </div>

    <!-- Search -->
    <div class="search-box">
      <input type="text" placeholder="SEARCH">
      <i class="fa fa-search"></i>
    </div>

    <!-- Icons -->
    <div class="icons">
      <i class="fa-solid fa-bag-shopping"></i>
      <i class="fa-regular fa-user"></i>
    </div>
  </nav>

       <!-- Hero Section -->
    <section class="hero">
        <div class="overlay">
            <h1>About FLEUR</h1>
            <p>Where Flowers Last Forever</p>
        </div>
    </section>

    <!-- Wavy Divider -->
    <div class="wave"></div>

    <!-- Our Story -->
    <section class="our-story">
        <h2>Our Story</h2>
        <p>
            FLEUR began as a small passion project in a sunlit corner of a home studio, 
            where delicate petals and fragrant stems were lovingly arranged by hand. 
            We wanted to capture the fleeting beauty of blooms and preserve them in a way 
            that could be cherished for years.
        </p>
        <p>
            Today, our atelier blends traditional floral artistry with contemporary design. 
            We work with ethical suppliers to source flowers at their peak, which are then 
            carefully preserved to retain their natural elegance. Each arrangement is unique, 
            telling a story of nature’s grace and the human touch.
        </p>
        <p>
            Whether it’s a romantic bouquet for a wedding, a gentle arrangement to brighten 
            a home, or a thoughtful gift for someone special, FLEUR brings the poetry of 
            flowers into everyday life. Every creation is wrapped in love, care, and our 
            signature timeless style.
        </p>
    </section>

    <!-- Wavy Divider -->
    <div class="wave flip"></div>

    <!-- Our Process -->
   <section class="how-we-create">
    <h2>How We Create</h2>
    <div class="steps">
        <div class="step">
            <img src="images/selecting-flower.jpg" alt="Selecting Flowers">
            <div class="text">
                <h3>Selecting Flowers</h3>
                <p>We carefully choose blooms for their beauty, color, and longevity to ensure your arrangement will look stunning for months or even years.</p>
            </div>
        </div>
        <div class="step">
            <img src="images/pre_flower.jpg" alt="Preserving">
            <div class="text">
                <h3>Preservation</h3>
                <p>Our eco-friendly drying techniques lock in each flower’s shape and hue without the use of harsh chemicals.</p>
            </div>
        </div>
        <div class="step">
            <img src="images/Arranging.jpg" alt="Arranging">
            <div class="text">
                <h3>Arranging</h3>
                <p>Our floral designers handcraft each arrangement with a balance of colors, textures, and proportions for a timeless piece.</p>
            </div>
        </div>
    </div>
</section>


    <!-- Wavy Divider -->
    <div class="wave"></div>

    <!-- Meet the Team -->
<section class="about-team">
    <h2 class="about-team-title">Meet the Team</h2>
    <div class="about-team-cards">
        <div class="about-team-card">
            <div class="about-team-image-container">
                <img src="images/teem/Amelia Rose.jpg" alt="Amelia Rose">
                <div class="about-team-overlay">
                    <h3>Amelia Rose</h3>
                    <p>Founder & Lead Designer — blending artistry and sustainability for timeless floral pieces.</p>
                </div>
            </div>
        </div>
        <div class="about-team-card">
            <div class="about-team-image-container">
                <img src="images/teem/Liam Bloom.jpg" alt="Liam Bloom">
                <div class="about-team-overlay">
                    <h3>Liam Bloom</h3>
                    <p>Preservation Specialist — maintaining beauty with eco-friendly methods.</p>
                </div>
            </div>
        </div>
        <div class="about-team-card">
            <div class="about-team-image-container">
                <img src="images/teem/Sophia Fleur.jpg" alt="Sophia Fleur">
                <div class="about-team-overlay">
                    <h3>Sophia Fleur</h3>
                    <p>Customer Happiness — helping customers find the perfect arrangement for any occasion.</p>
                </div>
            </div>
        </div>
    </div>
</section>

    <!-- Gallery Section -->
<section class="store-gallery">
  <h2>Our Store Gallery</h2>
  <p>Take a glimpse inside our atelier where creativity and flowers bloom together.</p>

  <div class="gallery-container">
    <!-- Left Arrow -->
    <button class="gallery-btn left" onclick="scrollGallery(-1)">
      <i class="fa-solid fa-chevron-left"></i>
    </button>

    <!-- Images -->
    <div class="gallery-row" id="galleryRow">
      <div class="gallery-item"><img src="images/gallary/gallary_1.jpg" alt="Flower Shop Interior"></div>
      <div class="gallery-item"><img src="images/gallary/gallery_2.jpg" alt="Flower Display"></div>
      <div class="gallery-item"><img src="images/gallary/gallary_3.jpg" alt="Bouquet Arrangement"></div>
      <div class="gallery-item"><img src="images/gallary/gallery_4.jpg" alt="Luxury Collection"></div>
      <div class="gallery-item"><img src="images/gallary/gallery_5.jpg" alt="Customer Area"></div>
      <div class="gallery-item"><img src="images/gallary/gallery_6.jpg" alt="Gift Wrapping Station"></div>
    </div>

    <!-- Right Arrow -->
    <button class="gallery-btn right" onclick="scrollGallery(1)">
      <i class="fa-solid fa-chevron-right"></i>
    </button>
  </div>
</section>


<?php include 'footer.php' ?>

<script>
function scrollGallery(direction) {
  const row = document.getElementById("galleryRow");
  const scrollAmount = 320; // move one image (300px + gap)
  row.scrollBy({ left: direction * scrollAmount, behavior: "smooth" });
}
</script>


</body>
</html>
