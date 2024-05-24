<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM orders WHERE id='$id'";
    $result = $conn->query($sql);
    $order = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $customer_id = $_POST['customer_id'];
    $order_date = $_POST['order_date'];
    $total = $_POST['total'];

    $sql = "UPDATE orders SET customer_id='$customer_id', order_date='$order_date', total='$total' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: orders.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Order</title>
    <link rel="stylesheet" type="text/css" href="../public/css/editO.css">
</head>
<body>
    <h2>Edit Order</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $order['id']; ?>">
        Customer ID: <input type="text" name="customer_id" value="<?php echo $order['customer_id']; ?>" required><br>
        Order Date: <input type="date" name="order_date" value="<?php echo $order['order_date']; ?>" required><br>
        Total: <input type="text" name="total" value="<?php echo $order['total']; ?>" required><br>
        <button type="submit">Update Order</button>
    </form>
</body>
</html>
