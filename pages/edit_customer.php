<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include('../includes/db.php');
include('../includes/header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM customers WHERE id='$id'";
    $result = $conn->query($sql);
    $customer = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    $sql = "UPDATE customers SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: customers.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Customer</title>
</head>
<body>
    <h2>Edit Customer</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $customer['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $customer['name']; ?>" required><br>
        Email: <input type="email" name="email" value="<?php echo $customer['email']; ?>"><br>
        Phone: <input type="text" name="phone" value="<?php echo $customer['phone']; ?>"><br>
        Address: <textarea name="address"><?php echo $customer['address']; ?></textarea><br>
        <button type="submit">Update Customer</button>
    </form>
</body>
</html>
