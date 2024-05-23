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
    <title>Brands - Inventory Management System</title>
</head>
<body>
    <h2>Brands List</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        <?php
        $sql = "SELECT * FROM brands";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>
                        <a href='edit_brand.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete_brand.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No brands found</td></tr>";
        }
        ?>
    </table>
    <a href="add_brand.php">Add New Brand</a>
</body>
</html>
