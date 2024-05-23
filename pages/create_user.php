<?php
include('../includes/db.php');

$username = 'admin';
$password = 'password123';
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashedPassword')";
if ($conn->query($sql) === TRUE) {
    echo "User created successfully.";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
?>
