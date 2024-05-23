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
    $sql = "SELECT * FROM categories WHERE id='$id'";
    $result = $conn->query($sql);
    $category = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];

    $sql = "UPDATE categories SET name='$name', description='$description' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: categories.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Category</title>
</head>
<body>
    <h2>Edit Category</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $category['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $category['name']; ?>" required><br>
        Description: <textarea name="description"><?php echo $category['description']; ?></textarea><br>
        <button type="submit">Update Category</button>
    </form>
</body>
</html>
