<?php
include ("connection.php");
session_start();
$user = $_GET['name'];
$_SESSION['userEdit'] = $user;
$sql = "SELECT * FROM user WHERE Name = '$user'";
$result = $conn->query($sql);
if ($result->num_rows==1){
    $row = $result->fetch_assoc();
    $oldName = $row['Name'];
    $oldPermission = $row['Permission'];
    $oldInstitute = $row['Institute'];
    $oldEmail = $row['Email'];
    $oldNfc = $row['NFCTag'];
    //$oldPassword = $row['Password'];
}else {
    echo $user + "is not found !";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit <?php echo $oldName; ?>: </title>
</head>
<body>
<form name="form" action="edit_user_process.php" method="POST">
    <label>Name: </label>
    <input type="text" id="name" name="name" value = "<?php echo $oldName ?>" ></br></br>
    <label>Permission: </label>
    <input type="text" id="permission" name="permission" value = "<?php echo $oldPermission ?>" > </br></br> 
    <label>Institute: </label>
    <input type="text" id="institute" name="institute" value = "<?php echo $oldInstitute ?>" > </br></br> 
    <label>Email: </label>
    <input type="email" id="email" name="email" value = "<?php echo $oldEmail ?>" ></br></br>
    <label>NFC-Tag: </label>
    <input type="text" id="nfc" name="nfc" value = "<?php echo $oldNfc ?>" ></br></br>
    <button type="button" onclick="scanNFC()">Scan</button></br></br>
    <button type="button" onclick="navigateTo('admin_welcome.php')">Cancel</button></br></br>
    <!-- <label>Password: </label>
    <input type="password" id="password" name="password"></br></br> /-->
    <input type="submit" id="btn" value="finish" />
</form>
<script>
    let scanning = false; // Flag to prevent multiple loops

    function scanNFC() {
        if (scanning) return; // Prevent multiple instances of the loop
        scanning = true;
    
        let nfcInput = document.getElementById('nfc');
        nfcInput.value = ''; 
        nfcInput.placeholder = 'Scanning...';
    
        async function fetchNFC() {
            try {
                const response = await fetch('http://134.130.88.15:8081/scan_nfc.php');
                const data = await response.text();
            
                if (!data.includes("No NFC Detected") && !data.startsWith("<!DOCTYPE")) { // Check if NFC tag is detected
                    nfcInput.value = data; // Show scanned NFC tag
                    nfcInput.placeholder = ""; // Clear placeholder
                    scanning = false; // Stop scanning
                } else {
                setTimeout(fetchNFC, 1000); // Retry in 1 seconds
                }
            } catch (error) {
                scanning = false;
            }
        }
    
        fetchNFC(); // Start scanning
    }

</script>
</body>
</html>