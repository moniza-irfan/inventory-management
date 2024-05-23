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
    <title>Customers - Inventory Management System</title>
</head>
<body>
    <h2>Customers List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM customers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['address']}</td>
                    <td>
                        <a href='edit_customer.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete_customer.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No customers found</td></tr>";
        }
        ?>
    </table>
    <a href="add_customer.php">Add New Customer</a>
</body>
</html>
