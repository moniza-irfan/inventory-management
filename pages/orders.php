<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');

?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders - Inventory Management System</title>
</head>
<body>
    <h2>Orders List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Customer</th>
            <th>Order Date</th>
            <th>Total</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM orders";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['customer_id']}</td>
                    <td>{$row['order_date']}</td>
                    <td>{$row['total']}</td>
                    <td>
                        <a href='edit_order.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete_order.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No orders found</td></tr>";
        }
        ?>
    </table>
    <a href="add_order.php">Add New Order</a>
</body>
</html>
