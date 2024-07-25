<?php
session_start();
include("connection.php");
/*
run this python code and compare this print(id) value with NFC-Tags of users then:
- mark user name and balance and save them so you show their specific information in the further frames
- do the log in


import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522

reader = SimpleMFRC522()
try:
        id, text = reader.read()
        print(id)
        print(text)
finally:
        GPIO.cleanup()

*/
function getNFCTagId() {
  $output = null;
  $returnValue = null;

  exec("python3 /rfid/read.py", $output, $returnValue);
  if ($returnValue == 0 && !empty($output)){
    return trim($output[0]);
  }
  return null;
}
$nfcTagId = getNFCTagId();

if ($nfcTagId) {
  $sql = "SELECT Name, Balance FROM user WHERE NFC_Tag = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $nfcTagId)
  $stmt->execute();
  $stmt->bind_result($name, $balance);
  $stmt->fetch();
  $stmt->close();

  if ($name) {
    $_SESSION['name'] = $name;
    $_SESSION['balance'] = $balance;

    header("Location: frame-04.html");
  } else {
    header("Location: frame-02.html");
  }
}

?>


<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Frame 01</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter%3A400" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400" />
  <link rel="stylesheet" href="./styles/frame-01.css" />
</head>

<body>
  <div class="frame-01-5Py">
    <div class="page-dRV">
      <img class="logo-b7R" src="./assets/Logo.png" />
      <div class="lock-XFy">
        <div id="current-time" class="item-07-00-qGf"></div>
        <div id="current-date" class="item-01012024-7EB"></div>
        <div class="hallo-QDH">Hallo!</div>
        <div class="bitte-halten-sie-ihren-nfc-tag-an-den-scanner-4Hq">Bitte halten Sie Ihren NFC-Tag an den Scanner.
        </div>
      </div>
      <script>
        function updateCurrentTime() {
          var currentTimeElement = document.getElementById('current-time');

          if (currentTimeElement) {
            var now = new Date();
            var timeString = now.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });

            currentTimeElement.textContent = timeString;
          }
        }
        setInterval(updateCurrentTime, 1000);

        updateCurrentTime();
        function updateCurrentDate() {
          var currentDateElement = document.getElementById('current-date');

          if (currentDateElement) {
            var now = new Date();
            var dateString = now.toLocaleDateString([], { day: "2-digit", month: "2-digit", year: "numeric" });

            currentDateElement.textContent = dateString;
          }
        }
        setInterval(updateCurrentDate, 1000);
        updateCurrentDate();
      </script>
    </div>
  </div>
</body>