<?php
session_start();
include("connection.php");
$user = $_SESSION['user'];
$userID = $_SESSION['ID'];

$sql = "SELECT Balance 
        FROM user
        WHERE Name = ? ";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user);
$stmt->execute();
$stmt->bind_result($currentBalance);
$stmt->fetch();
$stmt->close();


$sqlFetchUsers = "SELECT * From user";
$resultFetchUsers = mysqli_query($conn, $sqlFetchUsers);
$sqlFetchProducts = "SELECT * From product";
$resultFetchProducts = mysqli_query($conn, $sqlFetchProducts);

$userList = '';
while ($row = mysqli_fetch_assoc($resultFetchUsers)) {
    $currentUserName = $row['Name'];
    $currentUserID = $row['ID'];
    $currentUserBalance = $row['Balance'];
    $userList .= '<li>' . $currentUserName . ' ----- Balance: ' . number_format($row['Balance'], 2) . '€';
    $userList .= '<button onclick="window.location.href = \'edit_user.php?name=' . $currentUserName . '\'">Edit</button>';
    $userList .= '<button onclick="deleteUser(\'' . $currentUserName . '\', \'' . number_format($currentUserBalance, 2) . '\')">Delete</button>';
    $userList .= '<button onclick="window.location.href = \'charge_user.php?name=' . $currentUserName . '\'">Charge</button>';
    $userList .= '<button onclick="window.location.href = \'reset_password.php?name=' . $currentUserName . '&id=' . $currentUserID . '\'">Reset Password</button>';
    $userList .= '</li>';
}
$productList = '';
while ($row = mysqli_fetch_assoc($resultFetchProducts)) {
    $currentProductName = $row['Name'];
    $productList .= '<li>' . $currentProductName . ' ----- Price: ' . number_format($row['Price'], 2) . '€';
    $productList .= '<button onclick="window.location.href = \'edit_product.php?name=' . $currentProductName . '\'">Edit</button>';
    $productList .= '<button onclick="deleteProduct(\'' . $currentProductName . '\')">Delete</button>';
    $productList .= '</li>';
}

?>


<head>
    <h1>
        Hello <?php echo $user . ". Your balance is " . number_format($currentBalance, 2) . "€"; ?>.
    </h1>
</head>

<p></p>
<button onclick="navigateTo('admin_welcome.php')">home</button>
<button onclick="navigateTo('add_user.php')">add user</button>
<button onclick="navigateTo('add_product.php')">add product</button>
<button onclick="navigateTo('index.php')"> log out</button>
<button onclick="navigateTo('change_password.php')"> change password</button>
<br>
<button onclick="pay('Coffee')">Coffee</button>
<button onclick="pay('Double Coffee')"> Double Coffee</button>
<button onclick="pay('Espresso')">Espresso</button>
<button onclick="pay('Double Espresso')">Double Espresso</button>
<br>
<button onclick="navigateTo('log.php')">LOG</button>


<br><br>

<script>
    function deleteUser($userName, $userBalance) {
        if (confirm($userName + " has "+ $userBalance + "€. Are you sure you want to delete " + $userName + " ?")) {
            navigateTo("delete_user_process.php?name="+$userName);
        } else {
            alert("deleting process failed !");
        }
    }

    function navigateTo(url) {
        window.location.href = url;
    }
    function deleteProduct($productName){
        if (confirm("Are you sure you want to delete " + $productName + " ?")){
            navigateTo("delete_product_process.php?name=" + $productName);
        } else {
            alert("deleting process failed !");
        }
    }
    function pay(drink){
        navigateTo("pay.php?drink="+encodeURIComponent(drink));
    }
</script>
<p></p>


<ul>
    <h3>Users:</h3>
    <?php
    echo $userList;
    echo "<br><br><br>";
    ?>
   <h3>Products:</h3>
    <?php
    echo $productList;
    echo "<br><br><br>";
    ?>
</ul>