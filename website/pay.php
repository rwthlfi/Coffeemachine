<h1>PAY !!</h1>
<?php
session_start();
 
include("connection.php");
$userID = $_SESSION['ID'];
$drinkName = $_GET['drink'];

$sqlGetDrinkPrice = "SELECT Price 
FROM product
WHERE Name = ?";
$stmtGetDrinkPrice = $conn->prepare($sqlGetDrinkPrice);
$stmtGetDrinkPrice->bind_param("s",$drinkName);
$stmtGetDrinkPrice->execute();
$stmtGetDrinkPrice->bind_result($drinkPrice);
$stmtGetDrinkPrice->fetch();
$stmtGetDrinkPrice->close();
if($drinkPrice == NULL){
    echo '<script>alert("There is no such drink !")</script>';
    echo '<script>window.location.href = "admin_welcome.php"</script>';
    exit;
}

$sqlGetUserBalance = "SELECT Balance 
FROM user
WHERE ID = ?";
$stmtGetUserBalance = $conn->prepare($sqlGetUserBalance);
$stmtGetUserBalance->bind_param("s",$userID);
$stmtGetUserBalance->execute();
$stmtGetUserBalance->bind_result($userOldBalance);
$stmtGetUserBalance->fetch();
$stmtGetUserBalance->close();

$userNewBalance = $userOldBalance - $drinkPrice;






$sqlUpdateUserBalance = "UPDATE user
SET Balance = ? WHERE ID = ?";
$stmtUpdateUserBalance = $conn->prepare($sqlUpdateUserBalance);
$stmtUpdateUserBalance->bind_param("di", $userNewBalance, $userID);
if($stmtUpdateUserBalance->execute()){
    echo '<script>alert("Your balance has been successfully updated !")</script>';
    echo '<script>window.location.href = "admin_welcome.php"</script>';
    
}else{
    echo '<script>alert("ERROR !")</script>';
}

//this following echo line was for me to check my query results. 
//echo "You " . $userID . " want to pay for " . $_GET['drink'] . ". The price is " . $drinkPrice . ". Your old balance is " . $userOldBalance . ". Your new balance is " . $userNewBalance;