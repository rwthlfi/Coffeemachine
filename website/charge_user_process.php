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

$sqlGetID = "SELECT ID 
        FROM user
        WHERE Name = ? ";

$stmtGetID = $conn->prepare($sqlGetID);
$stmtGetID->bind_param("s", $name);
$stmtGetID->execute();
$stmtGetID->bind_result($currentID);
$stmtGetID->fetch();
$stmtGetID->close();

$updatedBalance = $currentBalance + $money_plus;

$sqlUpdate = "UPDATE user 
            SET Balance = ?
            WHERE Name = ?";

$stmtUpdate = $conn->prepare($sqlUpdate);
$stmtUpdate->bind_param("ds", $updatedBalance, $name);

if ($stmtUpdate->execute()) {
    echo '<script> alert("The new Balance of " . $name . "is" . $updatedBalance . "€.");</script>';
    
    $stmtUpdate->close();

    $sqlInsertCharge = "INSERT INTO charge_log (User_ID, Amount)
    VALUES (?, ?)";   
    $stmtInsretCharge = $conn->prepare($sqlInsertCharge);
    $stmtInsretCharge->bind_param("id",$currentID, $money_plus);
    if($stmtInsretCharge->execute()){
        echo '<script>alert("Your charging has been successfully added to the order log")</script>';
    } else{
        echo '<script>alert("Failed to add your charge to the charge log !")</script>';
    }
    
    echo '<script>window.location.href = "admin_welcome.php"</script>';
    header("Location: admin_welcome.php?name=$name");
    /*echo '<script> setTimeout(function() {
        window.location.href = "admin_welcome.php";
        }, 2000);
        </script>';*/
} else {
    echo "Error updating balance: ". $stmtUpdate->error;
}
$conn->close();

?>

