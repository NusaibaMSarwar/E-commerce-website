<?php
session_start();


if (!isset($_SESSION['user_id'])) {
    
    header("Location: login.php");
    exit();
}


$username = htmlspecialchars($_SESSION['username']);
$email = htmlspecialchars($_SESSION['email']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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

        .user-info {
            margin-top: 20px;
        }

        .user-info p {
            font-size: 1.1em;
            color: #555;
            margin: 10px 0;
        }

        .logout {
            display: block;
            text-align: center;
            margin-top: 30px;
        }

        .logout a {
            text-decoration: none;
            color: #fff;
            background-color: #ff6a00;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout a:hover {
            background-color: #e55a00;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome, <?= $username ?>!</h1>
        <div class="user-info">
            <p><strong>Username:</strong> <?= $username ?></p>
            <p><strong>Email:</strong> <?= $email ?></p>
        </div>
        <div class="logout">
            <a href="logout.php">Logout</a>
        </div>
        <div class="Explore">
            <a href="explore.html">Go Back To Homepage</a>
        </div>
    </div>
</body>
</html>
