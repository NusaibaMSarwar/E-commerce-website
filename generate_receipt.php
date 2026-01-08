<?php
session_start();
include_once 'db.php'; 

if (!isset($_SESSION['user_id'])) {
    die("User not logged in. Please log in to proceed.");
}

$product_name = $_POST['product_name'];
$product_image = $_POST['product_image'];
$product_price = floatval($_POST['product_price']);
$product_quantity = intval($_POST['product_quantity']);
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$payment = $_POST['payment'];
$notes = $_POST['notes'] ?? 'No notes provided';
$total_price = $product_price * $product_quantity;
$user_id = $_SESSION['user_id']; 


try {
    
    $conn = new mysqli("localhost", "root", "", "ecommerce");
    if ($conn->connect_error) {
        die("Database connection failed: " . $conn->connect_error);
    }

    
    $stmt = $conn->prepare("INSERT INTO orders (user_id, total_price, status) VALUES (?, ?, ?)");
    $status = "Pending"; 
    $stmt->bind_param("ids", $user_id, $total_price, $status);
    $stmt->execute();

    
    $order_id = $stmt->insert_id;

    
    $stmt->close();
    $conn->close();

    
    $_SESSION['order'] = [
        'product_name' => $product_name,
        'product_image' => $product_image,
        'product_price' => $product_price,
        'product_quantity' => $product_quantity,
        'total_price' => $total_price,
        'name' => $name,
        'email' => $email,
        'phone' => $phone,
        'address' => $address,
        'payment' => $payment,
        'notes' => $notes,
        'order_id' => $order_id 
    ];

    
    header("Location: receipt.php");
    exit;
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>
