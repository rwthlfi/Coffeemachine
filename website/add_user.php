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
    function navigateTo(url) {
        window.location.href = url;
    }

</script>

<button onclick="scanNFC()">Scan</button>
<button onclick="navigateTo('admin_welcome.php')">Home</button>

</body>
</html>
