<?php
include("connection.php");
?>

<h1>
    Welcome
</h1>
<div id="form">
            <h1>Login</h1>
            <form name="form" action="login.php" onsubmit="return isValid()" method="POST">
                <label>Username: </label>
                <input type="text" id="user" name="user"></br></br>
                <label>Password: </label>
                <input type="password" id="pass" name="pass"></br></br>
                <input type="submit" id="btn" value="Login" name="submit"/>
            </form>
        </div>
        <script>
            function isValid(){
                var user = document.form.user.value;
                var pass = document.form.pass.value;
                if (user.length == "" && pass.length == ""){
                    alert("username and password are empty !!");
                    return false
                } else{
                    if (user.length == ""){
                        alert("username is empty !! ");
                        return false
                    }
                    if (pass.length == ""){
                        alert("password is empty !! ");
                        return false
                    }
                }


            }
        </script>