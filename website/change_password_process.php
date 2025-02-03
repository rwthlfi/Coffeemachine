<?php
session_start();
include("connection.php");
$correctOldPassword =   $_SESSION['hashed_password'];
$userID = $_SESSION['ID'];
$oldPassword = $_POST['old_password'];
$newPassword = $_POST['new_password'];
$againNewPassword = $_POST['again_new_password'];


if(password_verify($oldPassword, $correctOldPassword)){
    //echo "HAPPY DAYS !";
    if ($newPassword === $againNewPassword ){
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET Password = ? WHERE ID = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $hashedNewPassword, $userID);
        if($stmt->execute()){
            echo '<script>alert("Password changed successfully !");</script>';
            echo '<script>window.location.href = \'admin_welcome.php\'</script>';
        }
    }
    
} else {
    echo '<script>alert("Wrong old Password ! Please enter your old password correctly !");</script>';
    echo '<script>window.location.href = \'change_password.php\'</script>';
}


/*
$sqlOldPassword = "SELECT Password FROM user WHERE ID = $userID";

$resultsqlOldPassword = mysqli_query($conn, $sqlOldPassword);

if(!$resultsqlOldPassword){
    die("Query failed: " . mysqli_error($conn));
}
$row = mysqli_fetch_row($resultsqlOldPassword);
$hashedOldPassword = $row[0];
echo "correct old password: " . $correctOldPassword . '<br>';
echo "old password put: " . $hashedOldPassword;
*/




