<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $total = $_POST['total'];

    $check_customer_sql = "SELECT id FROM customers WHERE id='$customer_id'";
    $check_customer_result = $conn->query($check_customer_sql);

    if ($check_customer_result->num_rows > 0) {
        $insert_order_sql = "INSERT INTO orders (customer_id, order_date, total) 
                             VALUES ('$customer_id', '$order_date', '$total')";

        if ($conn->query($insert_order_sql) === TRUE) {
            header("Location: orders.php");
            exit();
        } else {
            echo "Error adding order: " . $conn->error;
        }
    } else {
        echo "Invalid customer ID. Please enter a valid customer ID.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Order</title>
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
        
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        
        input[type="text"]:focus,
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
    <h2>Add New Order</h2>
    <form method="post" action="">
        <label for="customer_id">Customer ID:</label><br>
        <input type="text" id="customer_id" name="customer_id" required><br>
        <label for="order_date">Order Date:</label><br>
        <input type="date" id="order_date" name="order_date" required><br>
        <label for="total">Total:</label><br>
        <input type="text" id="total" name="total" required><br>
        <button type="submit">Add Order</button>
    </form>
</body>
</html>
