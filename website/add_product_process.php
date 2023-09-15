<?php
include("connection.php");

$name = $_POST['name'];
$price = $_POST['price'];


$sql = "INSERT INTO product
(Name, Price) 
VALUES
(?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sd", $name, $price);


if ($stmt->execute()) {
    echo "<script>alert('$name has been added!');</script>";
    header("Location: admin_welcome.php");
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>