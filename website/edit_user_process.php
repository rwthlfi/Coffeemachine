<?php
include("connection.php");
session_start();
$oldName = $_SESSION['userEdit'];
$newName = $_POST['name'];
$newPermission = $_POST['permission'];
$newInstitute = $_POST['institute'];
$newEmail = $_POST['email'];
//$newPassword = $_POST['password'];
//$newBalance = $_POST['balance'];


$sql = "UPDATE user
        SET Name = ?, Permission = ?, Institute = ?, Email = ?
        WHERE Name = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("sssss", $newName, $newPermission, $newInstitute, $newEmail, $oldName);
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
