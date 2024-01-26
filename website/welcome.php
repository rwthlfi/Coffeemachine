<?php
session_start();
$user = $_SESSION['user'];
$balance = $_SESSION['balance'];


?>

<head>
    <h1>
    Hello <?php echo $user . ". Your balance is " . number_format($balance, 2) . "€"; ?>.
    </h1>
    <br>
    <button>change password</button>
</head>



