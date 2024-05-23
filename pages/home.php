
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
    <title>Home - Inventory Management System</title>
</head>
<body>
    <h2>Inventory List</h2>
        <table border="1">
        <tr>
             <th>ID</th>
            <th>Name</th>
            <th>Category</th>
            <th>Brand</th>
            <th>Supplier</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Actions</th>
        
</td>

        </tr>
        <?php
        $sql = "SELECT products.id, products.name, categories.name AS category, brands.name AS brand, suppliers.name AS supplier, products.price, products.quantity 
                FROM products 
                LEFT JOIN categories ON products.category_id = categories.id 
                LEFT JOIN brands ON products.brand_id = brands.id 
                LEFT JOIN suppliers ON products.supplier_id = suppliers.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['category']}</td>
                    <td>{$row['brand']}</td>
                    <td>{$row['supplier']}</td>
                    <td>{$row['price']}</td>
                    <td>{$row['quantity']}</td>
                    <td>
                        <a href='edit_product.php?id={$row['id']}'>Edit</a> | 
                        <a href='delete_product.php?id={$row['id']}'>Delete</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No products found</td></tr>";
        }
        ?>
    </table>
    <a href="add_product.php">Add New Product</a>
</body>
</html>
