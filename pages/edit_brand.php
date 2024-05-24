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
    $sql = "SELECT * FROM brands WHERE id='$id'";
    $result = $conn->query($sql);
    $brand = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];

    $sql = "UPDATE brands SET name='$name' WHERE id='$id'";

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
    <title>Edit Brand</title>
    <link rel="stylesheet" type="text/css" href="../public/css/editB.css">
</head>
<body>
    <h2>Edit Brand</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $brand['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $brand['name']; ?>" required><br>
        <button type="submit">Update Brand</button>
    </form>
</body>
</html>
