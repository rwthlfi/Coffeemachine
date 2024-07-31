
<h1>LOG</h1>

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

// Fetch and process order logs
while ($row = mysqli_fetch_assoc($resultFetchOrderLogs)) {
   $row['type'] = 'Order';
   $combinedLogs[] = $row;
}

// Fetch and process charge logs
while ($row = mysqli_fetch_assoc($resultFetchChargeLogs)) {
   $row['type'] = 'Charge';
   $combinedLogs[] = $row;
}


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
    ' has added ' . number_format($log['Amount'],2) . '€ to his/her account.') .  
    ' Timestamp: ' . $log['Timestamp'] . '</li>';
}

echo '<ul>' . $combinedLogList . '</ul>';
?>
