<?php
include("connection.php");

$name = $_GET['name'];
$money_plus = $_POST['money_plus'];

$sql = "SELECT Balance 
        FROM user
        WHERE Name = ? ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$stmt->bind_result($currentBalance);
$stmt->fetch();
$stmt->close();

$updatedBalance = $currentBalance + $money_plus;

$sqlUpdate = "UPDATE user 
            SET Balance = ?
            WHERE Name = ?";

$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("ds", $updatedBalance, $name);

if ($stmtUpdate->execute()) {
    echo '<script> alert("The new Balance of " . $name . "is" . $updatedBalance . "€.");</script>';
    $stmtUpdate->close();
    $conn->close();
    header("Location: admin_welcome.php?name=$name");
    /*echo '<script> setTimeout(function() {
        window.location.href = "admin_welcome.php";
        }, 2000);
        </script>';*/
} else {
    echo "Error updating balance: ". $stmtUpdate->error;
}

?>

