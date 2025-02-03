<h1>RESET PASSWORD !</h1>
<?php
include("connection.php");
session_start();
$userID = $_GET['id'];
//$userName = $_GET['name'];

$newPassword = "!wasser123";
$hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);

$sql = "UPDATE user
SET Password = ? WHERE ID = ?";
$stmt = mysqli_prepare($conn, $sql);
$stmt->bind_param("ss", $hashedNewPassword, $userID);

if($stmt->execute()){
    echo "The password has been successfully reset. The new password is '!wasser123'";
} else {
    echo "ERROR ! The password could not be reset";
}
?>
<br><br><br><br><br>
<button onclick="navigateTo('admin_welcome.php')"> Home </button> 
<script>
        function navigateTo(url) {
        window.location.href = url;
    }
</script>