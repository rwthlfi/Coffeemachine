<!-- This script was only needed once to hash all passwords in phpmyadmin. I had an issue at the beginning, that's why I made this. Now there is no need for this script. -->



<?php
include("connection.php"); // Ensure this includes your database connection settings

// Fetch all users who need their passwords updated
$sql = "SELECT ID, Name, Password FROM user WHERE Password NOT LIKE '$2y$%'";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $username = $row['Name'];
    $plainPassword = $row['Password']; // assuming this is currently plain text

    // Hash the plain password
    $hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

    // Update the password in the database
    $updateSql = "UPDATE user SET Password = ? WHERE ID = ?";
    $updateStmt = $conn->prepare($updateSql);
    $updateStmt->bind_param("si", $hashedPassword, $row['ID']);
    $updateStmt->execute();
    $updateStmt->close();

    echo "Password updated for user: " . $username . "<br>";
}

$stmt->close();
$conn->close();
?>
