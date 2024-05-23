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

    $sql = "INSERT INTO brands (name) VALUES ('$name')";

    if ($conn->query($sql) === TRUE) {
        header("Location: brands.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Brand</title>
    <link rel="stylesheet" type="text/css" href="../public/css/addB.css">
    
</head>
<body>
    <h2>Add New Brand</h2>
    <form method="post" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br>
        <button type="submit">Add Brand</button>
    </form>
</body>
</html>
