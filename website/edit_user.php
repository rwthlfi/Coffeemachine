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
    //$oldPassword = $row['Password'];
}else {
    echo $user + "is not found !";
}
?>
<head>
    <h1> Edit: <?php echo $oldName ?> </h1>
</head>
<form name="form" action="edit_user_process.php" method="POST">
    <label>Name: </label>
    <input type="text" id="name" name="name" value = "<?php echo $oldName ?>" ></br></br>
    <label>Permission: </label>
    <input type="text" id="permission" name="permission" value = "<?php echo $oldPermission ?>" > </br></br> 
    <label>Institute: </label>
    <input type="text" id="institute" name="institute" value = "<?php echo $oldInstitute ?>" > </br></br> 
    <label>Email: </label>
    <input type="email" id="email" name="email" value = "<?php echo $oldEmail ?>" ></br></br>
    <!-- <label>Password: </label>
    <input type="password" id="password" name="password"></br></br> /-->
    <input type="submit" id="btn" value="finish" />
</form>

