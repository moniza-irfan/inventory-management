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
    <title>Purchases - Inventory Management System</title>
</head>
<body>
    <h2>Purchases List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Product</th>
            <th>Supplier</th>
            <th>Quantity</th>
            <th>Purchase Date</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT purchases.*, products.name as product_name, suppliers.name as supplier_name 
                FROM purchases
                LEFT JOIN products ON purchases.product_id = products.id
                LEFT JOIN suppliers ON purchases.supplier_id = suppliers.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['product_name']}</td>
                    <td>{$row['supplier_name']}</td>
                    <td>{$row['quantity']}</td>
                    <td>{$row['purchase_date']}</td>
                    <td>
                        <a href='edit_purchase.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete_purchase.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No purchases found</td></tr>";
        }
        ?>
    </table>
    <a href="add_purchase.php">Add New Purchase</a>
</body>
</html>
