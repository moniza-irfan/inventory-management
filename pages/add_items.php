<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_order_item'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $quantity = mysqli_real_escape_string($conn, $_POST['quantity']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);

    $check_order_sql = "SELECT id FROM orders WHERE id = ?";
    $check_order_stmt = $conn->prepare($check_order_sql);
    $check_order_stmt->bind_param("i", $order_id);
    $check_order_stmt->execute();
    $result = $check_order_stmt->get_result();

    if ($result->num_rows == 0) {
        echo " The provided order ID does not exist.";
        exit(); 
    }

    $insert_sql = "INSERT INTO order_items (order_id, product_id, quantity, price) 
                   VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iiid", $order_id, $product_id, $quantity, $price);
    
    if ($insert_stmt->execute()) {
        header("Location: order_items.php");
        exit();
    } else {
        echo "Error adding order item: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Order Item</title>
    <link rel="stylesheet" type="text/css" href="../public/css/addI.css">

</head>
<body>
    <div class="container">
        <h2>Add Order Item</h2>
        <form method="post" action="">
            <label for="order_id">Order ID:</label>
            <input type="text" id="order_id" name="order_id" required>
            
            <label for="product_id">Product ID:</label>
            <input type="text" id="product_id" name="product_id" required>
            
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required>
            
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required>
            
            <button type="submit" name="add_order_item">Add Order Item</button>
        </form>
    </div>
</body>
</html>
