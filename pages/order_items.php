<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');

$sql = "SELECT * FROM order_items";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Order Items</h2>";
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Order ID</th><th>Product ID</th><th>Quantity</th><th>Price</th><th>Actions</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>{$row['id']}</td>";
        echo "<td>{$row['order_id']}</td>";
        echo "<td>{$row['product_id']}</td>";
        echo "<td>{$row['quantity']}</td>";
        echo "<td>{$row['price']}</td>";
        echo "<td> <a href='delete_items.php?id={$row['id']}'>Delete</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No order items found.";
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="add_items.php">Add New Order</a>

</body>
</html>