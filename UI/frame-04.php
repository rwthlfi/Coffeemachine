<?php
session_start();

if (!isset($_SESSION['id'])) {
  // Redirect to the NFC scan page if the session variables are not set
  header("Location: frame-01.html");
  exit();
}


$id = $_SESSION['id'];

include("connection.php");





$sqlCurrentUserInfo = "SELECT Name, Balance FROM user WHERE ID = ?";
$stmtCurrentUserInfo = $conn->prepare($sqlCurrentUserInfo);
$stmtCurrentUserInfo->bind_param("i", $id);
$stmtCurrentUserInfo->execute();
$stmtCurrentUserInfo->bind_result($name, $balance);
$stmtCurrentUserInfo->fetch();
$stmtCurrentUserInfo->close();
$conn->close();


if (!isset($name)) {
  // Redirect to the NFC scan page if the session variables are not set
  echo "user with id: $id is not found!";
  exit();
}

// Check if the user is logged in

//$name = $_SESSION['name'];
//$balance = $_SESSION['balance'];
?>

<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Frame 04</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A400" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400" />
  <link rel="stylesheet" href="./styles/frame-04.css" />
</head>

<body>
  <div class="frame-04-acT">
    <div class="page-88B">
      <img class="logo-sbZ" src="./assets/Logo.png" />
      <div class="hallo-hussein-idris-sie-haben-noch-1000-auf-ihrem-konto-1hm">
        Hallo <?php echo htmlspecialchars($name); ?>! <br>
        Sie haben noch <?php echo number_format($balance, 2); ?>€ auf Ihrem Konto.
      </div>
      <div id="current-time/date" class="item-07-00-01012024-qwh"></div>
      <img class="button-KXR" src="./assets/Coffee_Single.png"
        onclick="handleButtonClick(this, './assets/Coffee_Single_Pressed.png')" />
      <img class="button-AZy" src="./assets/Espresso_Single.png"
        onclick="handleButtonClick(this, './assets/Espresso_Single_Pressed.png')" />
      <img class="button-fdD" src="./assets/Steam.png"
        onclick="handleButtonClick(this, './assets/Steam_Pressed.png')" />
      <img class="button-pDH" src="./assets/Coffee_Double.png"
        onclick="handleButtonClick(this, './assets/Coffee_Double_Pressed.png')" />
      <img class="button-uRm" src="./assets/Espresso_Double.png"
        onclick="handleButtonClick(this, './assets/Espresso_Double_Pressed.png')" />
      <img class="button-logout" src="./assets/Logout.png"
        onclick="handleButtonClick(this, './assets/Logout_pressed.png')" />
      <div class="kaffee-UKm">Kaffee</div>
      <div class="espresso-9Ru">Espresso</div>
      <div class="dampf-2kb">Dampf</div>
      <div class="x-kaffee-HgX">2x Kaffee</div>
      <div class="x-espresso-aQj">2x Espresso</div>
      <script>
        function updateCurrentTimeDate() {
          var currentTimeDateElement = document.getElementById('current-time/date');

          if (currentTimeDateElement) {
            var now = new Date();
            var timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            var dateString = now.toLocaleDateString([], { day: "2-digit", month: "2-digit", year: "numeric" });

            currentTimeDateElement.innerHTML = timeString + '&nbsp;&nbsp;&nbsp;' + dateString;
          }
        }

        function handleButtonClick(buttonElement, newImagePath) {

          var targetHTML;
          if (newImagePath.includes('Coffee_Single')) {
            targetHTML = 'frame-05.php';
          } else if (newImagePath.includes('Coffee_Double')){
            targetHTML ='frame-05-01.php'              
          } else if (newImagePath.includes('Espresso_Single')) {
            targetHTML = 'frame-06.php';
          } else if (newImagePath.includes('Espresso_Double')) {
            targetHTML = 'frame-06-01.php';
          } else if (newImagePath.includes('Logout')){
            targetHTML ='frame-01.html'              
          } else if (newImagePath.includes('Steam')){
            targetHTML = 'frame-07.html';
          }
          
          var originalSrc = buttonElement.src;

          buttonElement.src = newImagePath;

          setTimeout(function () {
            buttonElement.src = originalSrc;
          }, 100);

          setTimeout(function () {
            window.location.href = targetHTML;
          }, 200);

          var timer = setInterval(function () {
            // Check conditions and redirect back to 'frame-04.php'
            if (window.location.href !== targetHTML) {
              clearInterval(timer); // Stop the interval
              window.location.href = 'frame-04.php';
            }
          }, 1000); // Check every 1 second);

        }

        setInterval(updateCurrentTimeDate, 1000);

        updateCurrentTimeDate();

      </script>
    </div>
  </div>
</body>