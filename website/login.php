<?php
include("connection.php");
session_start();
if (isset($_POST['submit'])) {
    $username = $_POST['user'];
    $password = $_POST['pass'];

    $sql = "SELECT Password FROM user WHERE Name = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();

    if (password_verify($password, $hashedPassword)) {
        $stmt->close();
        $sql = "SELECT * FROM user WHERE Name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $_SESSION['user'] = $row['Name'];
        $_SESSION['balance'] = $row['Balance'];
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['hashed_password'] = $hashedPassword;
        


        if ($row['Permission'] == "Admin") {
            header("Location: admin_welcome.php");
        } else {
            header("Location: welcome.php");
        }
    } else {
        echo "hashed password : $hashedpassword";
        echo '<script>
        window.location.href = "index.php";
        alert("login failed. Invalid username or password !!!")
        </script>';
        $stmt->close();
    }
}



?>