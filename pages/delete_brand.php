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
    $sql = "DELETE FROM brands WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        header("Location: brands.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>