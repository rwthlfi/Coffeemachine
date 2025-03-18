<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
</head>
<body>

<h1>ADD USER!</h1>

<form method="POST" action="add_user_process.php">
    Name: <input type="text" id="name" name="name"> <br>
    Permission <i>(Admin or Non-Admin)</i>: <input type="text" id="permission" name="permission"> <br>
    Institute: <input type="text" id="institute" name="institute"><br>
    Email: <input type="email" id="email" name="email"> <br>
    Password: <input type="password" id="password" name="password"> <br>
    Balance: <input type="number" min="0" id="balance" name="balance"> <br>
    NFC-Tag: <input type="text" id="nfc" name="nfc" placeholder="Scan your card"> <br>

    <input type="submit" value="Finish">
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

<button onclick="scanNFC()">Scan</button>
<button onclick="navigateTo('admin_welcome.php')">Home</button>

</body>
</html>
