<h1>CHARGE USER !!!</h1>
<br><br>
<?php
$name = $_GET['name'];
include("connection.php");
$sql = "SELECT Balance FROM user Where Name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $name);
$stmt->execute();
$stmt->bind_result($currentBalance);
$stmt->fetch();
$stmt->close();

echo "The current balance of " . $name . " is " . number_format($currentBalance,2) . " €.";

?>
<br><br>
<form name="form" action="charge_user_process.php?name=<?php echo $name ?>" method="POST">
    <input type="number" step="any" name="money_plus" id="money_plus">
    <input type="submit" name="btn" value="finish">
</form>

<button onclick="navigateTo('admin_welcome.php?name=' + encodeURIComponent('<?php echo $_GET['name'] ?>'))">home</button>

<script>
    function navigateTo(url) {
        window.location.href = url;
    }
</script>