<?php
session_start();
include("connection.php");
$name = $_POST['name'];
$permission = $_POST['permission'];
$institute = $_POST['institute'];
$email = $_POST['email'];
$password = $_POST['password'];
$balance = $_POST['balance'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
$sql = "INSERT INTO user
(Name, Permission, Institute, Email, Password, Balance) 
VALUES
(?,?,?,?,?,?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssd", $name, $permission, $institute, $email, $hashedPassword, $balance);
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


