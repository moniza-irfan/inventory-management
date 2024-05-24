<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
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
    <link rel="stylesheet" type="text/css" href="../public/css/addPu.css">
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
