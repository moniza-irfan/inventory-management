<?php

?>
<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management System</title>
    <link rel="stylesheet" type="text/css" href="../public/css/style.css">

</head>
<body>

<h1 style="color: orange;">Inventory Management System</h1>
    <table border="1">
        <tr>
        <th><a href='home.php?id={$row['id']}'>Home</a></th>
            <th><a href='categories.php?id={$row['id']}'>Category</a></th>
            <th><a href='customers.php?id={$row['id']}'>Customer</a></th>
            <th><a href='suppliers.php?id={$row['id']}'>Supplier</a></th>
            <th><a href='purchases.php?id={$row['id']}'>Purchases</a></th>
            <th><a href='products.php?id={$row['id']}'>Products</a></th>
            <th><a href='brands.php?id={$row['id']}'>Brands</a></th>
            <th><a href='orders.php?id={$row['id']}'>Orders</a></th>
            <th><a href='order_items.php?id={$row['id']}'>Orders Items</a></th>
            <th><a href="logout.php">Logout</a></th>
        </tr>
    </table>
</body>
</html>
<?php
?>
