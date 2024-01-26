<?php
//THIS FILE WAS FOR TESTING AND DEBUGGING PURPOSES. YOU CAN IGNORE IT !
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

    echo "normal pass is: $password";
    echo "<br><br>";
    echo "hashed pass is: $hashedPassword";
    echo "<br><br><br><br><br>";

    if (password_verify($password, $hashedPassword)) {
        echo "they match !!!!!";
    } else {
        echo "they don't match !!!!!";
    }

    /*
    if(password_verify($password, $hashedPassword)){
        $sql = "SELECT * FROM user WHERE Name = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();

        if ($row['Permission'] == "Admin") {
            header("Location: admin_welcome.php");

        } else {
            header("Location: welcome.php");
        } 
    } else {
        echo '<script>
        window.location.href = "index.php";
        alert("login failed. Invalid username or password !!!")
        </script>';
        }
     */
}
?>