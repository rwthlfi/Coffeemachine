<h1>RESET PASSWORD !</h1>
<?php
include("connection.php");
session_start();
$userID = $_GET['id'];
$userName = $_GET['name'];
echo $userID . " " . $userName;