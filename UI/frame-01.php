

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

<?php

session_start();

include("connection.php");


function getNFCTagId() {
  $output = [];
  $returnValue = null;

  exec("sudo python3 /usr/local/bin/coffeemachine/Kaffemaschine/rfid/read.py 2>&1", $output, $returnValue);

  foreach($output as $line) {
    echo "$line:\n";
  }
  echo "Return value: $returnValue\n";
  
  if ($returnValue == 0 && !empty($output)){
    return trim($output[0]);
  }
  return null;
}
/*
// Attempt to read the NFC tag multiple times with a delay
$maxRetries = 2;  // Maximum number of attempts
$retryInterval = 1;  // Delay between attempts in seconds
$attempt = 0;
$nfcTagId = null;


 while ($attempt < $maxRetries) {
  $nfcTagId = getNFCTagId();
  if ($nfcTagId != null) {
    break;              
  }
  $attempt++;
  sleep($retryInterval);  // Delay to prevent excessive CPU usage
} */
$nfcTagId = getNFCTagId();
// Print the result
/* if ($nfcTagId != null) {


  echo "NFC Tag ID: $nfcTagId !\n";
} else {
  echo "No NFC Tag detected after $maxRetries attempts!\n";
}  */

/* if ($nfcTagId) {
    echo "User with NFC-Tag = $nfcTagId exists !";
  } else {
  echo "User with NFC-Tag = $nfcTagId does not exists !";
}  */

/* if (!$conn) {
  echo "no connection!!!!!!!!!!";
  die("Connection failed: " . mysqli_connect_error());
} else {
  echo "yes connection!!!!!!!!!";
} */


$sql = "SELECT Name, Balance FROM user WHERE NFCTag = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nfcTagId);
$stmt->execute();
$stmt->bind_result($name, $balance);
$stmt->fetch();
$stmt->close();

if ($name) {
  $_SESSION['name'] = $name;
  $_SESSION['balance'] = $balance;
  echo"name = $name and balance is $balance";
  //header("Location: frame-04.html");
    
  exit;

} else {
  echo "name = $name and balance is $balance";
  //header("Location: frame-02.html");
  exit;
}
/*   else {
  echo "Failed to read NFC tag."; */
$conn->close();
ob_end_flush();


?>



