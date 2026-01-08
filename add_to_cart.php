<?php
include 'includes/db.php';

session_start();
$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

$stmt = $pdo->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
$stmt->execute([$user_id, $product_id, $quantity]);

echo "Added to cart!";
?>
