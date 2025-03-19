<?php
session_start();
include("connection.php");

function getNFCTagId() {
    $output = [];
    $returnValue = null;
    exec("sudo python3 /home/it/Coffeemachine/rfid/read.py 2>&1", $output, $returnValue);
    
    // Debugging
    error_log("Return value: '$returnValue'");
    
    if ($returnValue == 0 && !empty($output)) {
        return trim($output[0]);  // Return NFC ID if detected
    }
    return null;  // No NFC detected
}

// Keep polling for NFC without blocking
$nfcTagId = getNFCTagId();

if ($nfcTagId === null || $nfcTagId === '') {
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
    echo "frame-04";  // Valid NFC detected
} else {
    echo "frame-02";  // NFC not in database
}
?>
