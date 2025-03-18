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
    function scanNFC() {
        fetch('http://134.130.88.15/website/scan_nfc.php')
            .then(response => response.text())
            .then(data => {
                if (data) {
                    document.getElementById('nfc').value = data;
                } else {
                    alert('No NFC tag detected or error occurred.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
    function navigateTo(url) {
        window.location.href = url;
    }
</script>
</body>
</html>