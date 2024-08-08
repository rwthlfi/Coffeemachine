<?php
$servername = "134.130.88.31";
$username = "coffee";
$password = "fj2093uhianhsdfaar";
$dbname = "coffee";
global $conn;
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully!" ;
}


?>