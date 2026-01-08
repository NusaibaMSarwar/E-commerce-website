<?php
include 'db.php';
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $category = $_POST['category'];
    $quantity = $_POST['quantity'];

    $stmt = $pdo->prepare("UPDATE products SET name = :name, description = :description, price = :price, image = :image, category = :category, quantity = :quantity WHERE id = :id");
    $stmt->execute([
        ':name' => $name,
        ':description' => $description,
        ':price' => $price,
        ':image' => $image,
        ':category' => $category,
        ':quantity' => $quantity,
        ':id' => $id,
    ]);

    header("Location: manage_products.php");
    exit();
}

// Fetch product details for the form
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
        }
        form {
            width: 50%;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        label {
            font-weight: bold;
            display: block;
            margin-top: 10px;
            color: #2c3e50;
        }
        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            box-sizing: border-box;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        input:focus, textarea:focus {
            outline: none;
            border-color: #3498db;
        }
        button {
            background-color: #2ecc71;
            color: white;
            font-weight: bold;
            cursor: pointer;
            border: none;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #27ae60;
        }
        .back-link {
            display: block;
            text-align: center;
            margin: 20px auto;
            color: #3498db;
            text-decoration: none;
            font-size: 16px;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Update Product</h1>
    <form action="alter.php" method="post">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($product['name']) ?>" required>
        
        <label for="description">Description:</label>
        <textarea id="description" name="description" required><?= htmlspecialchars($product['description']) ?></textarea>
        
        <label for="price">Price:</label>
        <input type="number" id="price" name="price" value="<?= $product['price'] ?>" required>
        
        <label for="image">Image URL:</label>
        <input type="text" id="image" name="image" value="<?= htmlspecialchars($product['image']) ?>">
        
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" value="<?= htmlspecialchars($product['category']) ?>" required>
        
        <label for="quantity">Quantity:</label>
        <input type="number" id="quantity" name="quantity" value="<?= $product['quantity'] ?>" required>
        
        <button type="submit">Update Product</button>
    </form>
    <a href="manage_products.php" class="back-link">Back to Manage Products</a>
</body>
</html>
