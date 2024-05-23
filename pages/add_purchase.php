<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $supplier_id = $_POST['supplier_id'];
    $quantity = $_POST['quantity'];
    $purchase_date = $_POST['purchase_date'];

    $sql = "INSERT INTO purchases (product_id, supplier_id, quantity, purchase_date) 
            VALUES ('$product_id', '$supplier_id', '$quantity', '$purchase_date')";

    if ($conn->query($sql) === TRUE) {
        header("Location: purchases.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Purchase</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        h2 {
            text-align: center;
            color: #333;
        }
        
        form {
            width: 50%;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        select,
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        select:focus,
        input[type="number"]:focus,
        input[type="date"]:focus {
            outline: none;
            border-color: #007bff;
        }
        
        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2>Add New Purchase</h2>
    <form method="post" action="">
        Product: 
        <select name="product_id" required>
            <?php
            $sql = "SELECT id, name FROM products";
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
        Quantity: <input type="number" name="quantity" required><br>
        Purchase Date: <input type="date" name="purchase_date" required><br>
        <button type="submit">Add Purchase</button>
    </form>
</body>
</html>
