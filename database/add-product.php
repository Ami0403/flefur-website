<?php
 include("db_connection.php");

// Handle form submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['product_name']);
    $price = trim($_POST['price']);
    $desc = trim($_POST['product_description']);
    $categoery=trim($_POST['product_categoery']);
    

    // Image Upload
    $uploadDir = "uploads/";
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true); // Create uploads folder if not exist
    }

    $fileName = time() . "_" . basename($_FILES["product_image"]["name"]);
    $targetFile = $uploadDir . $fileName;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Validation
    $errors = [];
    if (empty($name)) $errors[] = "Product name is required.";
    if(empty($categoery)) $errors[] = "Product Categoery Required";
    if (empty($price) || !is_numeric($price)) $errors[] = "Valid price is required.";
    if (empty($desc)) $errors[] = "Product description is required.";
    if (!isset($_FILES["product_image"]) || $_FILES["product_image"]["error"] != 0) {
        $errors[] = "Product image is required.";
    }

    // Allowed image types
    $allowedTypes = ["jpg", "jpeg", "png", "gif","webp"];
    if (!in_array($imageFileType, $allowedTypes)) {
        $errors[] = "Only JPG, JPEG, PNG & GIF allowed.";
    }

    if (empty($errors)) {
        if (move_uploaded_file($_FILES["product_image"]["tmp_name"], $targetFile)) {
            // Insert into DB
           $sql = "INSERT INTO products (product_category, product_name, product_image, price, product_description) 
        VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssds", $categoery, $name, $targetFile, $price, $desc);

            if ($stmt->execute()) {
                echo "<p class='success'>✅ Product added successfully!</p>";
            } else {
                echo "<p class='error'>❌ Database error: " . $conn->error . "</p>";
            }
        } else {
            echo "<p class='error'>❌ Failed to upload image.</p>";
        }
    } else {
        foreach ($errors as $err) {
            echo "<p class='error'>⚠ $err</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f6f8fa;
            padding: 30px;
        }
        .form-container {
            background: #fff;
            padding: 25px;
            max-width: 500px;
            margin: auto;
            border-radius: 10px;
            box-shadow: 0px 3px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #444;
        }
        label {
            font-weight: bold;
            margin-top: 10px;
            display: block;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 6px;
            border: 1px solid #ccc;
        }
        input[type="file"] {
            border: none;
        }
        button {
            background: #28a745;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            margin-top: 15px;
            width: 100%;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
        .error {
            color: #d9534f;
            background: #f9d6d5;
            padding: 8px;
            border-radius: 5px;
            margin-top: 10px;
        }
        .success {
            color: #155724;
            background: #d4edda;
            padding: 8px;
            border-radius: 5px;
            margin-top: 10px;
        }
        /* Form group spacing */
.form-group {
  margin-bottom: 15px;
}

/* Label styling */
.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 500;
  color: #333;
}

/* Custom file input styled like Bootstrap */
.form-control {
  display: block;
  width: 100%;
  padding: 10px 12px;
  font-size: 14px;
  line-height: 1.5;
  color: #495057;
  background-color: #fff;
  border: 1px solid #ced4da;
  border-radius: 6px;
  transition: border-color 0.2s ease-in-out, box-shadow 0.2s ease-in-out;
}

/* Focus effect */
.form-control:focus {
  border-color: #80bdff;
  outline: none;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
}

    </style>
</head>
<body>
<div class="form-container">
    <h2>Add New Product</h2>
    <form method="POST" action="" enctype="multipart/form-data" novalidate onsubmit="return validateForm()">
        <label>Product categoery:</label>
        <input type="text" name="product_categoery" id="product_categoery" >
         <label>Product Name:</label>
        <input type="text" name="product_name" id="product_name" required>

        <label>Price (₹):</label>
        <input type="number" step="0.01" name="price" id="price" required>

        <label>Product Description:</label>
        <textarea name="product_description" id="product_description" rows="4" required></textarea>

       <div class="mb-3">
  <label for="product_image" class="form-label">Product Image:</label>
  <input type="file" class="form-control" name="product_image" id="product_image" accept="image/*" required>
</div>


        <button type="submit">Add Product</button>
    </form>
</div>

<script>
function validateForm() {
    let name = document.getElementById("product_name").value.trim();
    let price = document.getElementById("price").value.trim();
    let desc = document.getElementById("product_description").value.trim();
    let image = document.getElementById("product_image").value;

    if (name === "" || price === "" || desc === "" || image === "") {
        alert("All fields are required!");
        return false;
    }
    if (isNaN(price) || price <= 0) {
        alert("Please enter a valid price!");
        return false;
    }
    return true;
}
</script>
</body>
</html>
