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
    $sql = "SELECT * FROM suppliers WHERE id='$id'";
    $result = $conn->query($sql);
    $supplier = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $contact_name = $_POST['contact_name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    $sql = "UPDATE suppliers SET name='$name', contact_name='$contact_name', phone='$phone', email='$email', address='$address' WHERE id='$id'";

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
    <title>Edit Supplier</title>
    <link rel="stylesheet" type="text/css" href="../public/css/editS.css">
</head>
<body>
    <h2>Edit Supplier</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $supplier['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $supplier['name']; ?>" required><br>
        Contact Name: <input type="text" name="contact_name" value="<?php echo $supplier['contact_name']; ?>"><br>
        Phone: <input type="text" name="phone" value="<?php echo $supplier['phone']; ?>"><br>
        Email: <input type="email" name="email" value="<?php echo $supplier['email']; ?>"><br>
        Address: <textarea name="address"><?php echo $supplier['address']; ?></textarea><br>
        <button type="submit">Update Supplier</button>
    </form>
</body>
</html>
