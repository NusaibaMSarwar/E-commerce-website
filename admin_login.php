<?php
session_start();
include 'db.php'; 

ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "Request method: " . $_SERVER['REQUEST_METHOD'] . "<br>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

       
        $admin_user = 'admin';
        $admin_pass = '1234';

        if ($username === $admin_user && $password === $admin_pass) {
            echo "Login successful! Redirecting...<br>";
            $_SESSION['admin_id'] = 1; 
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo "Invalid username or password!<br>";
        }
    } else {
        echo "Username or password not set!<br>";
    }
} else {
    echo "Invalid request method!<br>";
}
?>

