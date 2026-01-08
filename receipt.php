<?php
session_start();


if (!isset($_SESSION['order'])) {
    header("Location: form.html");
    exit;
}


$order = $_SESSION['order'];
$product_name = htmlspecialchars($order['product_name']);
$product_image = htmlspecialchars($order['product_image']);
$product_price = floatval($order['product_price']);
$product_quantity = intval($order['product_quantity']);
$total_price = $product_price * $product_quantity;

$name = htmlspecialchars($order['name']);
$email = htmlspecialchars($order['email']);
$phone = htmlspecialchars($order['phone']);
$address = htmlspecialchars($order['address']);
$payment = htmlspecialchars($order['payment']);
$notes = htmlspecialchars($order['notes']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0; }
        .container { max-width: 800px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .section { margin-bottom: 20px; }
        .section h2 { margin-bottom: 10px; }
        img { max-width: 150px; border-radius: 8px; }
        .details p { margin: 5px 0; }
        .button-container { text-align: center; margin-top: 20px; }
        .button-container a { padding: 10px 20px; background: #007bff; color: #fff; text-decoration: none; border-radius: 5px; }
        .button-container a:hover { background: #0056b3; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Receipt</h1>
        <div class="section">
            <h2>Product Details</h2>
            <img src="<?php echo $product_image; ?>" alt="Product Image">
            <p><strong>Product Name:</strong> <?php echo $product_name; ?></p>
            <p><strong>Price:</strong> <?php echo $product_price; ?> BDT</p>
            <p><strong>Quantity:</strong> <?php echo $product_quantity; ?></p>
            <p><strong>Total Price:</strong> <?php echo $total_price; ?> BDT</p>
        </div>
        <div class="section">
            <h2>User Details</h2>
            <p><strong>Full Name:</strong> <?php echo $name; ?></p>
            <p><strong>Email:</strong> <?php echo $email; ?></p>
            <p><strong>Phone:</strong> <?php echo $phone; ?></p>
            <p><strong>Address:</strong> <?php echo $address; ?></p>
            <p><strong>Payment Method:</strong> <?php echo $payment; ?></p>
            <p><strong>Notes:</strong> <?php echo $notes; ?></p>
        </div>
        <h1>THANKS FOR YOUR ORDER!</h1>
        <p>You will receive a confirmation email shortly!</p>
        <div class="button-container">
            <a href="form.html">Back to Home</a>
        </div>
    </div>
</body>
</html>

<?php
session_destroy();
?>