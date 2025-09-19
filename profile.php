<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['Login_user']) || $_SESSION['Login_user'] !== true) {
    // User is NOT logged in → redirect to login/signup page
    header("Location: signup_login.php");
    exit();
}


// Handle logout request
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php"); // Redirect to home page
    exit();
}

// Handle profile update
if (isset($_POST['saveProfile'])) {
    $_SESSION['fname'] = $_POST['fname'];
    $_SESSION['lname'] = $_POST['lname'];
    $_SESSION['email'] = $_POST['email'];
}

// Handle address update
if (isset($_POST['saveAddress'])) {
    $_SESSION['home_no'] = $_POST['home_no'];
    $_SESSION['area'] = $_POST['area'];
    $_SESSION['city'] = $_POST['city'];
    $_SESSION['state'] = $_POST['state'];
    $_SESSION['pincode'] = $_POST['pincode'];
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - E-commerce</title>
    <link rel="stylesheet" href="css/profile.css">
    <link rel="icon" href="">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>
    <?php include('header.php'); ?>
    <!-- Sidebar -->
   <div class="container">
        <!-- Sidebar -->
        <div class="sidebar">
            <h2>My Account</h2>
            <a href="#" data-section="profile">Profile</a>
            <a href="#" data-section="address">Address</a>
            <a href="#" data-section="orders">Orders</a>
            <a href="#" data-section="settings">Settings</a>
            <a href="#" id="logoutBtn">Logout</a>
        </div>

    <!-- Main Content -->
    <div class="content">

        <!-- Profile -->
        <div id="profile" class="card section active">
            <h2>Profile Information</h2>
            <div id="profileDisplay">
                <p><b>First Name:</b> <span><?php echo $_SESSION['fname']; ?></span></p>
                <p><b>Last Name:</b> <span><?php echo $_SESSION['lname']; ?></span></p>
                <p><b>Email:</b> <span><?php echo $_SESSION['email']; ?></span></p>
                <button onclick="toggleForm('profileForm','profileDisplay')">Edit Profile</button>
            </div>
            <form id="profileForm" method="post" style="display:none;">
                <input type="text" name="fname" value="<?php echo $_SESSION['fname']; ?>" required>
                <input type="text" name="lname" value="<?php echo $_SESSION['lname']; ?>" required>
                <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" required>
                <button type="submit" name="saveProfile">Save</button>
                <button type="button" onclick="toggleForm('profileDisplay','profileForm')">Cancel</button>
            </form>


            <!-- ✅ Recent Products Section -->
            <div class="recent-products" style="margin-top:400px;">
                <h3>Recently Viewed Products</h3>
                <div style="display:flex; gap:15px; flex-wrap:wrap;">
                    <div style="background:#f9fafb; padding:10px; border-radius:8px; width:120px; text-align:center;">
                        <img src="images/product1.jpg" alt="Product 1" style="width:100%; border-radius:6px;">
                        <p style="margin:5px 0; font-size:14px;">Product 1</p>
                        <span style="font-size:13px; color:#2563eb;">₹499</span>
                    </div>
                    <div style="background:#f9fafb; padding:10px; border-radius:8px; width:120px; text-align:center;">
                        <img src="images/product2.jpg" alt="Product 2" style="width:100%; border-radius:6px;">
                        <p style="margin:5px 0; font-size:14px;">Product 2</p>
                        <span style="font-size:13px; color:#2563eb;">₹799</span>
                    </div>
                    <div style="background:#f9fafb; padding:10px; border-radius:8px; width:120px; text-align:center;">
                        <img src="images/product3.jpg" alt="Product 3" style="width:100%; border-radius:6px;">
                        <p style="margin:5px 0; font-size:14px;">Product 3</p>
                        <span style="font-size:13px; color:#2563eb;">₹999</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Address -->
        <div id="address" class="card section">
            <h2>Address</h2>
            <div id="addressDisplay">
                <p><b>Home Number:</b> <span><?= $_SESSION['home_no'] ?? ''; ?></span></p>
                <p><b>Area:</b> <span><?= $_SESSION['area'] ?? ''; ?></span></p>
                <p><b>City:</b> <span><?= $_SESSION['city'] ?? ''; ?></span></p>
                <p><b>State:</b> <span><?= $_SESSION['state'] ?? ''; ?></span></p>
                <p><b>Pincode:</b> <span><?= $_SESSION['pincode'] ?? ''; ?></span></p>

                <button onclick="toggleForm('addressForm','addressDisplay')">Edit Address</button>
            </div>

            <form id="addressForm" method="post" style="display:none;">
                <input type="text" name="home_no" placeholder="Home Number" value="<?= $_SESSION['home_no'] ?? ''; ?>"
                    required>
                <input type="text" name="area" placeholder="Area" value="<?= $_SESSION['area'] ?? ''; ?>" required>
                <input type="text" name="city" placeholder="City" value="<?= $_SESSION['city'] ?? ''; ?>" required>
                <input type="text" name="state" placeholder="State" value="<?= $_SESSION['state'] ?? ''; ?>" required>
                <input type="text" name="pincode" placeholder="Pincode" value="<?= $_SESSION['pincode'] ?? ''; ?>"
                    required>
                <button type="submit" name="saveAddress">Save</button>
                <button type="button" onclick="toggleForm('addressDisplay','addressForm')">Cancel</button>
            </form>
        </div>

        <!-- Orders -->
        <div id="orders" class="card section">
            <h2>My Orders</h2>
            <p>No orders yet.</p>
        </div>

        <!-- Settings -->
        <div id="settings" class="card section">
            <h2>Settings</h2>
            <div class="setting-option">
                <span>Change Password</span>
                <button>Update</button>
            </div>
            <div class="setting-option">
                <span>Email Notifications</span>
                <label class="switch"><input type="checkbox" checked><span class="slider"></span></label>
            </div>
            <div class="setting-option">
                <span>Dark Mode</span>
                <label class="switch"><input type="checkbox" id="themeToggle"><span class="slider"></span></label>
            </div>
        </div>
    </div>
    </div>

    <!-- Logout Popup -->
    <div class="logout-popup" id="logoutPopup">
        <div class="box">
            <h3>Are you sure you want to logout?</h3>
            <button class="yes" onclick="window.location.href='?logout=true'">Yes, Logout</button>
            <button class="no" onclick="closeLogout()">Cancel</button>
        </div>
    </div>

    <script>
        // Sidebar switching
        document.querySelectorAll(".sidebar a[data-section]").forEach(link => {
            link.addEventListener("click", function (e) {
                e.preventDefault();
                document.querySelectorAll(".section").forEach(sec => sec.classList.remove("active"));
                document.getElementById(this.dataset.section).classList.add("active");
            });
        });

        // Toggle forms
        function toggleForm(showId, hideId) {
            document.getElementById(showId).style.display = "block";
            document.getElementById(hideId).style.display = "none";
        }

        // Logout popup
        const logoutBtn = document.getElementById("logoutBtn");
        const logoutPopup = document.getElementById("logoutPopup");
        logoutBtn.addEventListener("click", (e) => { e.preventDefault(); logoutPopup.style.display = "flex"; });
        function closeLogout() { logoutPopup.style.display = "none"; }

        // Dark mode toggle
        const themeToggle = document.getElementById("themeToggle");
        themeToggle.addEventListener("change", () => {
            if (themeToggle.checked) {
                document.body.style.background = "#1e293b";
                document.body.style.color = "#f8fafc";
            } else {
                document.body.style.background = "#f4f6f9";
                document.body.style.color = "#333";
            }
        });
    </script>
</body>

</html>