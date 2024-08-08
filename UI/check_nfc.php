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

$nfcTagId = getNFCTagId();

$sql = "SELECT Name, Balance FROM user WHERE NFCTag = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nfcTagId);
$stmt->execute();
$stmt->bind_result($name, $balance);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($name) {
  $_SESSION['name'] = $name;
  $_SESSION['balance'] = $balance;
  echo 'frame-04';
} else {
  echo 'frame-02';
}
?>
