<!--
How would it be if I put all information from the two tables together in one in the right order and then do the while loop thing ?!

SELECT Log_Type, Log_ID, User_ID, Log_Item_ID, Charge_Amount, Balance, Timestamp
FROM (
    SELECT 'Order' AS Log_Type, Order_ID AS Log_ID, User_ID, Product_ID AS Log_Item_ID, NULL AS Charge_Amount, Old_Balance AS Balance, Timestamp
    FROM order_log
    UNION ALL
    SELECT 'Charge' AS Log_Type, Charge_ID AS Log_ID, User_ID, NULL AS Log_Item_ID, Amount_Charged AS Charge_Amount, New_Balance AS Balance, Timestamp
    FROM charge_log
) AS CombinedLog
ORDER BY Timestamp DESC;


//Code before:-->
<h1>COMBINED LOG</h1>

<?php
include("connection.php");

// Fetch order logs
$sqlFetchOrderLogs = "SELECT 
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
                    product ON order_log.Product_ID = product.ID";

$resultFetchOrderLogs = mysqli_query($conn, $sqlFetchOrderLogs);

// Fetch charge logs
$sqlFetchChargeLogs = "SELECT 
                     charge_log.Charge_ID,
                     user.Name AS User_Name,
                     charge_log.Amount,
                     charge_log.Timestamp
                  FROM 
                     charge_log
                  JOIN 
                     user ON charge_log.User_ID = user.ID";

$resultFetchChargeLogs = mysqli_query($conn, $sqlFetchChargeLogs);

// Combine and sort the results
$combinedLogs = array();



// Sort the combined logs by timestampa
usort($combinedLogs, function ($a, $b) {
    return strtotime($b['Timestamp']) - strtotime($a['Timestamp']);
});

$combinedLogList = '';
foreach ($combinedLogs as $log) {
    $logType = $log['type'];
    $combinedLogList .= '<li>' . $logType . ' ID: ' . $log[$logType . '_ID'] . '. ' 
    . $log['User_Name'] . //in case Order
    ($logType === 'Order' ? ' has ordered: ' . $log['Product_Name'] :
    //in case Charge
    ' has added ' . number_format($log['Amount'], 2) . '€ to his/her account.') .  
    ' Timestamp: ' . $log['Timestamp'] . '</li>';
}

echo '<ul>' . $combinedLogList . '</ul>';
?>
