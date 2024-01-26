<?php
include("connection.php");
$userDelete = $_GET['name'];

$sql = "DELETE FROM user WHERE Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userDelete);
$stmt->execute();
$stmt->close();
echo '<script>window.location.href = "admin_welcome.php";</script>';
?>
