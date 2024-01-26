<?php
$servername = "localhost";
$username = "Coffee";
$password = "T5M]Z4l/uu_bXrlm";
$dbname = "Coffee";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "" ;
}


?>