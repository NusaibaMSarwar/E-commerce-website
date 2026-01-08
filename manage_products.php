<?php
include 'db.php'; 
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}


$stmt = $pdo->query("SELECT * FROM products");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
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

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #3498db;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }

        
        a {
            text-decoration: none;
            color: #3498db;
        }
        a:hover {
            text-decoration: underline;
        }

        .action-link {
            color: #e74c3c;
            font-weight: bold;
            padding: 5px 10px;
            border: 1px solid #e74c3c;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        .action-link:hover {
            background: #e74c3c;
            color: white;
        }

        
        .add-product {
            display: block;
            text-align: center;
            margin: 20px auto;
            padding: 10px 20px;
            background: #2ecc71;
            color: white;
            font-size: 16px;
            border-radius: 4px;
            text-decoration: none;
            width: fit-content;
        }
        .add-product:hover {
            background: #27ae60;
        }
    </style>
</head>
<body>
    <h1>Manage Products</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Action</th>
            <th>Action</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= htmlspecialchars($order['name']) ?></td>
            <td><?= htmlspecialchars($order['description']) ?></td>
            <td><?= number_format($order['price'], 2) ?> BDT</td>
            <td><img src="<?= htmlspecialchars($order['image']) ?>" alt="Product Image" style="max-width: 100px; height: auto;"></td>
            <td><?= htmlspecialchars($order['category']) ?></td>
            <td><?= $order['quantity'] ?></td>
            <td>
                <a href="delete.php?id=<?= $order['id'] ?>" class="action-link">Delete</a>
            </td>
            <td>
                <a href="alter.php?id=<?= $order['id'] ?>" class="action-link">Update</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="add_product.php" class="add-product">Add Product</a>
</body>
</html>
