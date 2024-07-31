<?php
include("connection.php");
$oldProduct = $_GET['name'];

$sql = "DELETE FROM product WHERE Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $oldProduct);
$stmt->execute();
$stmt->close();
echo '<script>window.location.href = "admin_welcome.php";</script>';
?>

