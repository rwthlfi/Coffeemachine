<?php
include("connection.php");
session_start();
$productOldName = $_SESSION['productEdit'];
$productNewName = $_POST['name'];
$productNewPrice = $_POST['price'];

$sql = "UPDATE product
        SET Name = ?, Price = ?
        WHERE Name = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sds", $productNewName, $productNewPrice, $productOldName);
if ($stmt->execute() == true) {
    echo "Record Updated successfully";
    echo '<script> setTimeout(function() {
             window.location.href = "admin_welcome.php";
        }, 2000);
        </script>';
    $stmt->close();
    $conn->close();
} else {
    echo "ERROR: " . $stmt->error;
}

?>