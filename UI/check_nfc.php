<?php
session_start();
include("connection.php");

function getNFCTagId() {
  $output = [];
  $returnValue = null;
  exec("sudo python3 /home/it/Coffeemachine/rfid/read.py 2>&1", $output, $returnValue);
  //for debugging
  echo "Return value: '$returnValue'\n";
  if ($returnValue == 0 && !empty($output)){
    return trim($output[0]);
  }
  return null;
}

$nfcTagId = getNFCTagId();

if ($nfcTagId === null) {
  echo "no_nfc_detected";  // Tell JavaScript to keep waiting
  exit;
}

$sql = "SELECT Name, Balance, ID FROM user WHERE NFCTag = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nfcTagId);
$stmt->execute();
$stmt->bind_result($name, $balance, $id);
$stmt->fetch();
$stmt->close();
$conn->close();

if ($name) {
  $_SESSION['id'] = $id;
  echo 'frame-04';
} else {
  echo 'frame-02';
}
?>