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
    $sql = "SELECT * FROM products WHERE id='$id'";
    $result = $conn->query($sql);
    $product = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $category_id = $_POST['category_id'];
    $brand_id = $_POST['brand_id'];
    $supplier_id = $_POST['supplier_id'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $description = $_POST['description'];

    $sql = "UPDATE products SET name='$name', category_id='$category_id', brand_id='$brand_id', supplier_id='$supplier_id', price='$price', quantity='$quantity', description='$description' WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: products.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Product</title>
    <link rel="stylesheet" type="text/css" href="../public/css/editP.css">

</head>
<body>
    <h2>Edit Product</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
        Name: <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br>
        Category: 
        <select name="category_id" required>
            <?php
            $sql = "SELECT id, name FROM categories";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $product['category_id']) ? "selected" : "";
                    echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                }
            }
            ?>
        </select><br>
        Brand: 
        <select name="brand_id" required>
            <?php
            $sql = "SELECT id, name FROM brands";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $product['brand_id']) ? "selected" : "";
                    echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
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
                    $selected = ($row['id'] == $product['supplier_id']) ? "selected" : "";
                    echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                }
            }
            ?>
        </select><br>
        Price: <input type="text" name="price" value="<?php echo $product['price']; ?>" required><br>
        Quantity: <input type="number" name="quantity" value="<?php echo $product['quantity']; ?>" required><br>
        Description: <textarea name="description"><?php echo $product['description']; ?></textarea><br>
        <button type="submit">Update Product</button>
    </form>
</body>
</html>

