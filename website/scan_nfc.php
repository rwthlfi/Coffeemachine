<?php
session_start();
include("connection.php");

function getNFCTagId() {
  $output = [];
  $returnValue = null;
  exec("sudo python3 /home/it/Coffeemachine/rfid/read.py 2>&1", $output, $returnValue);
  foreach($output as $line) {
    //for debugging:
    //echo "$line:\n";
  }
  //for debugging
  //echo "Return value: $returnValue\n";
  if ($returnValue == 0 && !empty($output)){
    return trim($output[0]);
  }
  return null;
}
$id = getNFCTagId();
if ($id) {
    echo $id;
} else {
    echo 'No NFC Detected';
}
?>

