<h1>CHANGE UR PASSWORD</h1>

<form name="form" action="change_password_process.php" method="POST">
    <label> old password: </label> <br>
    <input type = "password" name="old_password" id="old_password"><br><br>

    <label> new password: </label> <br>
    <input type = "password" name="new_password" minlength="5" id="new_password" ><br><br>

    <label> repeat new password: </label> <br>
    <input type = "password" name="again_new_password" minlength="5" id="again_new_password"><br><br>
    
    <input type="submit" id="btn" value="finish">
</form>