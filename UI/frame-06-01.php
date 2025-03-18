<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Frame 06-01</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A400"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400"/>
  <link rel="stylesheet" href="./styles/frame-06-01.css"/>
  <script>
    var timeTakenToMakeOneCoffee = 1000;
    function navigateToHome() {
      window.location.href = 'frame-04.php';
    }
    setTimeout(navigateToHome, timeTakenToMakeOneCoffee);
  </script>
</head>
<body>
<div class="frame-06-01-BSb">
  <div class="page-jyu">
    <img class="logo-Vy5" src="./assets/Logo.png"/>
    <div class="pop-window-qX9">
    </div>
    <div class="espresso-kommt-KhD">2x Espresso kommt...</div>
  </div>
</div>
</body>

<?php

  session_start();
  include("connection.php");
  $id = $_SESSION['id'];

  $product = "Double Espresso";

  $sqlCurrentUserInfo = "SELECT Name, Balance FROM user WHERE ID = ?";
  $stmtCurrentUserInfo = $conn->prepare($sqlCurrentUserInfo);
  $stmtCurrentUserInfo->bind_param("i", $id);
  $stmtCurrentUserInfo->execute();
  $stmtCurrentUserInfo->bind_result($name, $balance);
  $stmtCurrentUserInfo->fetch();
  $stmtCurrentUserInfo->close();

  //check I get name and Balance correctly!
  //echo "username: $name, and balance: $balance";
  
  //$drinkPrice = null;  
  
  $sqlDrinkPrice = "SELECT Price FROM product WHERE Name = ?";
  $stmtDrinkPrice = $conn->prepare($sqlDrinkPrice);
  $stmtDrinkPrice->bind_param("s", $product);
  $stmtDrinkPrice->execute();
  $stmtDrinkPrice->bind_result($drinkPrice);
  $stmtDrinkPrice->fetch();
  $stmtDrinkPrice->close();

  if ($drinkPrice === null) {
    echo "Failed to fetch drink price for $product";
    exit;
  }
  //check if drink price is correct
  //echo "$product 's price = $drinkPrice";

  $newBalance = $balance - $drinkPrice;
  //check users' new balance is updated correctly!
  //echo " ----------------- your new Balance is: $newBalance";
  
  //update user's balance
  $sqlUpdateBalance = "UPDATE user SET Balance = ? WHERE Name = ?";
  $sqlUpdateBalance = $conn->prepare($sqlUpdateBalance);
  $sqlUpdateBalance->bind_param("ds", $newBalance, $name);
  $sqlUpdateBalance->execute();
  $sqlUpdateBalance->close();
  $conn->close();

?>