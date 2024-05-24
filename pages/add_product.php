<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $supplier_id = $_POST['supplier_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $sql = "INSERT INTO products (name, category_id, brand_id, supplier_id, price, quantity, description) 
            VALUES ('$name', '$category_id', '$brand_id', '$supplier_id', '$price', '$quantity', '$description')";

    if ($conn->query($sql) === TRUE) {
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <link rel="stylesheet" type="text/css" href="../public/css/addP.css">

</head>
<body>
    <h2>Add New Product</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        Category: 
        <select name="category_id" required>
            <?php
            $sql = "SELECT id, name FROM categories";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            }
            ?>
        </select><br>
        Brand: 
        <select name="brand_id" required>
            <?php
            $sql = "SELECT id, name FROM brands";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            }
            ?>
        </select><br>
        Supplier: 
        <select name="supplier_id" required>
            <?php
            $sql = "SELECT id, name FROM suppliers";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['id']}'>{$row['name']}</option>";
                }
            }
            ?>
        </select><br>
        Price: <input type="text" name="price" required><br>
        Quantity: <input type="number" name="quantity" required><br>
        Description: <textarea name="description"></textarea><br>
        <button type="submit">Add Product</button>
    </form>
</body>
</html>




