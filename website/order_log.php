<h1>LOG</h1>
<?php
session_start();
 
include("connection.php");
$sqlFetchLogs = "SELECT 
                    order_log.Order_ID,
                    user.Name AS User_Name,
                    product.Name AS Product_Name,
                    order_log.Old_Balance,
                    order_log.New_Balance,
                    order_log.Timestamp
                 FROM 
                    order_log
                 JOIN 
                    user ON order_log.User_ID = user.ID
                 JOIN 
                    product ON order_log.Product_ID = product.ID
                 ORDER BY 
                    order_log.Timestamp DESC";

$resultFetchLogs = mysqli_query($conn, $sqlFetchLogs);

$logList = '';
while ($row = mysqli_fetch_assoc($resultFetchLogs)) {
    $currentLogOrderID = $row['Order_ID'];
    $currentLogUserName = $row['User_Name'];
    $currentLogProductName = $row['Product_Name'];
    $currentLogOldBalance = $row['Old_Balance'];
    $currentLogNewBalance = $row['New_Balance'];
    $currentLogTimestamp = $row['Timestamp'];

    $logList .= '<li> Order ID: ' . $currentLogOrderID . '. ' 
    . $currentLogUserName . ' ordered: ' . $currentLogProductName . ' on: ' . $currentLogTimestamp .
    '. Balance was: ' . number_format($currentLogOldBalance, 2) . '€. And now is: ' . number_format($currentLogNewBalance, 2) . '€. ' ;
}
echo '<ul>' . $logList . '</ul>';
?>