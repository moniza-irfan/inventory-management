<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 16px;
        }
        select {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: url('data:image/svg+xml;utf8,<svg fill="#999" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center/15px 15px;
            padding-right: 30px;
        }
        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
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




