<?php
include 'includes/db.php';

session_start();
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT c.id, p.name, p.price, c.quantity 
                       FROM cart c 
                       JOIN products p ON c.product_id = p.id 
                       WHERE c.user_id = ?");
$stmt->execute([$user_id]);
$cart = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($cart);
?>
