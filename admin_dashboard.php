<?php
include 'db.php'; 
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}


$product_count = $pdo->query("SELECT SUM(quantity) FROM products")->fetchColumn();
$order_count = $pdo->query("SELECT COUNT(*) FROM orders")->fetchColumn();
$total_sales = $pdo->query("SELECT SUM(total_price) FROM orders WHERE status = 'Completed'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            color: #333;
            background-image: url("image/background.jpg");
            background-size: cover;
            background-position: center;
        }
        h1, h2 {
            color: #2c3e50;
        }
        a {
            text-decoration: none;
            color: #3498db;
        }
        a:hover {
            text-decoration: underline;
        }

        /* Container */
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        
        .dashboard-overview {
            margin-bottom: 20px;
        }
        .dashboard-overview p {
            font-size: 18px;
            margin: 10px 0;
        }

        
        .quick-actions ul {
            list-style-type: none;
            padding: 0;
        }
        .quick-actions li {
            margin: 10px 0;
        }
        .quick-actions li a {
            background: #3498db;
            color: #fff;
            padding: 10px 15px;
            border-radius: 4px;
            display: inline-block;
            transition: background-color 0.3s ease;
        }
        .quick-actions li a:hover {
            background: #2980b9;
        }

        
        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #e74c3c;
            color: #fff;
            border-radius: 4px;
            text-align: center;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background: #c0392b;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, Admin</h1>
        <div class="dashboard-overview">
            <h2>Dashboard Overview</h2>
            <p>Total Products: <strong><?= $product_count ?></strong></p>
            <p>Total Orders: <strong><?= $order_count ?></strong></p>
            <p>Total Sales: <strong><?= $total_sales ?> BDT</strong></p>
        </div>
        <div class="quick-actions">
            <h2>Quick Actions</h2>
            <ul>
                <li><a href="manage_products.php">Manage Products</a></li>
                <li><a href="manage_orders.php">Manage Orders</a></li>
                <li><a href="add_product.php">Add Products</a></li>
            </ul>
        </div>
        <a href="logout.php" class="logout-btn">Logout</a>
    </div>
</body>
</html>

