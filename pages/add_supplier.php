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
    $contact_name = $_POST['contact_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "INSERT INTO suppliers (name, contact_name, phone, email, address) VALUES ('$name', '$contact_name', '$phone', '$email', '$address')";

    if ($conn->query($sql) === TRUE) {
        header("Location: suppliers.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Supplier</title>
    <link rel="stylesheet" type="text/css" href="../public/css/addS.css">

</head>
<body>
    <h2>Add New Supplier</h2>
    <form method="post" action="">
        Name: <input type="text" name="name" required><br>
        Contact Name: <input type="text" name="contact_name"><br>
        Phone: <input type="text" name="phone"><br>
        Email: <input type="email" name="email"><br>
        Address: <textarea name="address"></textarea><br>
        <button type="submit">Add Supplier</button>
    </form>
</body>
</html>

