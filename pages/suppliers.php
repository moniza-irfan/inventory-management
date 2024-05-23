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
    <title>Suppliers - Inventory Management System</title>
</head>
<body>
    <h2>Suppliers List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Contact Name</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM suppliers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['contact_name']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['address']}</td>
                    <td>
                        <a href='edit_supplier.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete_supplier.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No suppliers found</td></tr>";
        }
        ?>
    </table>
    <a href="add_supplier.php">Add New Supplier</a>
</body>
</html>
