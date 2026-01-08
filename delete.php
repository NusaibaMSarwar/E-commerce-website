<?php  
include 'db.php';  

if (isset($_GET['id'])) {  
    $id = intval($_GET['id']); // Sanitize the ID to prevent SQL injection

    try {
        // Prepare the SQL DELETE statement
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$id]);

        if ($stmt->rowCount() > 0) {
            header("Location: manage_products.php");
            exit();
        } else {
            echo "Error: Product not found or could not be deleted.";
        }
    } catch (PDOException $e) {
        echo "Error deleting record: " . $e->getMessage();
    }
} else {     
    echo "No ID provided!";  
}  
?>
 
