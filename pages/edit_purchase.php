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
    $sql = "SELECT * FROM purchases WHERE id='$id'";
    $result = $conn->query($sql);
    $purchase = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $product_id = $_POST['product_id'];
    $supplier_id = $_POST['supplier_id'];
    $quantity = $_POST['quantity'];
    $purchase_date = $_POST['purchase_date'];

    $sql = "UPDATE purchases SET product_id='$product_id', supplier_id='$supplier_id', quantity='$quantity', purchase_date='$purchase_date' WHERE id='$id'";

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
    <title>Edit Purchase</title>
</head>
<body>
    <h2>Edit Purchase</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $purchase['id']; ?>">
        Product: 
        <select name="product_id" required>
            <?php
            $sql = "SELECT id, name FROM products";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $selected = ($row['id'] == $purchase['product_id']) ? "selected" : "";
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
                    $selected = ($row['id'] == $purchase['supplier_id']) ? "selected" : "";
                    echo "<option value='{$row['id']}' $selected>{$row['name']}</option>";
                }
            }
            ?>
        </select><br>
        Quantity: <input type="number" name="quantity" value="<?php echo $purchase['quantity']; ?>" required><br>
        Purchase Date: <input type="date" name="purchase_date" value="<?php echo $purchase['purchase_date']; ?>" required><br>
        <button type="submit">Update Purchase</button>
    </form>
</body>
</html>
