<?php
include 'db.php'; 
session_start();

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and validate input data
    $name = htmlspecialchars(trim($_POST['name']));
    $description = htmlspecialchars(trim($_POST['description']));
    $price = floatval($_POST['price']);
    $category = htmlspecialchars(trim($_POST['category']));
    $image = $_FILES['image']['name'];
    $quantity = floatval($_POST['quantity']);

    // Check if uploads directory exists
    $upload_dir = "../uploads/";
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    // Handle file upload
    $target_file = $upload_dir . basename($image);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        try {
            // Insert product data into the database
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, category, image, quantity) VALUES (?, ?, ?, ?, ?,?)");
            $stmt->execute([$name, $description, $price, $category, $image, $quantity]);

            $success_message = "Product added successfully!";
        } catch (Exception $e) {
            $error_message = "Failed to add product: " . $e->getMessage();
        }
    } else {
        $error_message = "Failed to upload the image.";
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
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            background-image: url("image/background.jpg");
            background-size: cover;
            background-position: center;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin: 10px 0 5px;
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="file"],
        textarea {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .message {
            text-align: center;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .success {
            color: green;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Product</h1>
        <!-- Display messages -->
        <?php if (isset($success_message)): ?>
            <p class="message success"><?= htmlspecialchars($success_message) ?></p>
        <?php endif; ?>
        <?php if (isset($error_message)): ?>
            <p class="message error"><?= htmlspecialchars($error_message) ?></p>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data">
            <label for="name">Product Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter product name" required>

            <label for="description">Description:</label>
            <textarea name="description" id="description" placeholder="Enter product description" required></textarea>

            <label for="price">Price (BDT):</label>
            <input type="number" step="0.01" name="price" id="price" placeholder="Enter product price" required>

            <label for="category">Category:</label>
            <input type="text" name="category" id="category" placeholder="Enter product category" required>

            <label for="image">Image:</label>
            <input type="file" name="image" id="image" accept="image/*" required>

            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" value="1" required>

            <button type="submit">Add Product</button>
        </form>
    </div>
</body>
</html>
