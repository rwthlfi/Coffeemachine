<head>
    <h1>
        ADD USER !
    </h1>

    <form method="POST" action="add_user_process.php">
        Name: <input type="text" id="name" name="name"> <br>
        Permission <i> (Admin or Non-Admin)</i>: <input type="text" id="permission" name="permission"> <br>
        Institute: <input type="text" id="institute" name="institute"><br>
        Email: <input type="email" id="email" name="email"> <br>
        Password: <input type="password" id="password" name="password"> <br>
        Balance: <input type="number" min="0" id="number" name="balance"> <br>
        <input type="submit" value="finish">
    </form>

    <script>
        function navigateTo(url) {
            window.location.href = url;
        }
    </script>

    <button onclick="navigateTo('admin_welcome.php')">home</button>


</head>