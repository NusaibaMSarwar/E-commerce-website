<?php
include 'includes/db.php';

session_start();
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT SUM(p.price * c.quantity) AS total_price 
                       FROM cart c 
                       JOIN products p ON c.product_id = p.id 
                       WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$total_price = $stmt->fetchColumn();

$order_stmt = $pdo->prepare("INSERT INTO orders (user_id, total_price) VALUES (?, ?)");
$order_stmt->execute([$user_id, $total_price]);

$pdo->prepare("DELETE FROM cart WHERE user_id = ?")->execute([$user_id]);

echo "Order placed!";
?>
