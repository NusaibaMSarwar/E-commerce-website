<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']); 

    try {
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user) {
            if ($user['password'] === $password) { 
                session_start();
                $_SESSION['user_id'] = $user['id']; 
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];

               
                header("Location: profile.php");
                exit();
            } else {
                echo "<script>alert('Invalid password. Please try again.'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('No user found with the username: $username'); window.history.back();</script>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

