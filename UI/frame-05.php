<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Frame 05</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A400"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400"/>
  <link rel="stylesheet" href="./styles/frame-05.css"/>
  <script>
    // Set time duration for making one coffee
    var timeTakenToMakeOneCoffee = 3000; // 1000 milliseconds = 1 second

    // Function to navigate back to the home page
    function navigateToHome() {
      window.location.href = 'frame-04.php'; // Redirect to frame-04.php
    }

    // Set a timeout to navigate back after the coffee is done
    setTimeout(navigateToHome, timeTakenToMakeOneCoffee);
  </script>
</head>
<body>
<div class="frame-05-t1Z">
  <div class="page-27m">
    <img class="logo-NhR" src="./assets/Logo.png"/>
    <div class="pop-window-uhM">
    </div>
    <div class="kaffee-kommt-b4P">Kaffee kommt...</div>
  </div>
</div>
</body>
</html>


<?php

  session_start();
  include("connection.php");
  $id = $_SESSION['id'];

  $product = "Coffee";

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