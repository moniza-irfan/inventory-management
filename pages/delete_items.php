<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}
include('../includes/db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $delete_sql = "DELETE FROM order_items WHERE id = $id";
    
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: order_items.php");
        exit();
    } else {
        echo "Error deleting order item: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
