<?php
$servername = "134.130.88.153";
$username = "root";
$password = "fj2093uhianhsdfaar";
$dbname = "coffee";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
} else {
    //echo "Connected successfully!" ;
}


?>