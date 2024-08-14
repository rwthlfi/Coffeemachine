<?php
session_start();
include("connection.php");
$name = $_POST['name'];
$permission = $_POST['permission'];
$institute = $_POST['institute'];
$email = $_POST['email'];
$password = $_POST['password'];
$balance = $_POST['balance'];
$nfcId = $_POST['nfc'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO user
(Name, Permission, Institute, Email, Password, Balance, NFCTag) 
VALUES
(?,?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssdi", $name, $permission, $institute, $email, $hashedPassword, $balance, $nfcId);
?>

<script>
    function navigateTo(url) {
        window.location.href = url;
    }
</script>
<?php
if ($stmt->execute()) {
    echo "<script>alert('$name has been added!');</script>";
    echo "<script>navigateTo('admin_welcome.php')</script>";
} else {
    echo "Error: " . $stmt->error;
}
$stmt->close();
$conn->close();
?>


