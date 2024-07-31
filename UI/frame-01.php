<?php
session_start();
include("connection.php");

function getNFCTagId() {
  $output = null;
  $returnValue = null;

  exec("sudo python3 /home/it/Kaffemaschine/rfid/read.py", $output, $returnValue);

  foreach($output as $line) {
    echo "$line\n";

  }
  
  if ($returnValue == 0 && !empty($output)){
    return trim($output[0]);
  }
  return null;
}
$nfcTagId = null;

while ($nfcTagId === null) {
    $nfcTagId = getNFCTagId();
    if ($nfcTagId === null) {
        sleep(1); // Wait for 1 second before retrying
    }
}

$nfcTagId = getNFCTagId();

if ($nfcTagId) {
  global $conn; // Ensure $conn is in the global scope

  $sql = "SELECT Name, Balance FROM user WHERE 'NFC-Tag' = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("i", $nfcTagId);
  $stmt->execute();
  $stmt->bind_result($name, $balance);
  $stmt->fetch();
  $stmt->close();
  echo("statement works! ---------------------- ");
  
  if ($name) {
    $_SESSION['name'] = $name;
    $_SESSION['balance'] = $balance;
    header("Location: frame-04.html");
    exit;

  } else {
    header("Location: frame-02.html");
    exit;

  }
} else {
  echo "Failed to read NFC tag.";
}
$conn->close();
ob_end_flush();

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