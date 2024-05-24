<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $check_order_items_sql = "SELECT COUNT(*) AS count FROM order_items WHERE product_id = $id";
    $check_order_items_result = $conn->query($check_order_items_sql);
    
    $row = $check_order_items_result->fetch_assoc();
    $order_item_count = $row['count'];
    
    if ($order_item_count > 0) {
        echo "Cannot delete product. There are associated orders.";
    } else {
        $delete_product_sql = "DELETE FROM products WHERE id = $id";
        if ($conn->query($delete_product_sql) === TRUE) {
            header("Location: products.php");
            exit();
        } else {
            echo "Error deleting product: " . $conn->error;
        }
    }
}
?>
