<?php
include 'db.php'; 
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Fetch orders
$stmt = $pdo->query("SELECT * FROM orders");
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #2c3e50;
        }

        /* Table Styling */
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
            text-transform: uppercase;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td {
            font-size: 14px;
        }

        .status {
            padding: 6px 12px;
            border-radius: 4px;
            color: white;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 12px;
        }
        .status.Pending {
            background-color:rgb(177, 117, 20);
        }
        .status.Completed {
            background-color: #2ecc71;
        }
        .status.Cancelled {
            background-color:rgb(192, 22, 3);
        }

        a {
            text-decoration: none;
            color: #3498db;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h1>Manage Orders</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>User ID</th>
            <th>Total Price</th>
            <th>Status</th>
        </tr>
        <?php foreach ($orders as $order): ?>
        <tr>
            <td><?= $order['id'] ?></td>
            <td><?= $order['user_id'] ?></td>
            <td><?= number_format($order['total_price'], 2) ?> BDT</td>
            <td>
                <span class="status <?= htmlspecialchars($order['status']) ?>">
                    <?= htmlspecialchars($order['status']) ?>
                </span>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
